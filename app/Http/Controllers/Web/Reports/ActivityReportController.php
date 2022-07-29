<?php

namespace App\Http\Controllers\Web\Reports;


use App\Http\Controllers\Controller;
//use App\Http\Controllers\Web\Reports\Datatables\Activities\ActivityReportDatatables;
use App\Http\Controllers\Web\Reports\Datatables\Activities\ActivityReportDatatables;
use App\Repositories\Activity\ActivityReportRepository;
use App\Repositories\Requisition\Training\RequisitionTrainingRepository;
use Illuminate\Http\Request;

class ActivityReportController extends Controller
{
    //
    use ActivityReportDatatables;

    protected $activity_reports;
    protected $trainings;

    public function __construct()
    {
    $this->activity_reports =  (new ActivityReportRepository());
        $this->trainings = (new RequisitionTrainingRepository());

    }

    public function index()
    {

        return view('reports.Activities.index')
            ->with('activity_report', $this->activity_reports);
    }

    public function create()
    {

    }
    public function initiate(Request $request)
    {

        return view('reports.Activities.forms.initiate')
            ->with('activity_report', $this->activity_reports)
            ->with('trainings', $this->trainings->getPluckRequisitionNo());
    }
}
