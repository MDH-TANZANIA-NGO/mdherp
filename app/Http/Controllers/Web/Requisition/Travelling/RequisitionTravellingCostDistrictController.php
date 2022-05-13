<?php

namespace App\Http\Controllers\Web\Requisition\Travelling;

use App\Http\Controllers\Controller;
use App\Models\Requisition\Requisition;
use App\Models\Requisition\Travelling\requisition_travelling_cost;
use App\Models\Requisition\Travelling\requisition_travelling_cost_district;
use App\Repositories\Requisition\RequisitionRepository;
use App\Repositories\Requisition\Travelling\RequestTravellingCostRepository;
use App\Repositories\Requisition\Travelling\RequisitionTravellingCostDistrictsRepository;
use App\Repositories\System\DistrictRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RequisitionTravellingCostDistrictController extends Controller
{
    //
    protected $requisition;
    protected $travellingCost;
    protected $district;
    protected $requisition_travelling_cost_district;

    public function __construct()
    {
        $this->district = (new DistrictRepository());
        $this->requisition = (new RequisitionRepository());
        $this->travellingCost = (new  RequestTravellingCostRepository());
        $this->requisition_travelling_cost_district = (new RequisitionTravellingCostDistrictsRepository());
    }

    public function store(Request $inputs)
    {
     $this->requisition_travelling_cost_district->store($inputs);
        return redirect()->back();
    }

    public function create($uuid)
    {
        $travelling_cost = $this->travellingCost->findByUuid($uuid);
        $from =  date('Y-m-d', strtotime($travelling_cost->from . ' +1 day'));
        $to =  date('Y-m-d', strtotime($travelling_cost->to . ' -1 day'));
        $trip_details =  $this->requisition_travelling_cost_district->getTravellerTrips($travelling_cost->traveller_uid, $travelling_cost->id);
        $requisition =  $this->requisition->find($travelling_cost->requisition_id);
        $available_days = $travelling_cost->no_days -  $trip_details->get()->sum('no_days');
        return view('requisition.Direct.travelling.Trip.index')
            ->with('requisition', $requisition)
            ->with('travelling_cost', $travelling_cost)
            ->with('trip_details', $trip_details->get())
            ->with('available_days', $available_days)
            ->with('from', $from)
            ->with('to', $to)
            ->with('districts', $this->district->forSelect());
    }
    public function edit($uuid)
    {

        $trip_details = $this->requisition_travelling_cost_district->findByUuid($uuid);
        $travelling_cost =  $this->travellingCost->find($trip_details->requisition_travelling_cost_id);
        $requisition =  $this->requisition->find($travelling_cost->requisition_id);
        $get_all_trips =  $this->requisition_travelling_cost_district->getTravellerTrips($travelling_cost->traveller_uid, $travelling_cost->id)->get();
        $available_days = $travelling_cost->no_days -  $get_all_trips->sum('no_days');
//        dd($available_days);
        return view('requisition.Direct.travelling.forms.Trip.edit')
            ->with('requisition', $requisition)
            ->with('travelling_cost', $travelling_cost)
            ->with('trip_details', $trip_details)
            ->with('available_days', $available_days)
            ->with('districts', $this->district->forSelect());
    }
    public function delete($uuid)
    {

    $this->requisition_travelling_cost_district->delete($uuid);

        return redirect()->back();
    }
    public function update(Request $inputs, $uuid)
    {
        $this->requisition_travelling_cost_district->update($inputs, $uuid);

        return redirect()->back();
    }
    public function submitAllTrips($uuid)
    {
        $travelling_cost =  $this->travellingCost->findByUuid($uuid);
        $requisition =  $this->requisition->find($travelling_cost->requisition_id);
        $this->requisition_travelling_cost_district->submitAllTrips($uuid);
        alert()->success('Traveller trips added successfully','Success');
        return redirect()->route('requisition.initiate', $requisition);
    }

}
