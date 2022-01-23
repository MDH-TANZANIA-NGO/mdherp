<?php

namespace App\Http\Controllers\Web\Finance;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\Finance\Datatable\PaymentsDatatable;
use App\Models\ProgramActivity\ProgramActivity;
use App\Models\ProgramActivity\Traits\ProgramActivityRelationship;
use App\Models\Requisition\Requisition;
use App\Models\Requisition\Training\requisition_training;
use App\Models\Requisition\Training\requisition_training_cost;
use App\Models\Requisition\Travelling\requisition_travelling_cost;
use App\Models\SafariAdvance\SafariAdvance;
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

    public function __construct()
    {
        $this->requisitions = (new RequisitionRepository());
        $this->safariAdvance =  (new SafariAdvanceRepository());
        $this->program_activity = (new ProgramActivityRepository());
        $this->retirement = (new RetirementRepository());
        $this->requisition_training_cost = (new requisition_training_cost());
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
                ->with('program_activity', $this->program_activity->all()->where('uuid', $uuid))
                ->with('requisition_uuid', $requisition_uuid);

     }elseif ($program_activity_to_query)
        {
            $training =  requisition_training::where('id', $program_activity_to_query->requisition_training_id)->first();
            $requisition_id =  requisition_training::where('id', $training->id)->first()->requisition_id;
            $requisition_uuid =  Requisition::where('id', $requisition_id)->first()->uuid;

            return view('finance.payments.show')
                ->with('safari_advance', $safari)
                ->with('program_activity', $this->program_activity->all()->where('uuid', $uuid))
                ->with('requisition_uuid', $requisition_uuid)
                ->with('activity_participants', $program_activity_to_query->training->trainingCost()->get()->all())
                ->with('participant_total', $program_activity_to_query->training->trainingCost()->get()->pluck('total_amount')->sum())
                ->with('items_total', $program_activity_to_query->training->trainingItems()->get()->pluck('total_amount')->sum());
        }
//    dd();


    }
}
