<?php

namespace App\Http\Controllers\Web\HumanResource\HireRequisition;

use App\Events\NewWorkflow;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\HumanResource\HireRequisition\Traits\HireRequisitionDatatable;
use App\Models\Auth\User;
use App\Models\HumanResource\HireRequisition\HireRequisition;
use App\Models\HumanResource\HireRequisition\HireRequisitionJob;
use App\Models\HumanResource\HireRequisition\HireRequisitionLocation;
use App\Models\HumanResource\HireRequisition\HireRequisitionWorkingTool;
use App\Repositories\Access\UserRepository;
use App\Repositories\HumanResource\HireRequisition\HireRequisitionJobRepository;
use App\Repositories\HumanResource\HireRequisition\HireRequisitionRepository;
use App\Repositories\Designation\DesignationRepository;
use App\Repositories\System\RegionRepository;
use App\Repositories\Unit\DepartmentRepository;
use App\Repositories\Workflow\WfTrackRepository;
use App\Services\Workflow\Workflow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\System\WorkingTool;
use Illuminate\Support\Facades\View;
use App\Repositories\HumanResource\HireRequisition\HireRequisitionWorkingToolRepository;
use Illuminate\Support\Facades\DB;
class HireRequisitionController extends Controller
{
    use HireRequisitionDatatable;
    protected $hireRequisition;
    protected $hireRequisitionJobRepository;
    protected $regions;
    protected $departments;
    protected $users;
    protected $wf_tracks;
    protected $designation;
    protected $hireRequisitionWorkingToolRepository;

    public  function __construct()
    {
        $this->hireRequisition = (new HireRequisitionRepository());
        $this->hireRequisitionJobRepository = (new HireRequisitionJobRepository);
        $this->regions = (new RegionRepository());
        $this->departments = (new DepartmentRepository());
        $this->designation = (new DesignationRepository());
        $this->users = (new UserRepository());
        $this->wf_tracks = (new WfTrackRepository());
        $this->hireRequisitionWorkingToolRepository = (new HireRequisitionWorkingToolRepository());
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
       
        $tools = WorkingTool::all();
        $users = User::where('designation_id', '!=', null)->get();
        return view('HumanResource.HireRequisition._parent.form.create')
            ->with('prospects', code_value()->query()->where('code_id', 7)->get())
            ->with('contract_types', code_value()->query()->where('code_id', 8)->get())
            ->with('establishments', code_value()->query()->where('code_id', 9)->get())
            ->with('departments', $this->departments->getAll())
            ->with('designations', $this->designation->getAll())
            ->with('tools', $tools )
            ->with('users', $users)
            ->with('regions', $this->regions->getAll());
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function initiate($uuid)
    {       
        if(isset($uuid) && !empty($uuid)){
            $tools = WorkingTool::all();
            $users = User::where('designation_id', '!=', null)->get();
            $hire_requisition_id = $this->hireRequisition->findByUuid($uuid)->id;
            $hireRequisitionJobs = $this->hireRequisitionJobRepository->getQuery()->where('hr_hire_requisitions_jobs.hire_requisition_id',$hire_requisition_id)->get();
            $hireRequisitionJobs->map(function($item){
                $item['working_tools'] = HireRequisitionWorkingTool::select("working_tools.name as name")                
                                ->join('working_tools','working_tools.id','hr_hire_requisition_working_tools.working_tool_id')
                                ->where('hr_hire_requisition_working_tools.hr_requisitions_jobs_id',$item->id)->get()->implode('name', ',');

                $item['regions'] = HireRequisitionLocation::select("regions.name as name")                
                                ->join('regions','regions.id','hr_hire_requisition_locations.region_id')
                                ->where('hr_hire_requisition_locations.hr_requisition_job_id',$item->id)->get()->implode('name', ',');
                return $item;
            });
            return view('HumanResource.HireRequisition._parent.form.create')
                ->with('prospects', code_value()->query()->where('code_id', 7)->get())
                ->with('contract_types', code_value()->query()->where('code_id', 8)->get())
                ->with('establishments', code_value()->query()->where('code_id', 9)->get())
                ->with('departments', $this->departments->getAll())
                ->with('designations', $this->designation->getAll())
                ->with('tools', $tools )
                ->with('users', $users)
                ->with('initiate',true)
                ->with('hireRequisitionJobs',$hireRequisitionJobs)
                ->with('uuid',$uuid)
                ->with('regions', $this->regions->getAll());
        }else
            return redirect()->back()->with('error','invalid parameter');
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
                $hireRequisition = $this->hireRequisition->store($data);  
                $data['hire_requisition_id'] = $hireRequisition->id;
                $hr_requisition_job = $this->hireRequisitionJobRepository->store($data);
                $workingtools = [ 'tools' => $data['tools'],'hire_requisition_job_id'=> $hr_requisition_job->id ];
                $regions = $data['region'];
                foreach($regions as $region){
                    $data['hr_requisition_job_id'] = $hr_requisition_job->id;
                    $data['region_id'] = $region;
                    HireRequisitionLocation::create($data);

                }
                $this->hireRequisitionWorkingToolRepository->store($workingtools);
              
                alert()->success('Hire Requisition Created Successfully','success');             
            DB::commit();
           
            return redirect()->route('hirerequisition.initiate', $hireRequisition->uuid);

        }catch (\Exception $e){
            DB::rollback();
            throw new \Exception($e->getMessage());
        }

        
    }


    public function addRequisition(Request $request,$uuid)
    {
        $data = $request->all();
        if($data['submit_job_requisition'] == 'save'){
            return "save";
        }else if($data['submit_job_requisition'] == 'add'){
            try {
                DB::beginTransaction();
                    $hire_requisition_id = $this->hireRequisition->findByUuid($uuid)->id;
                    $data['hire_requisition_id'] = $hire_requisition_id;
                    $hire_requisition_job = $this->hireRequisitionJobRepository->store($data);
                    $workingtools = [ 'tools' => $data['tools'],'hire_requisition_job_id'=> $hire_requisition_job->id ];
                    $regions = $data['region'];
                    foreach($regions as $region){
                        $data['hr_requisition_job_id'] = $hire_requisition_job->id;
                        $data['region_id'] = $region;
                        HireRequisitionLocation::create($data);
    
                    }               
                    $this->hireRequisitionWorkingToolRepository->store($workingtools);
                    alert()->success('Hire Requisition Created Successfully','success');             
                DB::commit();
                return redirect()->route('hirerequisition.initiate', $uuid);
    
            }catch (\Exception $e){
                DB::rollback();
                throw new \Exception($e->getMessage());
            }   
        }else if($data['submit_job_requisition'] == 'submit'){
            try {
                DB::beginTransaction();
                    $hire_requisition_id = $this->hireRequisition->findByUuid($uuid)->id;
                    $data['hire_requisition_id'] = $hire_requisition_id;
                    $hire_requisition_job = $this->hireRequisitionJobRepository->store($data);
                    $workingtools = [ 'tools' => $data['tools'],'hire_requisition_job_id'=> $hire_requisition_job->id ];
                    $regions = $data['region'];
                    foreach($regions as $region){
                        $data['hr_requisition_job_id'] = $hire_requisition_job->id;
                        $data['region_id'] = $region;
                        HireRequisitionLocation::create($data);
    
                    }               
                    $this->hireRequisitionWorkingToolRepository->store($workingtools);
                    alert()->success('Hire Requisition Created Successfully','success');             
                DB::commit();
                return redirect()->route('hirerequisition.initiate', $uuid);
    
            }catch (\Exception $e){
                DB::rollback();
                throw new \Exception($e->getMessage());
            }   
        }else{
            return redirect()->back();
        }
      
         
    }


    public function submit(Request $request,$uuid){
   
        $hireRequisition = $this->hireRequisition->findByUuid($uuid);
        $hire_requisition_id = $hireRequisition->id;
        $wf_done  = $hireRequisition->done;
        $this->hireRequisition->submit($uuid);
        $wf_module_group_id = 8;
        $next_user = $hireRequisition->user->assignedSupervisor()->supervisor_id;
        event(new NewWorkflow(['wf_module_group_id' => $wf_module_group_id, 'resource_id' => $hireRequisition->id,'region_id' => $hireRequisition->region_id, 'type' => 1],[],['next_user_id' => $next_user]));
        alert()->success('Hire Requisition Created Successfully','success');  
        return redirect()->route('hirerequisition.initiate', $uuid);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show($uuid)
    {
        $hireRequisition = $this->hireRequisition->findByUuid($uuid);
        
        /* Check workflow */
        $wf_module_group_id = 8; 
        $wf_module = $this->wf_tracks->getWfModuleAfterWorkflowStart($wf_module_group_id, $hireRequisition->id);
    
        $workflow = new Workflow(['wf_module_group_id' => $wf_module_group_id, "resource_id" => $hireRequisition->id, 'type' => $wf_module->type]);
        $check_workflow = $workflow->checkIfHasWorkflow();
        $current_wf_track = $workflow->currentWfTrack();
        $wf_module_id = $workflow->wf_module_id;
        $current_level = $workflow->currentLevel();
        $can_edit_resource = $this->wf_tracks->canEditResource($hireRequisition, $current_level, $workflow->wf_definition_id);
        
        $hireRequisitionJobs = $this->hireRequisitionJobRepository->getQuery()->where('hr_hire_requisitions_jobs.hire_requisition_id',$hireRequisition->id)->get();
        $hireRequisitionJobs->map(function($item){
            $item['working_tools'] = HireRequisitionWorkingTool::select("working_tools.name as name")                
                            ->join('working_tools','working_tools.id','hr_hire_requisition_working_tools.working_tool_id')
                            ->where('hr_hire_requisition_working_tools.hr_requisitions_jobs_id',$item->id)->get()->implode('name', ',');

            $item['regions'] = HireRequisitionLocation::select("regions.name as name")                
                            ->join('regions','regions.id','hr_hire_requisition_locations.region_id')
                            ->where('hr_hire_requisition_locations.hr_requisition_job_id',$item->id)->get()->implode('name', ',');
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
    public function edit(HireRequisition $hireRequisition)
    {
        $tools = WorkingTool::all();
        $users = User::where('designation_id', '!=', null)->get();
        return view('hireRequisition._parent.form.edit')
            ->with('hireRequisition', $hireRequisition)
            ->with('prospects', code_value()->query()->where('code_id', 7)->get()->pluck('name','id'))
            ->with('conditions', code_value()->query()->where('code_id', 8)->get()->pluck('name','id'))
            ->with('establishments', code_value()->query()->where('code_id', 9)->get()->pluck('name','id'))
            ->with('departments', $this->departments->getAll()->pluck('title','id'))
            ->with('tools', $tools )
            ->with('working_tools', $hireRequisition->workingTools->pluck('id')->toArray())
            ->with('users', $users)
            ->with('regions', $this->regions->getAll()->pluck('name','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Listing $hireRequisition
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, HireRequisition $hireRequisition)
    {
        //$this->hireRequisition->update($request->all(), $hireRequisition);
        alert()->success('Hire Requisition Updated Successfully');
        return redirect()->route('hireRequisition.show', $hireRequisition);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getVacancies() {
        $hireRequisitions = HireRequisition::where('is_active', true)->get();
        return view('hireRequisition.vacancy.index')
            ->with('hireRequisitions', $hireRequisitions);
    }

    public function getVacancy(HireRequisition $hireRequisition){
        return view('hireRequisition.vacancy.show')
            ->with('hireRequisition', $hireRequisition);
    }
}
