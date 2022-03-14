<?php

namespace App\Http\Controllers\Web\ProgramActivity;

use App\Events\NewWorkflow;
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
use App\Repositories\ProgramActivity\ProgramActivityReportRepository;
use App\Repositories\ProgramActivity\ProgramActivityRepository;
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

    public function __construct()
    {

        $this->program_activities = (new ProgramActivityRepository());
        $this->program_activity_report = (new ProgramActivityReportRepository());
        $this->wf_tracks = (new WfTrackRepository());
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


        $programActivityReport = ProgramActivityReport::query()->where('uuid', $uuid)->first();
        $programActivityReports = ProgramActivityReport::query()->where('program_activity_id', $programActivityReport->program_activity_id)->get();
        $program_activity = ProgramActivity::query()->where('id', $programActivityReport->program_activity_id)->first();
        $requisition_training = requisition_training::query()->where('id', $program_activity->requisition_training_id)->first();
        $requisition_training_participants = requisition_training_cost::query()->where('requisition_training_id', $requisition_training->id);
        $requisition_training_items = requisition_training_item::query()->where('requisition_training_id', $requisition_training->id);
        $requisition =  Requisition::query()->where('id', $requisition_training->requisition_id)->first();
        $group_attendance = $requisition_training->trainingCost()->whereHas('programActivityAttendance');

        /* Check workflow */
        $wf_module_group_id = 9;
        $wf_module = $this->wf_tracks->getWfModuleAfterWorkflowStart($wf_module_group_id, $programActivityReport->id);
        $workflow = new Workflow(['wf_module_group_id' => $wf_module_group_id, "resource_id" => $programActivityReport->id, 'type' => $wf_module->type]);
        $check_workflow = $workflow->checkIfHasWorkflow();
        $current_wf_track = $workflow->currentWfTrack();
        $wf_module_id = $workflow->wf_module_id;
        $current_level = $workflow->currentLevel();
        $can_edit_resource = $this->wf_tracks->canEditResource($programActivityReport, $current_level, $workflow->wf_definition_id);

        $program_activity_payment_id = ProgramActivityPayment::query()->where('program_activity_report_id', $programActivityReport->id)->first();


        if ($program_activity_payment_id != null){
            $payment = Payment::query()->where('id', $program_activity_payment_id->payment_id)->first();
        }
        else{
            $payment = null;
        }


        return view('programactivity.reports.show')
            ->with('current_level', $current_level)
            ->with('current_wf_track', $current_wf_track)
            ->with('can_edit_resource', $can_edit_resource)
            ->with('wfTracks', (new WfTrackRepository())->getStatusDescriptions($programActivityReport))
            ->with('program_activity_reports', $programActivityReports)
            ->with('program_activity_report', $programActivityReport)
            ->with('requisition_uuid', $requisition->uuid)
            ->with('requisition', $requisition)
            ->with('payment', $payment)
            ->with('program_activity_payment', $program_activity_payment_id)
            ->with('group_attendance', $group_attendance)
            ->with('activity_details', $requisition_training)
            ->with('activity_location', $requisition_training->district->name)
            ->with('activity_participants_count', $requisition_training_participants->count())
            ->with('training_items_count', $requisition_training_items->count())
            ->with('total_participants', $requisition_training_participants->pluck('amount_paid')->sum())
            ->with('total_items', $requisition_training_items->pluck('total_amount')->sum());

    }


}
