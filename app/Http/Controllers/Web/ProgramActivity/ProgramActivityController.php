<?php

namespace App\Http\Controllers\Web\ProgramActivity;

use App\Events\NewWorkflow;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\ProgramActivity\Datatable\ProgramActivityDatatable;
use App\Models\Auth\SupervisorUser;
use App\Models\Auth\User;
use App\Models\GOfficer\GOfficer;
use App\Models\ProgramActivity\ProgramActivity;
use App\Models\Requisition\Requisition;
use App\Models\Requisition\Training\requisition_training;
use App\Models\Requisition\Training\requisition_training_cost;
use App\Models\Requisition\Training\requisition_training_item;
use App\Repositories\Access\SupervisorUserRepository;
use App\Repositories\GOfficer\GOfficerRepository;
use App\Repositories\ProgramActivity\ProgramActivityRepository;
use App\Repositories\Requisition\RequisitionRepository;
use App\Repositories\Requisition\Training\RequestTrainingCostRepository;
use App\Repositories\Requisition\Training\RequisitionTrainingItemsRepository;
use App\Repositories\Requisition\Training\RequisitionTrainingRepository;
use App\Repositories\System\DistrictRepository;
use App\Repositories\Unit\DesignationRepository;
use App\Repositories\Workflow\WfTrackRepository;
use App\Services\Workflow\Workflow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProgramActivityController extends Controller
{
    use ProgramActivityDatatable;
    protected $trainings;
    protected $program_activity;
    protected $districts;
    protected $requisition;
    protected $trainingCost;
    protected $gOfficer;
    protected $wf_tracks;
    protected $designations;
    protected $requisition_training_cost;
    protected $requisition_training_items;
    protected $supervisorUser;


    public function __construct()
    {
        $this->trainings = (new RequisitionTrainingRepository());
        $this->program_activity = (new ProgramActivityRepository());
        $this->districts = (new DistrictRepository());
        $this->requisition = (new RequisitionRepository());
        $this->trainingCost = (new RequestTrainingCostRepository());
        $this->gOfficer =  (new GOfficerRepository());
        $this->wf_tracks = (new WfTrackRepository());
        $this->designations = (new DesignationRepository());
        $this->requisition_training_cost = (new RequestTrainingCostRepository());
        $this->requisition_training_items =  (new RequisitionTrainingItemsRepository());
        $this->supervisorUser =  (new  SupervisorUserRepository());
    }

    public function index()
    {
        return view('programactivity.index')
            ->with('program_activities',  $this->program_activity = (new ProgramActivityRepository()));
    }

    public  function  create(ProgramActivity $programActivity)
    {
        $training_costs =  requisition_training_cost::all()->where('requisition_id', $programActivity->requisition_id);
        $requisition_training = requisition_training::all()->where('id', $programActivity->requisition_training_id);
        $requisition_training_items = requisition_training_item::all()->where('requisition_id', $programActivity->requisition_id);
        $requisition = Requisition::all()->where('id', $programActivity->requisition_id);
//                dd($requisition);
//

        return view('programactivity.forms.create')
            ->with('requisition', $requisition)
            ->with('training_items', $requisition_training_items)
            ->with('requisition_training', $requisition_training)
            ->with('training_costs',$training_costs )
            ->with('district', $this->districts->getForPluck())
            ->with('program_activity', $programActivity);
    }
    public  function  initiate()
    {

        return view('programactivity.forms.initiate')
            ->with('trainings', $this->trainings->getPluckRequisitionNo());
    }
    public function store(Request $request)
    {
        //ddd($this->program_activity->store($request->all()));
        //ddd($request->all());
        $programActivity = $this->program_activity->store($request->all());
        return redirect()->route('programactivity.create', $programActivity);
    }
    public function update(Request $request, $uuid){

     $user = access()->user()->id;
        $this->program_activity->update($request->all(), $uuid);
        $program_activity =  $this->program_activity->findByUuid($uuid);
        $wf_module_group_id = 3;
//        dd($user);
        $next_user = $program_activity->user->assignedSupervisor()->supervisor_id;

        event(new NewWorkflow(['wf_module_group_id' => $wf_module_group_id, 'resource_id' => $program_activity->id,'region_id' => $program_activity->region_id, 'type' => 1],[],['next_user_id' => $next_user]));


        return redirect()->route('programactivity.show',$uuid);

    }
    public function show(ProgramActivity $programActivity)
    {
        /* Check workflow */
        $wf_module_group_id = 3;
        $wf_module = $this->wf_tracks->getWfModuleAfterWorkflowStart($wf_module_group_id, $programActivity->id);
        $workflow = new Workflow(['wf_module_group_id' => $wf_module_group_id, "resource_id" => $programActivity->id, 'type' => $wf_module->type]);
        $check_workflow = $workflow->checkIfHasWorkflow();
        $current_wf_track = $workflow->currentWfTrack();
        $wf_module_id = $workflow->wf_module_id;
        $current_level = $workflow->currentLevel();
        $can_edit_resource = $this->wf_tracks->canEditResource($programActivity, $current_level, $workflow->wf_definition_id);

        $designation = access()->user()->designation_id;
        $requisition_id = $programActivity->training()->get()->pluck('requisition_id');
        $requisitionss= $this->requisition->find($requisition_id);
        $requisition_training_items = requisition_training_item::all()->where('requisition_id', $requisition_id);
        $supervisor = SupervisorUser::where('user_id', $programActivity->user_id)->first();

//        dd($supervisor->supervisor_id);

        return view('programactivity.show')
            ->with('current_level', $current_level)
            ->with('current_wf_track', $current_wf_track)
            ->with('can_edit_resource', $can_edit_resource)
            ->with('wfTracks', (new WfTrackRepository())->getStatusDescriptions($programActivity))
            ->with('unit', $this->designations->getQueryDesignationUnit()->find($designation))
            ->with('program_activity',$programActivity)
            ->with('activity_details',$programActivity->training()->getQuery()->get()->all())
            ->with('activity_participants', $programActivity->training->trainingCost()->getQuery()->get()->all())
            ->with('gofficers', $this->gOfficer->getAll()->pluck('id','first_name'))
            ->with('requisition_uuid',   $this->requisition->find($requisition_id)->pluck('uuid')->toArray())
            ->with('training_items', $programActivity->training->trainingItems()->get()->all())
            ->with('supervisor', $supervisor->supervisor_id);
    }

    public function updateParticipant(Request $request, $uuid)
    {

        $this->program_activity->updateParticipant($request->all(), $uuid);
        dd($this->program_activity->findByUuid($uuid));
        return redirect(route('programactivity.show', $uuid));
    }
    public function editParticipant(ProgramActivityRepository $activityRepository, $uuid)
    {


       $requisition_training_cost = $this->requisition_training_cost->findByUuid($uuid);
       $gofficer_id = $requisition_training_cost->participant_uid;
       $training_id = $requisition_training_cost->requisition_training_id;
       $activity_uuid = $activityRepository->all()->where('requisition_training_id', $training_id)->pluck('uuid');


        $gofficer = GOfficer::all()->pluck('first_name', 'id');

//        dd($this->gOfficer->getQuery()->pluck('names', 'id'));
        return view('programactivity.forms.edit-participant')
            ->with('gofficers', $this->gOfficer->getQuery()->pluck('names', 'id'))
            ->with('existing_participant', $this->gOfficer->find($gofficer_id))
            ->with('requisition_training_cost_id', $requisition_training_cost->id)
            ->with('activity_uuid', $activity_uuid);

    }
    public function pay(RequestTrainingCostRepository $costRepository, $uuid)
    {
            return view('programactivity.forms.pay');
    }

    public function programActivityAttendance(Request $request, $uuid)
    {
        $this->program_activity->attended($request->all(), $uuid);
        return redirect()->back();
    }
    public function undoEverything(Request $request, $uuid)
    {
        $this->program_activity->undo($request->all(), $uuid);
        return redirect()->back();
    }

    public function programActivityReport(ProgramActivity $programActivity)
    {
//        dd($programActivity);
            return view('programactivity.forms.report')
                ->with('program_activity', $programActivity);
    }
    public function updateProgramActivity(Request $request, $uuid)
    {

        $this->program_activity->updateProgramActivity($request->all(), $uuid);

        return redirect(route('programactivity.show', $uuid));
    }
}
