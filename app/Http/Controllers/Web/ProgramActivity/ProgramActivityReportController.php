<?php

namespace App\Http\Controllers\Web\ProgramActivity;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\ProgramActivity\Datatable\ProgramActivityDatatable;
use App\Models\ProgramActivity\ProgramActivity;
use App\Models\ProgramActivity\ProgramActivityReport;
use App\Models\ProgramActivity\Traits\ProgramActivityRelationship;
use App\Models\Requisition\Requisition;
use App\Models\Requisition\Training\requisition_training;
use App\Models\Requisition\Training\requisition_training_cost;
use App\Models\Requisition\Training\requisition_training_item;
use App\Repositories\ProgramActivity\ProgramActivityReportRepository;
use App\Repositories\ProgramActivity\ProgramActivityRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProgramActivityReportController extends Controller
{
    //
    use ProgramActivityDatatable, ProgramActivityRelationship;

    protected $program_activities;
    protected $program_activity_report;

    public function __construct()
    {

        $this->program_activities = (new ProgramActivityRepository());
        $this->program_activity_report = (new ProgramActivityReportRepository());
    }

    public function index()
    {

        return view('programactivity.datatable.reports.all')
            ->with('program_activities', $this->program_activities);
    }

    public function create(ProgramActivityReport $programActivityReport){

        $program_activity = ProgramActivity::query()->where('id', $programActivityReport->program_activity_id)->first();
        $requisition_training = requisition_training::query()->where('id', $program_activity->requisition_training_id)->first();
        $requisition_training_participants = requisition_training_cost::query()->where('requisition_training_id', $requisition_training->id);
        $requisition_training_items = requisition_training_item::query()->where('requisition_training_id', $requisition_training->id);
        $requisition =  Requisition::query()->where('id', $requisition_training->requisition_id)->first();
        return view('programactivity.forms.activity-report.create')
            ->with('program_activity_report', $programActivityReport)
            ->with('requisition_uuid', $requisition->uuid)
            ->with('requisition', $requisition)
            ->with('activity_details', $requisition_training)
            ->with('activity_location', $requisition_training->district->name)
            ->with('activity_participants_count', $requisition_training_participants->count())
            ->with('training_items_count', $requisition_training_items->count());
    }

    public function edit()
    {

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

        $this->program_activity_report->update($request->all(), $uuid);

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


        return view('programactivity.reports.show')
            ->with('program_activity_reports', $programActivityReports)
            ->with('program_activity_report', $programActivityReport)
            ->with('requisition_uuid', $requisition->uuid)
            ->with('requisition', $requisition)
            ->with('activity_details', $requisition_training)
            ->with('activity_location', $requisition_training->district->name)
            ->with('activity_participants_count', $requisition_training_participants->count())
            ->with('training_items_count', $requisition_training_items->count());

    }
}
