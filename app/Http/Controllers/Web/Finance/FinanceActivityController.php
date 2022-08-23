<?php

namespace App\Http\Controllers\Web\Finance;

use App\Events\NewWorkflow;
use App\Exports\PaymentExport;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\Finance\Datatable\PaymentsDatatable;
use App\Models\Auth\User;
use App\Models\Payment\Payment;
use App\Models\ProgramActivity\ProgramActivity;
use App\Models\ProgramActivity\ProgramActivityPayment;
use App\Models\ProgramActivity\ProgramActivityReport;
use App\Models\ProgramActivity\Traits\ProgramActivityRelationship;
use App\Models\Requisition\Requisition;
use App\Models\Requisition\Training\requisition_training;
use App\Models\Requisition\Training\requisition_training_cost;
use App\Models\Requisition\Training\requisition_training_item;
use App\Models\Requisition\Traits\Relaltionship\RequisitionRelationship;
use App\Models\Requisition\Travelling\requisition_travelling_cost;
use App\Models\SafariAdvance\SafariAdvance;
use App\Models\SafariAdvance\SafariAdvanceDetails;
use App\Models\SafariAdvance\SafariAdvancePayment;
use App\Models\SafariAdvance\Traits\SafariAdvanceRelationship;
use App\Repositories\Activity\ActivityReportRepository;
use App\Repositories\Finance\FinanceActivityRepository;
use App\Repositories\Hotel\HotelRepository;
use App\Repositories\ProgramActivity\ProgramActivityPaymentRepository;
use App\Repositories\ProgramActivity\ProgramActivityReportRepository;
use App\Repositories\ProgramActivity\ProgramActivityRepository;
use App\Repositories\Requisition\RequisitionRepository;
use App\Repositories\Retirement\RetirementRepository;
use App\Repositories\SafariAdvance\SafariAdvancePaymentRepository;
use App\Repositories\SafariAdvance\SafariAdvanceRepository;
use App\Repositories\Unit\DesignationRepository;
use App\Repositories\Workflow\WfTrackRepository;
use App\Services\Workflow\Workflow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class FinanceActivityController extends Controller
{
    use PaymentsDatatable, RequisitionRelationship;



    protected $safariAdvance;
    protected $requisitions;
    protected $program_activity;
    protected $retirement;
    protected $requisition_training_cost;
    protected $finance;
    protected $wf_tracks;
    protected $safari_advance_payment;
    protected $program_activity_reports;
    protected $designations;
    protected $program_activity_payment_repo;
    protected $hotel;
    protected $activity_reports;

    public function __construct()
    {
        $this->activity_reports = (new ActivityReportRepository());
        $this->requisitions = (new RequisitionRepository());
        $this->safariAdvance =  (new SafariAdvanceRepository());
        $this->program_activity = (new ProgramActivityRepository());
        $this->retirement = (new RetirementRepository());
        $this->requisition_training_cost = (new requisition_training_cost());
        $this->finance =  (new FinanceActivityRepository());
        $this->wf_tracks = (new WfTrackRepository());
        $this->safari_advance_payment = (new SafariAdvancePaymentRepository());
        $this->program_activity_reports =  (new ProgramActivityReportRepository());
        $this->designations = (new DesignationRepository());
        $this->program_activity_payment_repo =  (new ProgramActivityPaymentRepository());
        $this->hotel = (new HotelRepository());

    }
    public function index()
    {
//            dd($this->activity_reports->getAllApprovedForPaymentByRegion(access()->user()->region_id)->get());
        return view('finance.index')
            ->with('requisition', $this->requisitions->getAllApprovedRequisitions())
            ->with('program_activity', $this->program_activity->getAllApprovedProgramActivities())
            ->with('program_activity_reports', $this->activity_reports->getAllApprovedForPaymentByRegion(access()->user()->region_id))
            ->with('safariAdvance', $this->safariAdvance->getAllApprovedSafari())
            ->with('retirement', $this->retirement->getAllApprovedRetirements());
    }
    public function show($uuid, FinanceActivityRepository $financeActivityRepository)
    {
        $safari  =  SafariAdvance::where('uuid', $uuid);
        $program_activity =  ProgramActivity::where('uuid', $uuid);
        $safari_to_query  =  SafariAdvance::where('uuid', $uuid)->first();
        $program_activity_to_query =  ProgramActivity::where('uuid', $uuid)->first();


        if ($safari_to_query)
        {
            $travelling =  requisition_travelling_cost::where('id', $safari_to_query->requisition_travelling_cost_id)->first();
            $requisition_uuid =  Requisition::where('id', $travelling->requisition_id)->first()->uuid;

            return view('finance.payments.show')
                ->with('safari_advance', $safari)
                ->with('finance', $financeActivityRepository)
                ->with('is_paid', $safari_to_query->paid)
                ->with('safari', $safari_to_query)
                ->with('safari_details', SafariAdvanceDetails::query()->where('safari_advance_id', $safari_to_query->id)->first())
                ->with('requisition', Requisition::where('uuid', $requisition_uuid)->first())
                ->with('program_activity', $this->program_activity->all()->where('uuid', $uuid))
                ->with('participant_total', requisition_training_cost::query()->where('requisition_id', $travelling->requisition_id)->get()->pluck('total_amount')->sum())
                ->with('requisition_uuid', $requisition_uuid);

        }elseif ($program_activity_to_query)
        {

            $training =  requisition_training::where('id', $program_activity_to_query->requisition_training_id)->first();
            $requisition_id =  requisition_training::where('id', $training->id)->first()->requisition_id;
            //dd($requisition_id);
            $payments = Payment::where('requisition_id', $requisition_id)->pluck('uuid');
            //dd($payments);
            $requisition_uuid =  Requisition::where('id', $requisition_id)->first()->uuid;



            return view('finance.payments.show')
                ->with('safari_advance', $safari)
                ->with('uuid', $uuid)
                ->with('program_activity', $this->program_activity->all()->where('uuid', $uuid))
                ->with('requisition_uuid', $requisition_uuid)
                ->with('finance', $financeActivityRepository)
                ->with('is_paid', $program_activity_to_query->paid)
                ->with('payment_uuid', Requisition::where('uuid', $requisition_uuid)->first()->payments()->where('user_id', access()->user()->id)->latest('created_at')->get()->all())
                ->with('requisition', Requisition::where('uuid', $requisition_uuid)->first())
                ->with('requisition_count',  Requisition::where('uuid', $requisition_uuid)->first()->payments()->count())
                ->with('activity_participants', $program_activity_to_query->training->trainingCost()->get()->all())
                ->with('training_items',$program_activity_to_query->training->trainingItems()->get()->all() )
                ->with('participant_total', $program_activity_to_query->training->trainingCost()->get()->pluck('amount_paid')->sum())
                ->with('items_total', $program_activity_to_query->training->trainingItems()->get()->pluck('total_amount')->sum());
        }



    }
    public function store(Request $request)
    {
        $pay = $this->finance->store($request->all());
        return redirect()->route('finance.SubmitPayment', $pay->uuid);
    }

    public function updatePayment(Request $request, $uuid)
    {
        DB::update('update payments set account_number = ?, payed_amount = ? where uuid = ?', [$request['phone'], $request['total_amount'], $uuid]);
        return redirect()->back();
    }
    public function update(Request $request, $uuid)
    {
        $pay = $this->finance->update($request->all(), $uuid);
        $pay = Payment::all()->where('uuid', $uuid)->first();

        $wf_module_group_id = 6;
        $next_user = $pay->user->assignedSupervisor()->supervisor_id;
        event(new NewWorkflow(['wf_module_group_id' => $wf_module_group_id, 'resource_id' => $pay->id,'region_id' => $pay->region_id, 'type' => 1],[],['next_user_id' => $next_user]));

        return redirect()->route('finance.index');
    }
    public function view(Payment $payment)
    {

        $wf_module_group_id = 6;
        $wf_module = $this->wf_tracks->getWfModuleAfterWorkflowStart($wf_module_group_id, $payment->id);
        $workflow = new Workflow(['wf_module_group_id' => $wf_module_group_id, "resource_id" => $payment->id, 'type' => $wf_module->type]);
        $check_workflow = $workflow->checkIfHasWorkflow();
        $current_wf_track = $workflow->currentWfTrack();
        $wf_module_id = $workflow->wf_module_id;
        $current_level = $workflow->currentLevel();
        $can_edit_resource = $this->wf_tracks->canEditResource($payment, $current_level, $workflow->wf_definition_id);

        $travelling_details = requisition_travelling_cost::query()->where('requisition_id', $payment->requisition_id)->get()->first();
        $training_details =  requisition_training_cost::query()->where('requisition_id', $payment->requisition_id);

        if (ProgramActivity::query()->where('requisition_id', $payment->requisition_id)->get()->count() > 0){
            $program_activity =  ProgramActivity::where('requisition_id', $payment->requisition_id)->first();
            $safari_advance =  SafariAdvance::where('requisition_travelling_cost_id', null)->first();
            $program_activity_report_id =  ProgramActivityPayment::query()->where('payment_id', $payment->id)->first()->program_activity_report_id;
            $program_activity_report = $this->program_activity_reports->find($program_activity_report_id);


        }elseif (SafariAdvance::query()->where('requisition_travelling_cost_id', $travelling_details->id)->get()->count() > 0)
        {

            $program_activity =  ProgramActivity::query()->where('requisition_id', $payment->requisition_id)->first();
            $safari_advance =  SafariAdvance::query()->where('requisition_travelling_cost_id', $travelling_details->id)->first();
        }

        if ($program_activity){

//            dd($payment->payed_amount);
            return view('finance.payments.view')
                ->with('current_level', $current_level)
                ->with('current_wf_track', $current_wf_track)
                ->with('can_edit_resource', $can_edit_resource)
                ->with('wfTracks', (new WfTrackRepository())->getStatusDescriptions($payment))
                ->with('payment', $payment)
                ->with('safari_advance', $safari_advance)
                ->with('requisition', Requisition::query()->where('id', $payment->requisition_id)->first())
                ->with('program_activity', $program_activity)
                ->with('program_activity_report', $program_activity_report)
                ->with('travelling_details', $travelling_details)
                ->with('payed_amount', $payment->payed_amount)
                ->with('training_details', $training_details);
        }

        elseif ($safari_advance){
            return view('finance.payments.view')
                ->with('current_level', $current_level)
                ->with('current_wf_track', $current_wf_track)
                ->with('can_edit_resource', $can_edit_resource)
                ->with('wfTracks', (new WfTrackRepository())->getStatusDescriptions($payment))
                ->with('payment', $payment)
                ->with('safari_advance', $safari_advance)
                ->with('program_activity', $program_activity)
                ->with('requisition', Requisition::query()->where('id', $payment->requisition_id)->first())
                ->with('training_details', $training_details)
                ->with('payed_amount', $payment->payed_amount)
                ->with('travelling_details', $travelling_details);
        }

    }
    public function submitPayment(Payment $payment)
    {

        $travelling_details = requisition_travelling_cost::query()->where('requisition_id', $payment->requisition_id)->get()->first();
        $training_details =  requisition_training_cost::query()->where('requisition_id', $payment->requisition_id);

        if (ProgramActivity::query()->where('requisition_id', $payment->requisition_id)->get()->count() > 0){
            $program_activity =  ProgramActivity::where('requisition_id', $payment->requisition_id)->first();
            $safari_advance =  SafariAdvance::where('requisition_travelling_cost_id', null)->first();

        }elseif (SafariAdvance::query()->where('requisition_travelling_cost_id', $travelling_details->id)->get()->count() > 0)
        {

            $program_activity =  ProgramActivity::query()->where('requisition_id', $payment->requisition_id)->first();
            $safari_advance =  SafariAdvance::query()->where('requisition_travelling_cost_id', $travelling_details->id)->first();
        }

        if ($program_activity){

//            dd($payment->payed_amount);
            return view('finance.payments.forms.SubmitPayment')
                ->with('payment', $payment)
                ->with('safari_advance', $safari_advance)
                ->with('requisition', Requisition::query()->where('id', $payment->requisition_id)->first())
                ->with('program_activity', $program_activity)
                ->with('travelling_details', $travelling_details)
                ->with('payed_amount', $payment->payed_amount)
                ->with('training_details', $training_details);
        }

        elseif ($safari_advance){
            return view('finance.payments.forms.SubmitPayment')
                ->with('payment', $payment)
                ->with('safari_advance', $safari_advance)
                ->with('program_activity', $program_activity)
                ->with('requisition', Requisition::query()->where('id', $payment->requisition_id)->first())
                ->with('training_details', $training_details)
                ->with('payed_amount', $payment->payed_amount)
                ->with('travelling_details', $travelling_details);
        }
    }
    public function export($uuid)
    {
        return Excel::download(new PaymentExport($uuid), "Payments.xlsx");
    }

    public function safariPayment($uuid){

        $safari_advance =  $this->safariAdvance->findByUuid($uuid);
        $travelling_cost = $safari_advance->travellingCost()->first();

        $requisition = $safari_advance->travellingCost->requisition()->first();
        return view('finance.payments.safariAdvance.forms.initiate')
            ->with('travelling_cost', $travelling_cost)
            ->with('hotel_reserved', $this->hotel->getSelectedHotelForSafari($safari_advance->id))
            ->with('safari_advance', $safari_advance)
            ->with('requisition', $requisition)
            ;
    }
    public function safariPaymentSubmitForApproval($uuid){


        $payment = $this->finance->findByUuid($uuid);
        $travelling_cost = $payment->requisition->travellingCost->first();
        $requisition = $payment->requisition()->first();
        $safari_advance = $travelling_cost->safariAdvance->first();
        $safari_advance_payment =  SafariAdvancePayment::query()->where('requisition_travelling_cost_id', $travelling_cost->id)->first();

        return view('finance.payments.safariAdvance.forms.create')
            ->with('safari_advance', $safari_advance)
            ->with('requisition', $requisition)
            ->with('travelling_cost', $travelling_cost)
            ->with('hotel_reserved', $this->hotel->getSelectedHotelForSafari($safari_advance->id))
            ->with('safari_advance_payment', $safari_advance_payment)
            ->with('payment', $payment)
            ;
    }
    public function ActivityPaymentSubmitForApproval($uuid){


        $payment = $this->finance->findByUuid($uuid);
        $requisition = $this->finance->findByUuid($uuid)->requisition()->first();
        $program_activity = ProgramActivity::query()->where('requisition_training_id', requisition_training::query()->where('requisition_id',$requisition->id )->first()->id);
        $program_activity_report =  ProgramActivityReport::query()->where('id', ProgramActivityPayment::query()->where('payment_id', $payment->id)->first()->program_activity_report_id);
        $program_activity_payment = ProgramActivityPayment::query()->where('payment_id', $payment->id);
        $trainingCost =  requisition_training_cost::query()->where('requisition_id', $requisition->id);
        $trainingItems =  requisition_training_item::query()->where('requisition_id', $requisition->id);
        return view('finance.payments.programActivity.forms.create')
            ->with('program_activity', $program_activity->first())
            ->with('program_activity_report', $program_activity_report->first())
            ->with('requisition', $requisition)
            ->with('details', $trainingCost)
            ->with('program_activity_payment', $program_activity_payment->first())
            ->with('payment', $payment)
            ;
    }
    public function storeSafariPayment(Request $request)
    {
        $safari = $this->safari_advance_payment->storeSafariPayment($request->all())->id;
        $pay = $this->finance->store($request->all());
       DB::update('update safari_advance_payments set payment_id = ? where id=?',[$pay,$safari]);
        $safari_payment = $this->safari_advance_payment->find($safari);
        $payment = $this->finance->find($pay);
        return redirect()->route('finance.safari_payment_for_approval', $payment->uuid);
    }
    public function storeActivityPayment(Request $request)
    {
        $payment_id = $this->finance->store($request->all());
        $this->program_activity_payment_repo->storeActivityPayment($request->all());
        $payment =  $this->finance->find($payment_id);

        $number = $this->finance->generateNumber(Payment::query()->find($payment_id));
        DB::update('update payments set done = ?, number = ? where uuid = ?',[1,$number, $payment->uuid]);
        DB::update('update program_activity_reports set paid = ? where id = ?',[true, $request['program_activity_report_id']]);
        DB::update('update program_activity_payments set payment_id = ? where program_activity_report_id = ?', [$payment->id, $request['program_activity_report_id']]);

        $wf_module_group_id = 6;
        $next_user = $payment->user->assignedSupervisor()->supervisor_id;
        event(new NewWorkflow(['wf_module_group_id' => $wf_module_group_id, 'resource_id' => $payment->id,'region_id' => $payment->region_id, 'type' => 1],[],['next_user_id' => $next_user]));

        alert()->success('Payment sent Successfully', 'Success');
        return redirect()->route('finance.view', $payment->uuid);
    }
    public function updateActivityPayment(Request $request, $id)
    {
        $program_activity_payment = ProgramActivityPayment::query()->where('program_activity_report_id', $id)->first();
        $this->program_activity_payment_repo->updateActivityPayment($request, $program_activity_payment->uuid);
        $payment =  $this->finance->find($program_activity_payment->payment_id);
        $pay = $payment->update($request->all());
        $program_activity_payment_uuid = $payment->activityPayment->uuid;

        alert()->success('Payment updated Successfully', 'Success');
        return redirect()->route('finance.view', $payment->uuid);

    }
    public function safariPaymentEditForApproval($uuid){


        $safari_advance =  $this->safariAdvance->findByUuid($uuid);
        $requisition = $safari_advance->travellingCost->requisition()->first();
        $payment =  $safari_advance->travellingCost->requisition->payments()->first();
        $safari_advance_payment =  SafariAdvancePayment::query()->where('safari_advance_id', $safari_advance->id)->first();
        return view('finance.payments.safariAdvance.forms.edit')
            ->with('safari_advance', $safari_advance)
            ->with('hotel_reserved', $this->hotel->getSelectedHotelForSafari($safari_advance->id))
            ->with('requisition', $requisition)
            ->with('safari_advance_payment', $safari_advance_payment)
            ->with('payment',$payment)
            ;
    }
    public function updateSafariPayment(Request $request, $uuid){

        return DB::transaction(function () use ( $request, $uuid){
            $payment = $this->finance->findByUuid($uuid);
            $safari_advance_payment =  SafariAdvancePayment::query()->where('safari_advance_id', $request->get('safari_advance_id'))->first();
            DB::update('update payments set payed_amount = ?, remarks = ? where uuid = ?',[$request->get('total_amount'), $request->get('remarks'), $uuid]);
            DB::update('update safari_advance_payments set disbursed_amount = ?, account_no = ? where uuid = ?',[$request->get('total_amount'), $request->get('phone'), $safari_advance_payment->uuid]);

            alert()->success('Safari Advance Payment Updated Successfully', 'Success');

            if ($payment->done == 0){
                return redirect()->route('finance.safari_payment_for_approval', $uuid);
            }
            else{
                return redirect()->route('finance.view', $uuid);
            }




        });

    }
    public function sendSafariPaymentForApproval(Request $request, $uuid){


        return DB::transaction(function () use ( $request, $uuid){
            $payment = $this->finance->findByUuid($uuid);
            $number = $this->finance->generateNumber($payment);
            $safari_advance_payment = SafariAdvancePayment::query()->where('payment_id', $payment->id)->first();
            $safari_advance =  $this->safariAdvance->find($safari_advance_payment->safari_advance_id);
            DB::update('update payments set done = ?, number = ? where uuid = ?',[1,$number, $uuid]);
            DB::update('update safari_advances set paid = ? where uuid = ?',[true, $safari_advance->uuid]);
            $wf_module_group_id = 6;
            $next_user = $payment->user->assignedSupervisor()->supervisor_id;
            event(new NewWorkflow(['wf_module_group_id' => $wf_module_group_id, 'resource_id' => $payment->id,'region_id' => $payment->region_id, 'type' => 1],[],['next_user_id' => $next_user]));

            alert()->success('Safari Advance Payment Sent for Approval', 'Success');
            return redirect()->route('finance.view', $uuid);


        });
    }
    public function sendActivityPaymentForApproval(Request $request, $uuid){

        return DB::transaction(function () use ( $request, $uuid){
            $payment = Payment::query()->where('uuid', $uuid)->first();
            $number = $this->finance->generateNumber($payment);
            $program_activity_report = $payment->activityPayment->activityReport;

           DB::update('update payments set done = ?, number = ? where uuid = ?',[1,$number, $uuid]);
           DB::update('update program_activity_reports set paid = ? where uuid = ?',[true, $program_activity_report->uuid]);

            $wf_module_group_id = 6;
            $next_user = $payment->user->assignedSupervisor()->supervisor_id;
            event(new NewWorkflow(['wf_module_group_id' => $wf_module_group_id, 'resource_id' => $payment->id,'region_id' => $payment->region_id, 'type' => 1],[],['next_user_id' => $next_user]));

            alert()->success('Activity Advance Payment Sent for Approval', 'Success');
            return redirect()->route('finance.view', $uuid);


        });
    }
    public function showSafariPayment($uuid){

        $payment = $this->finance->findByUuid($uuid);
        $requisition = $payment->requisition()->first();
        $safari_advance = SafariAdvance::query()->where('requisition_travelling_cost_id', requisition_travelling_cost::query()->where('requisition_id',$requisition->id)->first()->id)->first();
        $safari_advance_payment =  SafariAdvancePayment::query()->where('safari_advance_id', $safari_advance->id)->first();
        return view('finance.payments.safariAdvance.index')
            ->with('safari_advance', $safari_advance)
            ->with('requisition', $requisition)
            ->with('safari_advance_payment', $safari_advance_payment)
            ->with('payment', $payment)
            ;
    }



    public function programActivityPayment($uuid){

        $programActivityReport = ProgramActivityReport::query()->where('uuid', $uuid)->first();
        $programActivityReports = ProgramActivityReport::query()->where('program_activity_id', $programActivityReport->program_activity_id)->get();
        $program_activity = ProgramActivity::query()->where('id', $programActivityReport->program_activity_id)->first();
        $requisition_training = requisition_training::query()->where('id', $program_activity->requisition_training_id)->first();
        $requisition_training_participants = requisition_training_cost::query()->where('requisition_training_id', $requisition_training->id);
        $requisition_training_items = requisition_training_item::query()->where('requisition_training_id', $requisition_training->id);
        $requisition =  Requisition::query()->where('id', $requisition_training->requisition_id)->first();
        $attendance = $program_activity->attendance()->get();

        /* Check workflow */
        $wf_module_group_id = 9;
        $wf_module = $programActivityReport->wf_tracks->getWfModuleAfterWorkflowStart($wf_module_group_id, $programActivityReport->id);
        $workflow = new Workflow(['wf_module_group_id' => $wf_module_group_id, "resource_id" => $programActivityReport->id, 'type' => $wf_module->type]);
        $check_workflow = $workflow->checkIfHasWorkflow();
        $current_wf_track = $workflow->currentWfTrack();
        $wf_module_id = $workflow->wf_module_id;
        $current_level = $workflow->currentLevel();
        $can_edit_resource = $this->wf_tracks->canEditResource($programActivityReport, $current_level, $workflow->wf_definition_id);



        return view('finance.payments.programActivity.index')
            ->with('current_level', $current_level)
            ->with('current_wf_track', $current_wf_track)
            ->with('can_edit_resource', $can_edit_resource)
            ->with('wfTracks', (new WfTrackRepository())->getStatusDescriptions($programActivityReport))
            ->with('attendance', $attendance)
            ->with('program_activity_reports', $programActivityReports)
            ->with('program_activity_report', $programActivityReport);
    }

}
