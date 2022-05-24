<?php

namespace App\Http\Controllers\Web\ProgramActivity;

use App\Events\NewWorkflow;
use App\Exports\PaymentExport;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\ProgramActivity\Datatable\ProgramActivityDatatable;
use App\Http\Controllers\Web\ProgramActivity\Datatable\ProgramActivityReportDatatable;
use App\Models\Payment\Payment;
use App\Models\ProgramActivity\ProgramActivity;
use App\Models\ProgramActivity\ProgramActivityPayment;
use App\Models\ProgramActivity\ProgramActivityReport;
use App\Models\ProgramActivity\Traits\ProgramActivityRelationship;
use App\Models\Requisition\Requisition;
use App\Models\Requisition\Training\requisition_training;
use App\Models\Requisition\Training\requisition_training_cost;
use App\Models\Requisition\Training\requisition_training_item;
use App\Repositories\ProgramActivity\ProgramActivityAttendanceRepository;
use App\Repositories\ProgramActivity\ProgramActivityReportRepository;
use App\Repositories\ProgramActivity\ProgramActivityRepository;
use App\Repositories\Requisition\RequisitionRepository;
use App\Repositories\Requisition\Training\RequestTrainingCostRepository;
use App\Repositories\Requisition\Training\RequisitionTrainingItemsRepository;
use App\Repositories\Requisition\Training\RequisitionTrainingRepository;
use App\Repositories\Workflow\WfTrackRepository;
use App\Services\Workflow\Workflow;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProgramActivityReportController extends Controller
{
    //
    use  ProgramActivityRelationship, ProgramActivityReportDatatable;

    protected $program_activities;
    protected $program_activity_report;
    protected  $wf_tracks;
    protected $requisition;
    protected $training;
    protected $training_cost;
    protected $training_items;
    protected $activity_attendance;

    public function __construct()
    {

        $this->program_activities = (new ProgramActivityRepository());
        $this->program_activity_report = (new ProgramActivityReportRepository());
        $this->wf_tracks = (new WfTrackRepository());
        $this->requisition = (new RequisitionRepository());
        $this->training = (new RequisitionTrainingRepository());
        $this->training_cost = (new RequestTrainingCostRepository());
        $this->training_items= (new RequisitionTrainingItemsRepository());
        $this->activity_attendance = (new ProgramActivityAttendanceRepository());
    }

    public function index()
    {

        return view('programactivity.datatable.reports.all')
            ->with('program_activity_report_repo', $this->program_activity_report)
            ->with('program_activities', $this->program_activities);
    }

    public function create(ProgramActivityReport $programActivityReport){

        $program_activity = ProgramActivity::query()->where('id', $programActivityReport->program_activity_id)->first();
        $requisition_training = requisition_training::query()->where('id', $program_activity->requisition_training_id)->first();
        $requisition_training_participants = requisition_training_cost::query()->where('requisition_training_id', $requisition_training->id);
        $requisition_training_items = requisition_training_item::query()->where('requisition_training_id', $requisition_training->id);
        $requisition =  Requisition::query()->where('id', $requisition_training->requisition_id)->first();
        $group_attendance = $requisition_training->trainingCost()->whereHas('programActivityAttendance');
        return view('programactivity.forms.activity-report.create')
            ->with('program_activity_report', $programActivityReport)
            ->with('requisition_uuid', $requisition->uuid)
            ->with('requisition', $requisition)
            ->with('group_attendance', $group_attendance)
            ->with('activity_details', $requisition_training)
            ->with('activity_location', $requisition_training->district->name)
            ->with('activity_participants_count', $requisition_training_participants->count())
            ->with('training_items_count', $requisition_training_items->count());
    }


    public function edit(ProgramActivityReport $programActivityReport){

        $program_activity = ProgramActivity::query()->where('id', $programActivityReport->program_activity_id)->first();
        $requisition_training = requisition_training::query()->where('id', $program_activity->requisition_training_id)->first();
        $requisition_training_participants = requisition_training_cost::query()->where('requisition_training_id', $requisition_training->id);
        $requisition_training_items = requisition_training_item::query()->where('requisition_training_id', $requisition_training->id);
        $requisition =  Requisition::query()->where('id', $requisition_training->requisition_id)->first();
        $group_attendance = $requisition_training->trainingCost()->whereHas('programActivityAttendance');
        return view('programactivity.forms.activity-report.edit')
            ->with('program_activity_report', $programActivityReport)
            ->with('requisition_uuid', $requisition->uuid)
            ->with('requisition', $requisition)
            ->with('group_attendance', $group_attendance)
            ->with('activity_details', $requisition_training)
            ->with('activity_location', $requisition_training->district->name)
            ->with('activity_participants_count', $requisition_training_participants->count())
            ->with('training_items_count', $requisition_training_items->count());
    }



    public function initiate()
    {

        return view('programactivity.forms.activity-report.initiate')


            ->with('activities', $this->program_activities->getActivitiesWithoutReportsFilter()->pluck('activity', 'id'));


    }

    public function store(Request $request){

       $activity_report =  $this->program_activity_report->store($request->all());

        alert()->success('Activity Report initiated Successfully', 'Success');

        return redirect()->route('programactivityreport.create', $activity_report);
    }

    public function update(Request $request, $uuid){


        $program_activity_report =  $this->program_activity_report->findByUuid($uuid);
        $wf_module_group_id = 9;
        $next_user = $program_activity_report->user->assignedSupervisor()->supervisor_id;
//    dd($program_activity_report);
        if ($program_activity_report->done == false)
        {      $this->program_activity_report->update($request->all(), $uuid);
            event(new NewWorkflow(['wf_module_group_id' => $wf_module_group_id, 'resource_id' => $program_activity_report->id,'region_id' => $program_activity_report->region_id, 'type' => 1],[],['next_user_id' => $next_user]));
        }
        else{
            $this->program_activity_report->update($request->all(), $uuid);
        }


        alert()->success('Activity Report Submitted Successfully', 'Success');

        return redirect()->route('programactivityreport.show', $uuid);

    }

    public function show($uuid){

        $program_activity_report =  $this->program_activity_report->findByUuid($uuid);
        $program_activity = $this->program_activities->find($program_activity_report->program_activity_id);
        $requisition =  $this->requisition->find($program_activity->requisition_id);

        $training_cost = $this->training_cost->getParticipantsByRequisition($requisition->id)->get();
        $attendance_on_reporting_date = $this->activity_attendance->getAttendanceByDate($program_activity->id, $program_activity_report->created_at)->get();
        $training =  $this->training->find($training_cost->first()->requisition_training_id);
        $training_item = $this->training_items->getItemsByRequisition($requisition->id);
        /* Check workflow */
        $wf_module_group_id = 9;
        $wf_module = $this->wf_tracks->getWfModuleAfterWorkflowStart($wf_module_group_id, $program_activity_report->id);
        $workflow = new Workflow(['wf_module_group_id' => $wf_module_group_id, "resource_id" => $program_activity_report->id, 'type' => $wf_module->type]);
        $check_workflow = $workflow->checkIfHasWorkflow();
        $current_wf_track = $workflow->currentWfTrack();
        $wf_module_id = $workflow->wf_module_id;
        $current_level = $workflow->currentLevel();
        $can_edit_resource = $this->wf_tracks->canEditResource($program_activity_report, $current_level, $workflow->wf_definition_id);

        $paid_report = $this->program_activity_report->getPaidReports($program_activity_report->id);

        return view('programactivity.reports.show')
            ->with('current_level', $current_level)
            ->with('current_wf_track', $current_wf_track)
            ->with('can_edit_resource', $can_edit_resource)
            ->with('wfTracks', (new WfTrackRepository())->getStatusDescriptions($program_activity_report))
            ->with('program_activity', $program_activity)
            ->with('program_activity_report', $program_activity_report)
            ->with('requisition', $requisition)
            ->with('attendance', $attendance_on_reporting_date)
            ->with('activity_details', $training)
            ->with('paid_report', $paid_report)
            ->with('training_items', $training_item)
            ->with('activity_participants', $training_cost);

    }
    public function exportParticipants( $uuid)
    {
        $program_activity_report =  $this->program_activity_report->findByUuid($uuid);
        $program_activity = $this->program_activities->find($program_activity_report->program_activity_id);
        $attendance_on_reporting_date = $this->activity_attendance->getAttendanceByDate($program_activity->id, $program_activity_report->created_at)->get();

        return \Maatwebsite\Excel\Facades\Excel::download(new PaymentExport($attendance_on_reporting_date), 'Activity:'.$program_activity->number.'participants_export_for_payment.xlsx');

    }


}
