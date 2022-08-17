<?php
namespace App\Http\Controllers\Web\HumanResource\Advertisement;
use App\Events\NewWorkflow;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\HumanResource\Advertisement\Traits\AdvertisementDatatable;
use App\Models\Auth\User;
use App\Models\HumanResource\Advertisement\HireAdvertisementRequisition;
use App\Models\System\WorkingTool;
use App\Repositories\Access\UserRepository;
use App\Repositories\HumanResource\HireRequisition\HireRequisitionRepository;
use App\Repositories\HumanResource\HireRequisition\HireRequisitionJobRepository;
use App\Repositories\System\RegionRepository;
use App\Repositories\Unit\DepartmentRepository;
use App\Repositories\Workflow\WfTrackRepository;
use App\Repositories\Designation\DesignationRepository;
use App\Services\Workflow\Workflow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\HumanResource\HireRequisition\HireRequisition;
use App\Models\HumanResource\HireRequisition\SkillCategory;
use App\Models\HumanResource\HireRequisition\Skill;
use App\Models\HumanResource\HireRequisition\HireRequisitionJob;
use App\Models\HumanResource\HireRequisition\HireRequisitionLocation;
use App\Models\HumanResource\HireRequisition\HireRequisitionWorkingTool;
use App\Repositories\HumanResource\Advertisement\AdvertisementRepository;
use App\Services\Workflow\Traits\WorkflowInitiator;
use Illuminate\Support\Facades\DB;

class AdvertisementController extends Controller
{
    use AdvertisementDatatable,WorkflowInitiator;
    protected $advertisementRepository;
    protected $regions;
    protected $departments;
    protected $users;
    protected $wf_tracks;
    protected $designation;
    protected $hireRequisitionJobRepository;
    protected $hireRequisitionRepository;

    public  function __construct()
    {
        $this->advertisementRepository = (new AdvertisementRepository());
        $this->regions = (new RegionRepository());
        $this->departments = (new DepartmentRepository());
        $this->users = (new UserRepository());
        $this->wf_tracks = (new WfTrackRepository());
        $this->designation = (new DesignationRepository());
        $this->hireRequisitionJobRepository = (new HireRequisitionJobRepository);
        $this->hireRequisitionRepository = (new HireRequisitionRepository);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|View|\Illuminate\View\View
     */
    public function index()
    {
        return view('HumanResource/HireRequisition/advertisement/advertisement');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $hireRequisitionJobs = $this->hireRequisitionJobRepository
                                ->getAprovedJobs()
                                ->where("is_advertised",0)
                                ->get();
            
        $tools = WorkingTool::all();
        $users = User::where('designation_id', '!=', null)->get();
        $skillCategories = SkillCategory::get();
        return view('HumanResource.HireRequisition.advertisement.form.create')
            ->with('prospects', code_value()->query()->where('code_id', 7)->get())
            ->with('contract_types', code_value()->query()->where('code_id', 8)->get())
            ->with('establishments', code_value()->query()->where('code_id', 9)->get())
            ->with('education_levels', code_value()->query()->where('code_id', 10)->get())
            ->with('language_proficiencies', code_value()->query()->where('code_id', 13)->get())
            ->with('departments', $this->departments->getAll())
            ->with('designations', $this->designation->getAll())
            ->with('tools', $tools)
            ->with('users', $users)
            ->with('hireRequisitionJobs', $hireRequisitionJobs)
            ->with('skillCategories', $skillCategories)
            ->with('regions', $this->regions->getAll());
    }
    public function post()
    {
        // $advert = $this->hireRequisitionJobRepository
        //                         ->getAprovedJobs()
        //                         ->where("is_advertised",0)
        //                         ->whereNull("posted_on")
        //                         ->get();
        // return $hireRequisitionJobs;
        $advertisements = $this->advertisementRepository->getAccessProvedDatatable()
                        ->get();
        $tools = WorkingTool::all();
        $users = User::where('designation_id', '!=', null)->get();
        $skillCategories = SkillCategory::get();
        return view('HumanResource.HireRequisition.advertisement.form.post')
            ->with('prospects', code_value()->query()->where('code_id', 7)->get())
            ->with('contract_types', code_value()->query()->where('code_id', 8)->get())
            ->with('establishments', code_value()->query()->where('code_id', 9)->get())
            ->with('education_levels', code_value()->query()->where('code_id', 10)->get())
            ->with('language_proficiencies', code_value()->query()->where('code_id', 13)->get())
            ->with('departments', $this->departments->getAll())
            ->with('designations', $this->designation->getAll())
            ->with('tools', $tools)
            ->with('users', $users)
            ->with('advertisements', $advertisements)
            ->with('skillCategories', $skillCategories)
            ->with('regions', $this->regions->getAll());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        try{
            DB::beginTransaction();
                $advertisement = $this->advertisementRepository->store($request->all());
                $advertisement->update(['done'=>1]);
                $hireRequisitionJob =  $this->hireRequisitionJobRepository->find($advertisement->hire_requisition_job_id);
                // $hireRequisitionJob->update(['is_advertised'=>1]);
                $next_user = $this->users->getDirectorOfHR()->first()->user_id;
                $this->startWorkflow($advertisement , 1,  $next_user);
                $this->advertisementRepository->submit($advertisement);
                alert()->success('Hire Requisition Created Successfully','success');
            DB::commit();
            return redirect()->route('advertisement.index');
        }catch (\Exception $e){
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
    public function show(HireAdvertisementRequisition $advertisement)
    {

        // $advertisement = $this->advertisementRepository->query()->where('uuid',$uuid)->first();
        /* Check workflow */
        $wf_module_group_id = 11;
        $wf_module = $this->wf_tracks->getWfModuleAfterWorkflowStart($wf_module_group_id, $advertisement->id);
        $workflow = new Workflow(['wf_module_group_id' => $wf_module_group_id, "resource_id" => $advertisement->id, 'type' => $wf_module->type]);
        $current_wf_track = $workflow->currentWfTrack();
        $current_level = $workflow->currentLevel();
        $can_edit_resource = $this->wf_tracks->canEditResource($advertisement, $current_level, $workflow->wf_definition_id);
        return view('HumanResource.HireRequisition.advertisement.display.show')
            ->with('_advertisement',$advertisement)
            ->with('current_level', $current_level)
            ->with('current_wf_track', $current_wf_track)
            ->with('can_edit_resource', $can_edit_resource)
            ->with('wfTracks', (new WfTrackRepository())->getStatusDescriptions($advertisement));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit(HireAdvertisementRequisition $advertisement)
    {
        return $advertisement;
    }

    public function initiate($uuid)
    {
        $hireRequisitionJob = $this->hireRequisitionJobRepository->getQuery()->with('reportTo')->where('hr_hire_requisitions_jobs.uuid',$uuid)->first();
        $hireRequisition = $this->hireRequisitionRepository
                            ->getQuery()
                            ->where('hire_requisition_id',$hireRequisitionJob->hire_requisition_id)
                            ->first();
        $tools = WorkingTool::all();
        $users = User::where('designation_id', '!=', null)->get();
        $skillCategories = SkillCategory::get();
        return view('HumanResource.HireRequisition.advertisement.form.initiate')
            ->with('prospects', code_value()->query()->where('code_id', 7)->get())
            ->with('contract_types', code_value()->query()->where('code_id', 8)->get())
            ->with('establishments', code_value()->query()->where('code_id', 9)->get())
            ->with('education_levels', code_value()->query()->where('code_id', 10)->get())
            ->with('language_proficiencies', code_value()->query()->where('code_id', 13)->get())
            ->with('departments', $this->departments->getAll())
            ->with('designations', $this->designation->getAll())
            ->with('tools', $tools)
            ->with('users', $users)
            ->with('hireRequisitionJob', $hireRequisitionJob)
            ->with('hireRequisition', $hireRequisition)
            ->with('skillCategories', $skillCategories)
            ->with('regions', $this->regions->getAll());
    }
    public function publish(HireAdvertisementRequisition $advertisement)
    {
        $hireRequisitionJob =  $this->hireRequisitionJobRepository->find($advertisement->hire_requisition_job_id);
        $hireRequisitionJob->update(['is_advertised'=>1]);
        return view('HumanResource.HireRequisition.advertisement.form.publish')
            ->with('_advertisement', $advertisement);
    }
    public function postAdvertisement(Request $request,HireAdvertisementRequisition $advertisement)
    {
      
  
        
        $advertisement->update(['dead_line'=> $request->dead_line]);
        alert()->success('Advertisement Posted Successfully','success');
        return redirect()->route('advertisement.post');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Listing $listing
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, HireAdvertisementRequisition $advertisement)
    {
        $advertisement = $this->advertisementRepository->update($request->all(), $advertisement);
        alert()->success('Hire Requisition Updated Successfully');
        return redirect()->route('listing.show', $advertisement);
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
        $listings = Listing::where('is_active', true)->get();
        return view('listing.vacancy.index')
            ->with('listings', $listings);
    }

    public function getVacancy(Listing $listing){
        return view('listing.vacancy.show')
            ->with('listing', $listing);
    }
}
