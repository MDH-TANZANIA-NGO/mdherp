<?php

namespace App\Http\Controllers\Web\HumanResource\HireRequisition;

use App\Models\Auth\User;
use App\Events\NewWorkflow;
use Illuminate\Http\Request;

use App\Models\System\WorkingTool;
use Illuminate\Support\Facades\DB;
use App\Services\Workflow\Workflow;
use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use App\Repositories\Access\UserRepository;
use App\Repositories\System\RegionRepository;
use App\Repositories\Unit\DepartmentRepository;
use App\Repositories\Unit\DesignationRepository;
use App\Repositories\Workflow\WfTrackRepository;
use App\Models\HumanResource\HireRequisition\Skill;
use App\Services\Workflow\Traits\WorkflowInitiator;
use App\Models\HumanResource\HireRequisition\SkillUser;
use App\Models\HumanResource\HireRequisition\SkillCategory;
use App\Models\HumanResource\HireRequisition\HireRequisition;
use App\Models\HumanResource\HireRequisition\HireRequisitionJob;
use App\Models\HumanResource\HireRequisition\HireRequisitionLocation;
use App\Models\HumanResource\HireRequisition\HireRequisitionWorkingTool;
use App\Repositories\HumanResource\HireRequisition\HireUserSkillsRepository;
use App\Repositories\HumanResource\HireRequisition\HireRequisitionRepository;
use App\Repositories\HumanResource\HireRequisition\HireRequisitionJobRepository;
use App\Repositories\HumanResource\HireRequisition\HireRequisitionLocationRepository;
use App\Repositories\HumanResource\HireRequisition\HireRequisitionJobCreteriaRepository;
use App\Repositories\HumanResource\HireRequisition\HireRequisitionWorkingToolRepository;
use App\Repositories\HumanResource\HireRequisition\HireRequisitionReplacedStaffRepository;
use App\Http\Controllers\Web\HumanResource\HireRequisition\Traits\HireRequisitionDatatable;
use App\Models\Unit\Department;

class HireRequisitionController extends Controller
{

    use HireRequisitionDatatable, WorkflowInitiator;
    protected $hireRequisitionRepository;
    protected $hireRequisitionJobRepository;
    protected $regions;
    protected $departments;
    protected $users;
    protected $wf_tracks;
    protected $designation;
    protected $hireRequisitionWorkingToolRepository;
    protected $hireRequisitionJobCreteriaRepository;
    protected $hireRequisitionLocationRepository;

    public  function __construct()
    {
        $this->hireRequisitionRepository = (new HireRequisitionRepository());
        $this->hireRequisitionJobRepository = (new HireRequisitionJobRepository);
        $this->regions = (new RegionRepository());
        $this->departments = (new DepartmentRepository());
        $this->designation = (new DesignationRepository());
        $this->users = (new UserRepository());
        $this->wf_tracks = (new WfTrackRepository());
        $this->hireRequisitionJobCreteriaRepository = (new HireRequisitionJobCreteriaRepository());
        $this->hireRequisitionWorkingToolRepository = (new HireRequisitionWorkingToolRepository());
        $this->hireRequisitionReplacedStaffRepository = (new HireRequisitionReplacedStaffRepository());
        $this->hireRequisitionLocationRepository = (new HireRequisitionLocationRepository());
        $this->hireUserSkillsRepository = (new HireUserSkillsRepository());
    }

    /**
     * Display a hireRequisition of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|View|\Illuminate\View\View
     */
    public function index()
    {
        return view('HumanResource/HireRequisition._parent.index');
    }
    public function list()
    {
        // return $this->hireRequisitionRepository->getAccessProcessingDatatable()->get()->count();
        return view('HumanResource/HireRequisition._parent.hirerequisition');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {

        $tools = WorkingTool::all();
        $users = User::where('designation_id', '!=', null)->get();
        $skillCategories = SkillCategory::get();
        return view('HumanResource.HireRequisition._parent.form.create')
            ->with('prospects', code_value()->query()->where('code_id', 7)->get())
            ->with('contract_types', code_value()->query()->where('code_id', 8)->get())
            ->with('establishments', code_value()->query()->where('code_id', 9)->get())
            ->with('education_levels', code_value()->query()->where('code_id', 10)->get())
            ->with('language_proficiencies', code_value()->query()->where('code_id', 13)->get())
            ->with('departments', $this->departments->getAll())
            ->with('designations', $this->designation->getActiveForSelect())
            ->with('tools', $tools)
            ->with('users', $users)
            ->with('skillCategories', $skillCategories)
            ->with('create', true)
            ->with('regions', $this->regions->getAll());
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function initiate($uuid)
    {
        if (isset($uuid) && !empty($uuid)) {
            $hireRequisition = $this->hireRequisitionRepository->query()
                ->select('hr_hire_requisitions.*', 'departments.title as department')
                ->join('departments', 'departments.id', 'hr_hire_requisitions.department_id')
                ->where('uuid', $uuid)->first();
            $tools = WorkingTool::all();
            $users = User::where('designation_id', '!=', null)->get();
            $skillCategories = SkillCategory::get();
            $hireRequisitionJobs = $this->hireRequisitionJobRepository->getQuery()->where('hr_hire_requisitions_jobs.hire_requisition_id', $hireRequisition->id)->get();
            $hireRequisitionJobs->map(function ($item) {
                $item['working_tools'] = HireRequisitionWorkingTool::select("working_tools.name as name")
                    ->join('working_tools', 'working_tools.id', 'hr_hire_requisition_working_tools.working_tool_id')
                    ->where('hr_hire_requisition_working_tools.hr_requisitions_jobs_id', $item->id)->get()->implode('name', ',');
                $item['regions'] = HireRequisitionLocation::select("regions.name as name")
                    ->join('regions', 'regions.id', 'hr_hire_requisition_locations.region_id')
                    ->where('hr_hire_requisition_locations.hr_requisition_job_id', $item->id)->get()->implode('name', ',');
                $item['skills'] =   $this->hireUserSkillsRepository->getQuery()->select('skills.name as name')
                    ->join('skills', 'skills.id', 'skill_user.skill_id', 'skills.id')
                    ->where('hr_requisition_job_id', $item->id)->get();
                $item['_education_level'] =  code_value()->query()->where('id', $item['education_level'])->first();
                $item['establishment'] = code_value()->query()->where('id', $item['establishment'])->first()->name;
            });


            return view('HumanResource.HireRequisition._parent.form.create')
                ->with('prospects', code_value()->query()->where('code_id', 7)->get())
                ->with('contract_types', code_value()->query()->where('code_id', 8)->get())
                ->with('establishments', code_value()->query()->where('code_id', 9)->get())
                ->with('education_levels', code_value()->query()->where('code_id', 10)->get())
                ->with('language_proficiencies', code_value()->query()->where('code_id', 13)->get())
                ->with('departments', $this->departments->getAll())
                ->with('designations', $this->designation->getActiveForSelect())
                ->with('tools', $tools)
                ->with('users', $users)
                ->with('initiate', true)
                ->with('uuid', $uuid)
                ->with('skillCategories', $skillCategories)
                ->with('hireRequisitionJobs', $hireRequisitionJobs)
                ->with('current_level', 1)
                ->with('regions', $this->regions->getAll());
        } else
            return redirect()->back()->with('error', 'invalid parameter');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            $hireRequisition = $this->hireRequisitionRepository->store($data);
            $data['hire_requisition_id'] = $hireRequisition->id;
            $hr_requisition_job = $this->hireRequisitionJobRepository->store($data);
            $workingtools = ['tools' => $data['tools'], 'hire_requisition_job_id' => $hr_requisition_job->id];
            $regions = $data['region'];
            // return $regions;
            $data['hire_requisition_job_id'] = $hr_requisition_job->id;
            $data['hr_requisition_job_id'] = $hr_requisition_job->id;
            if ($request->establishment ==   22) {
                $hr_requisition_job = $this->hireRequisitionReplacedStaffRepository->store($data);
            }
            $this->hireRequisitionLocationRepository->store($data);
            $this->hireUserSkillsRepository->store($data);
            $this->hireRequisitionWorkingToolRepository->store($workingtools);
            alert()->success('Hire Requisition Created Successfully', 'success');
            DB::commit();
            return redirect()->route('HireRequisition.initiate', $hireRequisition->uuid);
        } catch (\Exception $e) {
            DB::rollback();
            throw new GeneralException($e->getMessage());
        }
    }


    public function addRequisition(Request $request, $uuid)
    {
        $data = $request->all();;
        if ($data['submit_job_requisition'] == 'save') {
            return "save";
        } else if ($data['submit_job_requisition'] == 'add') {
            try {
                DB::beginTransaction();
                $hire_requisition_id = $this->hireRequisitionRepository->findByUuid($uuid)->id;
                $data['hire_requisition_id'] = $hire_requisition_id;
                $hire_requisition_job = $this->hireRequisitionJobRepository->store($data);
                $workingtools = ['tools' => $data['tools'], 'hire_requisition_job_id' => $hire_requisition_job->id];
                $regions = $data['region'];
                $data['hr_requisition_job_id'] = $hire_requisition_job->id;
                foreach ($regions as $region) {
                    $region_data['hr_requisition_job_id'] = $hire_requisition_job->id;
                    $region_data['region_id'] = $region;
                    HireRequisitionLocation::create($region_data);
                }
                if ($request->establishment ==   22) {
                    $this->hireRequisitionReplacedStaffRepository->store($data);
                }
                $this->hireRequisitionWorkingToolRepository->store($workingtools);
                $this->hireUserSkillsRepository->store($data);
                alert()->success('Hire Requisition Created Successfully', 'success');
                DB::commit();
                return redirect()->route('HireRequisition.initiate', $uuid);
            } catch (\Exception $e) {
                DB::rollback();
                throw new \Exception($e->getMessage());
            }
        } else {
            return redirect()->back();
        }
    }



    public function submit(Request $request, $uuid)
    {

        try {
            DB::beginTransaction();
            $hireRequisition = $this->hireRequisitionRepository->findByUuid($uuid);
            $hire_requisition_id = $hireRequisition->id;
            $wf_done  = $hireRequisition->done;
            $this->hireRequisitionRepository->submit($uuid);
            $wf_module_group_id = 8;
            $next_user = $hireRequisition->user->assignedSupervisor()->supervisor_id;
            $this->startWorkflow($hireRequisition, 1,  $next_user);
            // event(new NewWorkflow(['wf_module_group_id' => $wf_module_group_id, 'resource_id' => $hireRequisition->id, 'region_id' => $hireRequisition->region_id, 'type' => 1], [], ['next_user_id' => $next_user]));
            alert()->success('Hire Requisition Created Successfully', 'success');
            DB::commit();
            return redirect()->route('HireRequisition.show', $uuid);
        } catch (\Exception $e) {
            DB::rollback();
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show($uuid)
    {
        $hireRequisition = $this->hireRequisitionRepository->query()
            ->select('hr_hire_requisitions.*', 'departments.title as department')
            ->join('departments', 'departments.id', 'hr_hire_requisitions.department_id')
            ->where('uuid', $uuid)->first();

        /* Check workflow */
        $wf_module_group_id = 8;
        $wf_module = $this->wf_tracks->getWfModuleAfterWorkflowStart($wf_module_group_id, $hireRequisition->id);

        $workflow = new Workflow(['wf_module_group_id' => $wf_module_group_id, "resource_id" => $hireRequisition->id, 'type' => $wf_module->type]);
        $check_workflow = $workflow->checkIfHasWorkflow();
        $current_wf_track = $workflow->currentWfTrack();
        $wf_module_id = $workflow->wf_module_id;
        $current_level = $workflow->currentLevel();
        $can_edit_resource = $this->wf_tracks->canEditResource($hireRequisition, $current_level, $workflow->wf_definition_id);

        $hireRequisitionJobs = $this->hireRequisitionJobRepository->getQuery()->where('hr_hire_requisitions_jobs.hire_requisition_id', $hireRequisition->id)->get();
        $hireRequisitionJobs->map(function ($item) {
            $item['working_tools'] = HireRequisitionWorkingTool::select("working_tools.name as name")
                ->join('working_tools', 'working_tools.id', 'hr_hire_requisition_working_tools.working_tool_id')
                ->where('hr_hire_requisition_working_tools.hr_requisitions_jobs_id', $item->id)->get()->implode('name', ',');

            $item['regions'] = HireRequisitionLocation::select("regions.name as name")
                ->join('regions', 'regions.id', 'hr_hire_requisition_locations.region_id')
                ->where('hr_hire_requisition_locations.hr_requisition_job_id', $item->id)->get()->implode('name', ',');
            $item['skills'] =   $this->hireUserSkillsRepository->getQuery()->select('skills.name as name')
                ->join('skills', 'skills.id', 'skill_user.skill_id', 'skills.id')
                ->where('hr_requisition_job_id', $item->id)->get();
            $item['establishment'] = code_value()->query()->where('id', $item['establishment'])->first()->name;
            $item['_education_level'] =  code_value()->query()->where('id', $item['education_level'])->first();
            return $item;
        });

        return view('HumanResource.HireRequisition._parent.display.show')
            ->with('hireRequisition', $hireRequisition)
            ->with('current_level', $current_level)
            ->with('current_wf_track', $current_wf_track)
            ->with('can_edit_resource', $can_edit_resource)
            ->with('hireRequisitionJobs', $hireRequisitionJobs)

            ->with('wfTracks', (new WfTrackRepository())->getStatusDescriptions($hireRequisition));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit(HireRequisitionJob $hireRequisitionJob)
    {
        $hireRequisitionJobs = $this->hireRequisitionJobRepository->getQuery()->where('hr_hire_requisitions_jobs.id', $hireRequisitionJob->id)->first();
        $current_working_tools = HireRequisitionWorkingTool::select("working_tools.id as id")
            ->join('working_tools', 'working_tools.id', 'hr_hire_requisition_working_tools.working_tool_id')
            ->where('hr_hire_requisition_working_tools.hr_requisitions_jobs_id', $hireRequisitionJobs->id)->pluck('id')->toArray();
        $current_regions = HireRequisitionLocation::select("regions.id as id")
            ->join('regions', 'regions.id', 'hr_hire_requisition_locations.region_id')
            ->where('hr_hire_requisition_locations.hr_requisition_job_id', $hireRequisitionJobs->id)->pluck('id')->toArray();

        $skillCategories = SkillCategory::get();
        $tools = WorkingTool::all();
        $skill_users  = SkillUser::where('hr_requisition_job_id', $hireRequisitionJobs->id)->pluck('skill_id')->toArray();;
        $skills  = Skill::all();
        $users = User::where('designation_id', '!=', null)->get();
        return view('HumanResource.HireRequisition._parent.form.edit')
            ->with('prospects', code_value()->query()->where('code_id', 7)->get())
            ->with('_prospects', code_value()->query()->where('code_id', 7)->get()->pluck('name', 'id'))
            ->with('conditions', code_value()->query()->where('code_id', 8)->get()->pluck('name', 'id'))
            ->with('establishments', code_value()->query()->where('code_id', 9)->get())
            ->with('education_levels', code_value()->query()->where('code_id', 10)->get())
            ->with('language_proficiencies', code_value()->query()->where('code_id', 13)->get())
            ->with('contract_types', code_value()->query()->where('code_id', 8)->get())
            ->with('departments', $this->departments->getAll())
            ->with('designations', $this->designation->getActiveForSelect())
            ->with('tools', $tools)
            ->with('current_working_tools', $current_working_tools)
            ->with('hireRequisitionJobs', $hireRequisitionJobs)
            ->with('regions', $this->regions->getAll())
            ->with('current_regions', $current_regions)
            ->with('skillCategories', $skillCategories)
            ->with('skill_users', $skill_users)
            ->with('skills', $skills)
            ->with('users', $users);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Listing $hireRequisition
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $hireRequisition)
    {
        $data = $request->all();
        $hire_requisition_job = $this->hireRequisitionJobRepository->getQuery()->where('hr_hire_requisitions_jobs.id', $hireRequisition)->first();
        $hire_requisition_uuid = $this->hireRequisitionRepository->getQuery()->find($hire_requisition_job->hire_requisition_id);
        $data['hire_requisition_id'] = $hire_requisition_job->hire_requisition_id;
        $data['hr_requisition_job_id'] = $hire_requisition_job->id;
        $data['hire_requisition_job_id'] = $hire_requisition_job->id;
        try {
            DB::beginTransaction();
            $this->hireRequisitionJobRepository->update($data);
            $this->hireRequisitionLocationRepository->update($data);
            $this->hireRequisitionWorkingToolRepository->update($data);
            $this->hireUserSkillsRepository->update($data);
            alert()->success('Hire Requisition Updated Successfully');
            DB::commit();
            return redirect()->route('HireRequisition.initiate', $hire_requisition_uuid);
        } catch (\Exception $e) {
            DB::rollback();
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(HireRequisitionJob $hireRequisitionJob)
    {
        try {
            DB::beginTransaction();
            $hireRequisitionJob->delete();
            alert()->success('Hire Requisition deleted Successfully');
            DB::commit();
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            throw new \Exception($e->getMessage());
        }
    }

    public function getVacancies()
    {
        $hireRequisitions = HireRequisition::where('is_active', true)->get();
        return view('HireRequisition.vacancy.index')
            ->with('hireRequisitions', $hireRequisitions);
    }

    public function getVacancy(HireRequisition $hireRequisition)
    {
        return view('HireRequisition.vacancy.show')
            ->with('hireRequisition', $hireRequisition);
    }


    public function getSkills(Request $request)
    {
        $skills = Skill::where('skill_category_id', $request->skill_category_id)->get();
        return response()->json($skills);
    }
    public function getDesignationByDepertment($department_id){
        // return $department_id;
        return $this->designation->getDesignationByDepertment($department_id);
    }
}
