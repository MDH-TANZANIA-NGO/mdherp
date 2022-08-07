<?php

namespace App\Http\Controllers\Web\Reports;


use App\Exports\ActivityReportAttendancesExport;
use App\Exports\RequisitionTrainingCostExport;
use App\Http\Controllers\Controller;
//use App\Http\Controllers\Web\Reports\Datatables\Activities\ActivityReportDatatables;
use App\Http\Controllers\Web\Reports\Datatables\Activities\ActivityReportDatatables;
use App\Repositories\Activity\ActivityReportRepository;
use App\Repositories\Attendance\ActivityAttendanceRepository;
use App\Repositories\GOfficer\GOfficerRepository;
use App\Repositories\Hotspot\HotspotRepository;
use App\Repositories\Requisition\RequisitionRepository;
use App\Repositories\Requisition\Training\RequestTrainingCostRepository;
use App\Repositories\Requisition\Training\RequisitionTrainingRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Excel;

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
    protected $gofficer;

    public function __construct()
    {
    $this->activity_reports =  (new ActivityReportRepository());
        $this->trainings = (new RequisitionTrainingRepository());
        $this->hotspot = (new HotspotRepository());
        $this->activity_attendance = (new ActivityAttendanceRepository());
        $this->requisition = (new RequisitionRepository());
        $this->training_costs = (new RequestTrainingCostRepository());
        $this->gofficer =  (new GOfficerRepository());


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
                $option['inputs'] = [
                    'requisition_id'=>$request['requisition_id'],
                    'start_date'=>$request['start_date'],
                    'end_date'=>$request['end_date']
                ];
                $option['hotspot'] =   $this->hotspot->getHotspotByRequisitionOnDateRange($request['requisition_id'], $request['start_date'], $request['end_date'])->get();
                $option['training_cost'] = $this->training_costs->getParticipantsByRequisition($request['requisition_id'])->get();
                $option['attendance_for_pluck'] = $this->activity_attendance->getGOfficerAttendanceByRequisitionForPluck($request['requisition_id']);
                $option['this_activity_report'] =  $this->activity_reports->getAccessSavedByRequisitionId($request['requisition_id'])->first();


       }


        return view('reports.Activities.forms.initiate')
            ->with('gofficer',$this->gofficer->getForPluckUnique())
            ->with('participants_attended',isset($option['attendance_for_pluck'])? $option['attendance_for_pluck']: [])
            ->with('hotspots',isset($option['hotspot'])? $option['hotspot']: [])
            ->with('incomplete_report',isset($option['this_activity_report'])? $option['this_activity_report']: [])
            ->with('inputs',isset($option['inputs'])? $option['inputs']: [])
            ->with('requisition',isset($option['requisition'])? $option['requisition']: [])
            ->with('training_costs',isset($option['training_cost'])? $option['training_cost']: [])
            ->with('activity_report', $this->activity_reports)
            ->with('attendances',$this->activity_attendance)
            ->with('attachment_type', DB::table('attachment_types')->get()->pluck('type','id'))
            ->with('trainings', $this->trainings->getPluckRequisitionNoWithRequisitionId());
    }

    public function show($uuid)
    {
        $activity_report =  $this->activity_reports->findByUuid($uuid);
        $option =  [];
        $option['finance_designations'] = ['48','49','96','107','114'];
        $option['requisition'] =  $this->requisition->find($activity_report->requisition_id);
        $option['hotspot'] =   $this->hotspot->getHotspotByReportId($activity_report->id)->get();
        $option['training_cost'] = $this->training_costs->getParticipantsByRequisition($activity_report->requisition_id)->get();
        $option['attendance_for_pluck'] = $this->activity_attendance->getGOfficerAttendanceByRequisitionForPluck($activity_report->requisition_id);



        return view('reports.Activities.display.show')
            ->with('gofficer',$this->gofficer->getForPluckUnique())
            ->with('finance_designations', $option['finance_designations'])
            ->with('participants_attended', $option['attendance_for_pluck'])
            ->with('hotspots',$option['hotspot'])
            ->with('requisition',$option['requisition'])
            ->with('training_costs',$option['training_cost'])
            ->with('activity_reports', $this->activity_reports)
            ->with('activity_report', $activity_report)
            ->with('attendances',$this->activity_attendance)
            ->with('attachment_type', DB::table('attachment_types')->get()->pluck('type','id'))
            ->with('trainings', $this->trainings->getPluckRequisitionNoWithRequisitionId());
    }

    public function store(Request $request)
    {
        $training =  $this->trainings->getByRequisitionId($request['requisition_id'])->first();

        if ($request['status'] == 1)
        {
            $training->update(['completed'=>true]);
        }
        $this->activity_reports->store($request->all());

        alert()->success('Report submitted successfully', 'Success');

        return redirect()->back();
    }
    public function ExportReportAttendance($uuid)
    {
        $activity_report =  $this->activity_reports->findByUuid($uuid);

        return \Maatwebsite\Excel\Facades\Excel::download(new ActivityReportAttendancesExport($activity_report), 'Attendance export'.$activity_report->number.'.csv');
    }

    public function ExportParticipantPayment($uuid)
    {
        $activity_report = $this->activity_reports->findByUuid($uuid);
        return \Maatwebsite\Excel\Facades\Excel::download(new RequisitionTrainingCostExport($activity_report),'Participants Costs.csv');
    }

}
