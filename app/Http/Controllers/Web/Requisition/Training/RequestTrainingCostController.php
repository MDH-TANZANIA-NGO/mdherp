<?php

namespace App\Http\Controllers\Web\Requisition\Training;

use App\Http\Controllers\Controller;
use App\Http\Requests\Requisition\Training\RequisitionTrainingCostRequest;
use App\Models\Requisition\Requisition;
use App\Models\Requisition\Training\requisition_training;
use App\Models\Requisition\Training\requisition_training_cost;
use App\Models\Requisition\Training\requisition_training_item;
use App\Models\Requisition\Training\training;
use App\Repositories\GOfficer\GOfficerRepository;
use App\Repositories\GOfficer\GRateRepository;
use App\Repositories\Requisition\Training\RequestTrainingCostRepository;
use App\Repositories\Requisition\Training\RequisitionTrainingItemsRepository;
use App\Repositories\Requisition\Training\RequisitionTrainingRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RequestTrainingCostController extends Controller
{
    protected $gofficers;
    protected $grates;
    protected $trainingCost;
    protected $training;
    protected $trainingItem;


    public function __construct()
    {
        $this->gofficers = (new GOfficerRepository());
        $this->grates = (new GRateRepository());
        $this->trainingCost = (new RequestTrainingCostRepository());
        $this->trainingItem = (new RequisitionTrainingItemsRepository());
        $this->training =  (new RequisitionTrainingRepository());
    }

    public function index(){

        return view('requisition.Direct.training.index');

    }

    public function store(Request $request, Requisition $requisition){


        $this->trainingCost->store($requisition, $request->all());
        return redirect()->back();

    }

    public function create(){

        return view('requisition.Direct.training.forms.create')
            ->with('grates',$this->grates->getAll()->pluck('id','amount'))
            ->with('gofficers', $this->gofficers->getForPluckUnique());

    }

    public function show(){


    }

    public function update(){


    }
    public function storeTraining(Requisition $requisition,Request $request)
    {
        $from = $request->get('from');
        $to = $request->get('to');
        $datetime1 = new \DateTime($from);
        $datetime2 = new  \DateTime($to);
        $interval = $datetime1->diff($datetime2);
        $days = $interval->format('%a');

        $training = new requisition_training();
        $training-> requisition_id = request('requisition_id');
        $training-> district_id = request('district_id');
        $training-> start_date = request('from');
        $training-> end_date = request('to');
        $training->no_days = $days;
        $training->save();


        return redirect()->back();
    }

    public function storeTrainingItems(Request $request, Requisition $requisition){

        $this->trainingItem->store($requisition, $request->all());
        return redirect()->back();

    }
    public function removeItem( $uuid)
    {
        $requisition_training_item = requisition_training_item::query()->where('uuid', $uuid)->first();
        $requisition = Requisition::query()->where('id', $requisition_training_item->requisition_id)->first();

        return DB::transaction(function () use ($requisition,$requisition_training_item, $uuid){
                check_available_budget_individual($requisition, $requisition_training_item->total_amount,$requisition_training_item->total_amount, 0 );
                DB::delete('delete from requisition_training_items where uuid = ?',[$uuid]);
                $requisition->updatingTotalAmount();
            return redirect()->back();
        });
    }

    public function removeParticipant( $uuid)
    {
        $training_cost = requisition_training_cost::query()->where('uuid', $uuid)->first();
        $requisition =  Requisition::query()->where('id', $training_cost->requisition_id)->first();
        return DB::transaction(function () use ($requisition, $training_cost, $uuid){
            check_available_budget_individual($requisition, $training_cost->total_amount, $training_cost->total_amount, 0);
            DB::delete('delete from requisition_training_costs where uuid = ?',[$uuid]);
            $requisition->updatingTotalAmount();
            return redirect()->back();
        });
    }
    public function updateSchedule(Request $request, $uuid)
    {

        $requisition_training =  requisition_training::query()->where('uuid', $uuid)->first();
        $from = $request->get('from');
        $to = $request->get('to');
        $datetime1 = new \DateTime($from);
        $datetime2 = new  \DateTime($to);
        $interval = $datetime1->diff($datetime2);
        $days = $interval->format('%a');
        $days_int = (int)$days;



        if ($requisition_training->no_days >= $days_int){

            DB::update('update requisition_trainings set start_date = ?, end_date = ?, district_id = ?, no_days = ?  where uuid = ?', [$request->get('from'), $request->get('to'), $request->get('district_id'), $days_int, $uuid]);

            alert()->success('activity schedule successfully');
            return redirect()->back();
        }
        else{

           alert()->error('Sorry No Days are over requested days', 'Failed');
            return redirect()->back();
    }

    }
}

