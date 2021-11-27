<?php

namespace App\Http\Controllers\Web\Requisition\Travelling;

use App\Http\Controllers\Controller;
use App\Models\Requisition\Requisition;
use App\Repositories\Access\UserRepository;
use App\Repositories\MdhRates\mdhRatesRepository;
use App\Repositories\Requisition\Travelling\RequestTravellingCostRepository;
use Illuminate\Http\Request;

class RequestTravellingCostController extends Controller
{
    //
    protected $mdh_staff;
    protected $mdh_rates;
    protected $travellingCost;

    public function __construct()
    {
        $this->mdh_rates = (new mdhRatesRepository());
        $this->mdh_staff = (new UserRepository());
        $this->travellingCost = (new RequestTravellingCostRepository());
    }

    public function index(){
        return view('requisition.Direct.travelling.index', );

    }

    public function store(Request $request, Requisition $requisition){

        $this->travellingCost->store($requisition, $request->all());
        return redirect()->back();


    }

    public function create(){



        return view('requisition.Direct.travelling.forms.create')
            ->with('mdh_rates',$this->mdh_rates->getAll()->pluck('id','amount'))
            ->with('mdh_staff', $this->mdh_staff->getUserQuery()->pluck('id', 'first_name'));

    }

    public function show(){


    }

    public function update(){


    }
}
