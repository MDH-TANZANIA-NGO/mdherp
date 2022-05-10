<?php

namespace App\Http\Controllers\Web\Requisition\Travelling;

use App\Http\Controllers\Controller;
use App\Models\Requisition\Requisition;
use App\Models\Requisition\Travelling\requisition_travelling_cost;
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
        alert()->success('Trip added successfully','Success');
        return redirect()->back();
    }

    public function create($uuid)
    {
        $travelling_cost = $this->travellingCost->findByUuid($uuid);
        $trip_details =  $this->requisition_travelling_cost_district->getTravellerTrips($travelling_cost->traveller_uid);
        $requisition =  $this->requisition->find($travelling_cost->requisition_id);
        return view('requisition.Direct.travelling.Trip.index')
            ->with('requisition', $requisition)
            ->with('travelling_cost', $travelling_cost)
            ->with('trip_details', $trip_details->get())
            ->with('districts', $this->district->forSelect());
    }
    public function delete($uuid)
    {
        $travelling_cost_details =  $this->requisition_travelling_cost_district->findByUuid($uuid);
        $travelling_cost =  $this->travellingCost->find($travelling_cost_details->requisition_travelling_cost_id);
        $requisition =  $this->requisition->find($travelling_cost->requisition_id);
        check_available_budget_individual($requisition, $travelling_cost_details->total_amount, $travelling_cost_details->total_amount, 0);
        $this->requisition_travelling_cost_district->updateTravellingCostAmounts($uuid, $travelling_cost->traveller_uid);
        $this->requisition->updatingTotalAmount($requisition);
        DB::delete('delete from requisition_travelling_cost_districts where uuid = ?',[$uuid]);

        alert()->success('Trip deleted successfully', 'Success');
        return redirect()->back();
    }

}
