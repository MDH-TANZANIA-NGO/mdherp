<?php

namespace App\Http\Controllers\Web\ProgramActivity;

use App\Events\NewWorkflow;
use App\Exports\ParticipantsExport;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\ProgramActivity\Datatable\ProgramActivityDatatable;
use App\Models\Auth\SupervisorUser;
use App\Models\Auth\User;
use App\Models\GOfficer\GOfficer;
use App\Models\GOfficer\Traits\Relationship\GOfficerRelationship;
use App\Models\ProgramActivity\ProgramActivity;
use App\Models\ProgramActivity\ProgramActivityAttendance;
use App\Models\ProgramActivity\ProgramActivityHotel;
use App\Models\Requisition\Requisition;
use App\Models\Requisition\Training\requisition_training;
use App\Models\Requisition\Training\requisition_training_cost;
use App\Models\Requisition\Training\requisition_training_item;
use App\Models\Requisition\Training\Traits\Relationship\RequisitionTrainingCostRelationship;
use App\Models\Requisition\Training\Traits\Relationship\RequisitionTrainingRelationship;
use App\Notifications\ProgramActivityReport\ProgramActivityReportNotification;
use App\Repositories\Access\SupervisorUserRepository;
use App\Repositories\GOfficer\GOfficerRepository;
use App\Repositories\Hotel\HotelRepository;
use App\Repositories\ProgramActivity\ProgramActivityAttendanceRepository;
use App\Repositories\ProgramActivity\ProgramActivityRepository;
use App\Repositories\Requisition\RequisitionRepository;
use App\Repositories\Requisition\Training\RequestTrainingCostRepository;
use App\Repositories\Requisition\Training\RequisitionTrainingItemsRepository;
use App\Repositories\Requisition\Training\RequisitionTrainingRepository;
use App\Repositories\System\DistrictRepository;
use App\Repositories\Unit\DesignationRepository;
use App\Repositories\Workflow\WfTrackRepository;
use App\Services\Workflow\Workflow;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Excel;

class ProgramActivityController extends Controller
{
    use ProgramActivityDatatable, GOfficerRelationship;


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
    protected $program_activity_attendance;
    protected $hotel;


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
        $this->program_activity_attendance = (new ProgramActivityAttendanceRepository());
        $this->hotel = (new HotelRepository());
    }


   /* This shows data table with all of user's activities with their status */

    public function index()
    {
        $supervisor = SupervisorUser::where('supervisor_id', access()->user()->id)->first();

        return view('programactivity.index')
            ->with('program_activities',  $this->program_activity = (new ProgramActivityRepository()))
            ->with('supervisor', $supervisor);
    }


  /*  This is landing page when you click program activity module*/

    public function workspace(){

        $supervisor = SupervisorUser::where('supervisor_id', access()->user()->id)->first();

       return view('programactivity.workspace')
           ->with('supervisor', $supervisor);

    }

  /*  View where user submits and creates program activity*/

    public  function  create(ProgramActivity $programActivity)
    {

        $training_costs =  requisition_training_cost::all()->where('requisition_id', $programActivity->requisition_id);
        $requisition_training = requisition_training::all()->where('id', $programActivity->requisition_training_id);
        $requisition_training_items = requisition_training_item::all()->where('requisition_id', $programActivity->requisition_id);
        $requisition = Requisition::all()->where('id', $programActivity->requisition_id);

        return view('programactivity.forms.create')
            ->with('hotels', $this->hotel->getHotelByRegion($programActivity->training->district->region->id)->pluck('name', 'id'))
            ->with('hotels_reserved', $this->hotel->getSelectedHotelForActivity($programActivity->id)->get())
            ->with('requisition', $requisition)
            ->with('training_items', $requisition_training_items)
            ->with('requisition_training', $requisition_training->first())
            ->with('training_costs',$training_costs )
            ->with('district', $this->districts->getForPluck())
            ->with('program_activity', $programActivity);
    }

  /*  View where user selects available requisition to initiate activity*/

    public  function  initiate()
    {

        return view('programactivity.forms.initiate')
            ->with('trainings', $this->trainings->getPluckRequisitionNo());
    }

    public function updateEventSchedule(Request $request, $uuid)
    {
        $training =  $this->trainings->findByUuid($uuid);
        $previous_no_days = $training->no_days;
        $no_days = getNoDays($request['from'], $request['to']);

        if ($no_days <= $previous_no_days)
        {
            $training->update($this->trainings->inputProcess($request));
            alert()->success('Event schedule updated successfully','Success');
        }
        if ($no_days > $previous_no_days){
            alert()->error('No days are limited to '.$previous_no_days.' days','Failed');
        }
        return redirect()->back();
    }

/*    Store initiated program activty*/
    public function store(Request $request)
    {

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

        alert()->success('Activity Submitted Successfully', 'Succeeded');
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
        $training_details =  requisition_training::query()->where('requisition_id', $requisition_id)->first();
        $attendance = $programActivity->attendance()->getQuery()->get();

        $group_attendance = $training_details->trainingCost()->whereHas('programActivityAttendance');

        return view('programactivity.display.show')
            ->with('current_level', $current_level)
            ->with('current_wf_track', $current_wf_track)
            ->with('can_edit_resource', $can_edit_resource)
            ->with('wfTracks', (new WfTrackRepository())->getStatusDescriptions($programActivity))
            ->with('unit', $this->designations->getQueryDesignationUnit()->find($designation))
            ->with('program_activity',$programActivity)
            ->with('requisition', Requisition::query()->where('id', $requisition_id)->first())
            ->with('attendance', $attendance)
            ->with('group_attendance', $group_attendance)
            ->with('activity_details',$training_details)
            ->with('activity_location', $training_details->district->name)
            ->with('activity_participants', $training_details->trainingCost()->get()->all())
            ->with('activity_participants_count', $training_details->trainingCost()->count())
            ->with('gofficers', $this->gOfficer->getAll()->pluck('id','first_name'))
            ->with('requisition_uuid',   $this->requisition->find($requisition_id)->pluck('uuid')->toArray())
            ->with('training_items', $training_details->trainingItems()->get()->all())
            ->with('training_items_count',$training_details->trainingItems()->count())
            ->with('supervisor', $supervisor->supervisor_id);
    }

    /*Function to Swap Participant in Activity*/
    public function updateParticipant(Request $request, $uuid)
    {
        $requisition_training_cost = $this->requisition_training_cost->find($request->get('requisition_training_cost_id'));
        $program_activity =  ProgramActivity::query()->where('requisition_training_id', $requisition_training_cost->requisition_training_id)->first();
        $participant = GOfficer::query()->where('uuid', $uuid)->first();
        $this->program_activity->updateParticipant($request->all(), $requisition_training_cost->uuid);
        alert()->success('Your Swap is Successfully', 'Success');
        return redirect()->route('programactivity.show', $program_activity->uuid);
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
            ->with('gofficers', $this->gOfficer->getQuery()->pluck('unique', 'id'))
            ->with('existing_participant', $this->gOfficer->find($gofficer_id))
            ->with('requisition_training_cost_id', $requisition_training_cost->id)
            ->with('activity_uuid', $activity_uuid);

    }
    public function pay(RequestTrainingCostRepository $costRepository, $uuid)
    {
        $training_cost = $this->requisition_training_cost->findByUuid($uuid);
        $requisition = Requisition::query()->where('id', $training_cost->requisition_id)->first();
        $program_activity =  ProgramActivity::query()->where('requisition_training_id', $training_cost->requisition_training_id)->first();
//        dd($this->requisition_training_cost->all()->where('uuid', $uuid));

        return view('programactivity.forms.pay')
            ->with('details', $this->requisition_training_cost->all()->where('uuid', $uuid))
            ->with('requisition', $requisition)
            ->with('program_activity', $program_activity);
    }

    public function programActivityAttendance(Request $request, $uuid)
    {

        $request['ids'] == null ? alert()->error('Select at least one participant','Error') : $this->program_activity->storeActivityAttendance($request['ids'],$uuid);
        return  redirect()->back();




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
        alert()->success('Activity Report Submitted Successfully', 'Succeeded');
        return redirect(route('programactivity.show', $uuid));
    }
    public function submitPayment(Request $request)
    {
        $this->program_activity->submitPayment($request->all());
        alert()->success('Payment Done Successfully', 'Succeeded');
        return redirect()->back();
    }
    public function submit($uuid)
    {
        DB::update('update program_activities set report_submitted = ? where uuid=?', [true, $uuid]);
        $program_activity =  $this->program_activity->findByUuid($uuid);
        $next_user = $program_activity->user->assignedSupervisor()->supervisor_id;
        $user =  User::query()->where('id', $next_user)->first();
        $user->notify(new ProgramActivityReportNotification($program_activity));

        return redirect()->back();
    }

    public  function reports(ProgramActivityRepository $programActivityRepository)

    {
//dd($this->program_activity->query()->where('supervised_by', access()->user()->id));
        return view('programactivity.reports.index')
            ->with('program_activities', $programActivityRepository);
    }
    public function approveReport(ProgramActivityRepository $programActivityRepository, $uuid, Request $request)
    {
//        dd($request->get('approval'));
        $uuid = $programActivityRepository->findByUuid($uuid)->uuid;
        $get_input =  $request->get('approval');
//        dd($get_input);
        if ($get_input ===  "true"){
            DB::update('update program_activities set report_approved = ?, report_rejected = ?, remarks = ? where uuid = ?',[true, false,  $request->get('remarks'), $uuid]);
        }
        elseif ($get_input ===  "false"){

            DB::update('update program_activities set report_approved = ?, report_rejected = ?, remarks = ? where uuid = ?',[false, true, $request->get('remarks'), $uuid]);

        }
        alert()->success('Report Approved', 'Succeeded');
        return redirect()->back();


    }

    public function viewParticipantAttendance(Request  $request, $id)
    {

        $attendance = $this->program_activity_attendance->getParticipantAttendanceofActivity($id);



        return view('programactivity.datatable.participants.attendance')
            ->with('attendance', $attendance);
    }

    public function exportParticipants( $uuid)
    {
        $program_activity =  $this->program_activity->findByUuid($uuid);

        return \Maatwebsite\Excel\Facades\Excel::download(new ParticipantsExport($program_activity), 'Activity:'.$program_activity->number.'participants.xlsx');

    }

    public function storeHotelReservation(Request $request)
    {
        $this->program_activity->storeHotelReservation($request);
        alert()->success('Hotel reserved successfully','Success');
        return redirect()->back();
    }
    public function removeHotel($uuid)
    {
        ProgramActivityHotel::query()->where('uuid', $uuid)->forceDelete();
        alert()->success('Hotel reserved deleted successfully','Success');
        return redirect()->back();
    }


    public function reserveHotel($uuid)
    {
        $reserved_hotel = ProgramActivityHotel::query()->where('uuid', $uuid)->first();
        if ($reserved_hotel->reserved ==  false)
        {
            $reserved_hotel->update(['reserved'=>'true']);
            alert()->success('Hotel reserved successfully','Success');
        }
        else{
            $reserved_hotel->update(['reserved'=>'false']);
            alert()->success('Undo Hotel reserved successfully','Success');
        }


        return redirect()->back();
    }

}
