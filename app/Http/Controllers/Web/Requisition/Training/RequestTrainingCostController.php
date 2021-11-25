<?php

namespace App\Http\Controllers\Web\Requisition\Training;

use App\Http\Controllers\Controller;
use App\Http\Requests\Requisition\Training\RequisitionTrainingCostRequest;
use App\Models\Requisition\Requisition;
use App\Models\Requisition\Training\requisition_training_cost;
use App\Repositories\GOfficer\GOfficerRepository;
use App\Repositories\GOfficer\GRateRepository;
use App\Repositories\Requisition\Training\RequestTrainingCostRepository;
use Illuminate\Http\Request;

class RequestTrainingCostController extends Controller
{
    protected $gofficers;
    protected $grates;
    protected $trainingCost;


    public function __construct()
    {
        $this->gofficers = (new GOfficerRepository());
        $this->grates = (new GRateRepository());
        $this->trainingCost = (new RequestTrainingCostRepository());
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
}
