<?php

namespace App\Http\Controllers\Web\Requisition\Travelling;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\Requisition\Travelling\Traits\travellingCostsDatatable;
use App\Models\Requisition\Requisition;
use App\Models\Requisition\Travelling\requisition_travelling_cost;
use App\Models\Requisition\Travelling\requisition_travelling_cost_district;
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
        $requisition =  $this->requisition->find($traveller->requisition_id);
        $requisition_id = $requisition->id;
        $current_total =  $requisition->amount;
        DB::delete('delete from requisition_travelling_costs where uuid = ?',[$uuid]);
        $this->requisition->updatingTotalAmount($requisition);
        $new_total =  $requisition->amount;
        add_actual_amount_on_requisition_fund_checker($requisition_id, $current_total, $new_total);
        return redirect()->back();
    }
    public function updateDateRange(Request $request, $uuid)
    {
        $no_days = getNoDays($request['from'], $request['to']);
        DB::table('requisition_travelling_costs')
            ->where('uuid', $uuid)
            ->update([
                'from'=> $request['from'],
                'to'=> $request['to'],
                'no_days'=>$no_days,
            ]);
        alert()->success('Date range updated successfully', 'Success');
        return redirect()->back();
    }
    public function update($uuid, Request $request){

        $traveller  =  $this->travellingCost->findByUuid($uuid);
        $requisition =  $this->requisition->find($traveller->requisition_id);
        $current_total =  $requisition->amount;
        $this->travellingCost->update($uuid, $request->all());
        $this->requisition->updatingTotalAmount($requisition);
        $new_total =  $requisition->amount;
        deduct_actual_amount_on_requisition_fund_checker($requisition->id, $current_total, $new_total);
        return redirect()->route('requisition.initiate', $traveller->requisition);


    }
}
