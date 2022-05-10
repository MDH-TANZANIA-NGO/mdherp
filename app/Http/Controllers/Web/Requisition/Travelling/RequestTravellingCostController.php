<?php

namespace App\Http\Controllers\Web\Requisition\Travelling;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\Requisition\Travelling\Traits\travellingCostsDatatable;
use App\Models\Requisition\Requisition;
use App\Models\Requisition\Travelling\requisition_travelling_cost;
use App\Models\System\District;
use App\Repositories\Access\UserRepository;
use App\Repositories\MdhRates\mdhRatesRepository;
use App\Repositories\Requisition\RequisitionRepository;
use App\Repositories\Requisition\Travelling\RequestTravellingCostRepository;
use App\Repositories\Requisition\Travelling\RequisitionTravellingCostDistrictsRepository;
use App\Repositories\System\DistrictRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RequestTravellingCostController extends Controller
{
    //
    use travellingCostsDatatable;

    protected $mdh_staff;
    protected $mdh_rates;
    protected $travellingCost;
    protected $district;
    protected $requisition;

    public function __construct()
    {
        $this->mdh_rates = (new mdhRatesRepository());
        $this->mdh_staff = (new UserRepository());
        $this->travellingCost = (new RequestTravellingCostRepository());
        $this->district =  (new DistrictRepository());
        $this->requisition = (new RequisitionRepository());

    }

    public function index(){


        return view('requisition.Direct.travelling.index' );

    }

    public function store(Request $request, Requisition $requisition){


        $requisition_travelling_cost_id = $this->travellingCost->store($requisition, $request->all());
         $requisition_travelling_cost = $this->travellingCost->find($requisition_travelling_cost_id);
        return redirect()->route('trip.create',$requisition_travelling_cost->uuid );


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
        $traveller_details =  $this->travellingCost->getQuery()->first();

        $requisition =  $this->requisition->find($traveller->requisition_id);



        return view('requisition.Direct.travelling.forms.edit')
            ->with('traveller', $traveller)
            ->with('requisition', $requisition)
            ->with('user',$traveller->user()->first()->first_name )
            ->with('districts', $this->district->getForPluck())
            ->with('mdh_rates',$this->mdh_rates->getAll()->pluck('id','amount'))
            ->with('mdh_staff', $this->mdh_staff->getQuery()->pluck('name', 'user_id'));
    }
    public function delete($uuid)
    {



        $traveller =  $this->travellingCost->findByUuid($uuid);
        $traveller_details =  $this->travellingCost->getQuery()->first();
        $requisition =  Requisition::query()->where('id',    $traveller->requisition_id)->first();
        check_available_budget_individual($requisition, $traveller->total_amount, $traveller->total_amount, 0);
        DB::delete('delete from requisition_travelling_costs where uuid = ?',[$uuid]);
        $this->requisition->updatingTotalAmount($requisition);
        return redirect()->back();
    }

    public function update($uuid, Request $request){

        $traveller  =  $this->travellingCost->findByUuid($uuid);
        $requisition =  Requisition::query()->where('id', $traveller->requisition_id)->first();
        $this->travellingCost->update($uuid, $request->all());
        $this->requisition->updatingTotalAmount($requisition);

        return redirect()->route('requisition.initiate', $traveller->requisition);


    }
}
