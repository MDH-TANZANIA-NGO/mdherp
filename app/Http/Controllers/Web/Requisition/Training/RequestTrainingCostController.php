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

class RequestTrainingCostController extends Controller
{
    protected $gofficers;
    protected $grates;
    protected $trainingCost;
    protected $training;


    public function __construct()
    {
        $this->gofficers = (new GOfficerRepository());
        $this->grates = (new GRateRepository());
        $this->trainingCost = (new RequestTrainingCostRepository());
        $this->training = (new RequisitionTrainingItemsRepository());
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

        $this->training->store($requisition, $request->all());
        return redirect()->back();

    }
}
