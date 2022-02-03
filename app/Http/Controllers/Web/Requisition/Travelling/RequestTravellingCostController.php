<?php

namespace App\Http\Controllers\Api\Facility\Web\Requisition\Travelling;

use App\Http\Controllers\Api\Facility\Controller;
use App\Http\Controllers\Api\Facility\Web\Requisition\Travelling\Traits\travellingCostsDatatable;
use App\Models\Requisition\Requisition;
use App\Models\System\District;
use App\Repositories\Access\UserRepository;
use App\Repositories\MdhRates\mdhRatesRepository;
use App\Repositories\Requisition\Travelling\RequestTravellingCostRepository;
use App\Repositories\System\DistrictRepository;
use Illuminate\Http\Request;

class RequestTravellingCostController extends Controller
{
    //
    use travellingCostsDatatable;

    protected $mdh_staff;
    protected $mdh_rates;
    protected $travellingCost;
    protected $district;

    public function __construct()
    {
        $this->mdh_rates = (new mdhRatesRepository());
        $this->mdh_staff = (new UserRepository());
        $this->travellingCost = (new RequestTravellingCostRepository());
        $this->district =  (new DistrictRepository());
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
    public function edit($uuid)
    {



        $traveller =  $this->travellingCost->findByUuid($uuid);
        return view('requisition.Direct.travelling.forms.edit')
            ->with('traveller', $traveller)
            ->with('districts', $this->district->getForPluck())
            ->with('mdh_rates',$this->mdh_rates->getAll()->pluck('id','amount'))
            ->with('mdh_staff', $this->mdh_staff->getQuery()->pluck('name', 'user_id'));
    }

    public function update($uuid, Request $request){

        $traveller  =  $this->travellingCost->findByUuid($uuid);

        $this->travellingCost->update($uuid, $request->all());

        return redirect()->route('requisition.initiate', $traveller->requisition);


    }
}
