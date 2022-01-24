<?php

namespace App\Http\Controllers\Web\Finance;

use App\Events\NewWorkflow;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\Finance\Datatable\PaymentsDatatable;
use App\Models\Auth\User;
use App\Models\Payment\Payment;
use App\Models\ProgramActivity\ProgramActivity;
use App\Models\ProgramActivity\Traits\ProgramActivityRelationship;
use App\Models\Requisition\Requisition;
use App\Models\Requisition\Training\requisition_training;
use App\Models\Requisition\Training\requisition_training_cost;
use App\Models\Requisition\Travelling\requisition_travelling_cost;
use App\Models\SafariAdvance\SafariAdvance;
use App\Repositories\Finance\FinanceActivityRepository;
use App\Repositories\ProgramActivity\ProgramActivityRepository;
use App\Repositories\Requisition\RequisitionRepository;
use App\Repositories\Retirement\RetirementRepository;
use App\Repositories\SafariAdvance\SafariAdvanceRepository;
use Illuminate\Http\Request;

class FinanceActivityController extends Controller
{
    use PaymentsDatatable;


    protected $safariAdvance;
    protected $requisitions;
    protected $program_activity;
    protected $retirement;
    protected $requisition_training_cost;
    protected $finance;

    public function __construct()
    {
        $this->requisitions = (new RequisitionRepository());
        $this->safariAdvance =  (new SafariAdvanceRepository());
        $this->program_activity = (new ProgramActivityRepository());
        $this->retirement = (new RetirementRepository());
        $this->requisition_training_cost = (new requisition_training_cost());
        $this->finance =  (new FinanceActivityRepository());
    }
    public function index()
    {

        return view('finance.index')
            ->with('requisition', $this->requisitions->getAllApprovedRequisitions())
            ->with('program_activity', $this->program_activity->getAllApprovedProgramActivities())
            ->with('safariAdvance', $this->safariAdvance->getAllApprovedSafari())
            ->with('retirement', $this->retirement->getAllApprovedRetirements());
    }
    public function show($uuid)
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
                ->with('requisition', Requisition::where('uuid', $requisition_uuid)->first())
                ->with('program_activity', $this->program_activity->all()->where('uuid', $uuid))
                ->with('requisition_uuid', $requisition_uuid);

     }elseif ($program_activity_to_query)
        {

            $training =  requisition_training::where('id', $program_activity_to_query->requisition_training_id)->first();
            $requisition_id =  requisition_training::where('id', $training->id)->first()->requisition_id;
            $requisition_uuid =  Requisition::where('id', $requisition_id)->first()->uuid;

//            dd();
            return view('finance.payments.show')
                ->with('safari_advance', $safari)
                ->with('program_activity', $this->program_activity->all()->where('uuid', $uuid))
                ->with('requisition_uuid', $requisition_uuid)
                ->with('requisition', Requisition::where('uuid', $requisition_uuid)->first())
                ->with('activity_participants', $program_activity_to_query->training->trainingCost()->get()->all())
                ->with('training_items',$program_activity_to_query->training->trainingItems()->get()->all() )
                ->with('participant_total', $program_activity_to_query->training->trainingCost()->get()->pluck('amount_paid')->sum())
                ->with('items_total', $program_activity_to_query->training->trainingItems()->get()->pluck('total_amount')->sum());
        }



    }
    public function store(Request $request)
    {
        $pay = $this->finance->store($request->all());
        $wf_module_group_id = 2;
//        $next_user = User::query()->where('designation_id', '=', 50);
        $next_user = $pay->user->assignedSupervisor()->supervisor_id;
//        dd($next_user);
        event(new NewWorkflow(['wf_module_group_id' => $wf_module_group_id, 'resource_id' => $pay->id,'region_id' => $pay->region_id, 'type' => 1],[],['next_user_id' => $next_user]));


        return redirect()->back();
    }
}
