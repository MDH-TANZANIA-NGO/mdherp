<?php

namespace App\Http\Controllers\Web\Reports;


use App\Http\Controllers\Controller;
//use App\Http\Controllers\Web\Reports\Datatables\Activities\ActivityReportDatatables;
use App\Http\Controllers\Web\Reports\Datatables\Activities\ActivityReportDatatables;
use App\Repositories\Activity\ActivityReportRepository;
use App\Repositories\Attendance\ActivityAttendanceRepository;
use App\Repositories\Hotspot\HotspotRepository;
use App\Repositories\Requisition\RequisitionRepository;
use App\Repositories\Requisition\Training\RequestTrainingCostRepository;
use App\Repositories\Requisition\Training\RequisitionTrainingRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActivityReportController extends Controller
{
    //
    use ActivityReportDatatables;

    protected $activity_reports;
    protected $trainings;
    protected $hotspot;
    protected $activity_attendance;
    protected $requisition;
    protected $training_costs;

    public function __construct()
    {
    $this->activity_reports =  (new ActivityReportRepository());
        $this->trainings = (new RequisitionTrainingRepository());
        $this->hotspot = (new HotspotRepository());
        $this->activity_attendance = (new ActivityAttendanceRepository());
        $this->requisition = (new RequisitionRepository());
        $this->training_costs = (new RequestTrainingCostRepository());


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

        $option =  [];
       if ( isset($request['requisition_id'])){

                $option['requisition'] =  $this->requisition->find($request['requisition_id']);
                $option['hotspot'] =   $this->hotspot->getHotspotByRequisitionOnDateRange($request['requisition_id'], $request['start_date'], $request['end_date'])->get();
                $option['training_cost'] = $this->training_costs->getParticipantsByRequisition($request['requisition_id']);
                $option['attendance_for_pluck'] = $this->activity_attendance->getGOfficerAttendanceByRequisitionForPluck($request['requisition_id']);


       }


        return view('reports.Activities.forms.initiate')
            ->with('hotspots',isset($option['hotspot'])? $option['hotspot']: [])
            ->with('requisition',isset($option['requisition'])? $option['requisition']: [])
            ->with('training_costs',isset($option['training_cost'])? $option['training_cost']: [])
            ->with('activity_report', $this->activity_reports)
            ->with('attendances',$this->activity_attendance)
            ->with('attachment_type', DB::table('attachment_types')->get()->pluck('type','id'))
            ->with('trainings', $this->trainings->getPluckRequisitionNoWithRequisitionId());
    }
}
