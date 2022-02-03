<?php

namespace App\Http\Controllers\Api\Facility\Web\Finance;

use App\Events\NewWorkflow;
use App\Exports\PaymentExport;
use App\Http\Controllers\Api\Facility\Controller;
use App\Http\Controllers\Api\Facility\Web\Finance\Datatable\PaymentsDatatable;
use App\Models\Auth\User;
use App\Models\Payment\Payment;
use App\Models\ProgramActivity\ProgramActivity;
use App\Models\ProgramActivity\Traits\ProgramActivityRelationship;
use App\Models\Requisition\Requisition;
use App\Models\Requisition\Training\requisition_training;
use App\Models\Requisition\Training\requisition_training_cost;
use App\Models\Requisition\Traits\Relaltionship\RequisitionRelationship;
use App\Models\Requisition\Travelling\requisition_travelling_cost;
use App\Models\SafariAdvance\SafariAdvance;
use App\Models\SafariAdvance\SafariAdvanceDetails;
use App\Models\SafariAdvance\Traits\SafariAdvanceRelationship;
use App\Repositories\Finance\FinanceActivityRepository;
use App\Repositories\ProgramActivity\ProgramActivityRepository;
use App\Repositories\Requisition\RequisitionRepository;
use App\Repositories\Retirement\RetirementRepository;
use App\Repositories\SafariAdvance\SafariAdvanceRepository;
use App\Repositories\Workflow\WfTrackRepository;
use App\Services\Workflow\Workflow;
use Illuminate\Http\Request;
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

    public function __construct()
    {
        $this->requisitions = (new RequisitionRepository());
        $this->safariAdvance =  (new SafariAdvanceRepository());
        $this->program_activity = (new ProgramActivityRepository());
        $this->retirement = (new RetirementRepository());
        $this->requisition_training_cost = (new requisition_training_cost());
        $this->finance =  (new FinanceActivityRepository());
        $this->wf_tracks = (new WfTrackRepository());
    }
    public function index()
    {

        return view('finance.index')
            ->with('requisition', $this->requisitions->getAllApprovedRequisitions())
            ->with('program_activity', $this->program_activity->getAllApprovedProgramActivities())
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
}
