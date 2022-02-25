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
            ->with('gofficers', $this->gofficers->getAll()->pluck('id','first_name'));

    }

    public function show(){


    }

    public function update(){


    }
    public function storeTraining(Requisition $requisition,Request $request)
    {
        $training = new requisition_training();
        $training-> requisition_id = request('requisition_id');
        $training-> district_id = request('district_id');
        $training-> from = request('from');
        $training-> to = request('to');
        $training->save();


        return redirect()->back();
    }

    public function storeTrainingItems(Request $request, Requisition $requisition){

        $this->trainingItem->store($requisition, $request->all());
        return redirect()->back();

    }
    public function removeItem( $uuid)
    {
        $requisition = Requisition::query()->where('id', requisition_training_item::query()->where('uuid', $uuid)->first()->requisition_id)->first();

        return DB::transaction(function () use ($requisition, $uuid){

                DB::delete('delete from requisition_training_items where uuid = ?',[$uuid]);
                $requisition->updatingTotalAmount();
            return redirect()->back();
        });
    }

    public function removeParticipant( $uuid)
    {
        $requisition =  Requisition::query()->where('id', requisition_training_cost::query()->where('uuid', $uuid)->first()->requisition_id)->first();
        return DB::transaction(function () use ($requisition, $uuid){

            DB::delete('delete from requisition_training_costs where uuid = ?',[$uuid]);
            $requisition->updatingTotalAmount();
            return redirect()->back();
        });
    }
    public function updateSchedule($uuid)
    {

    }
}
