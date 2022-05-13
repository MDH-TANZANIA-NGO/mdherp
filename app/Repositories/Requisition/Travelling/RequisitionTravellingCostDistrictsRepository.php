<?php

namespace App\Repositories\Requisition\Travelling;

use App\Models\Auth\User;
use App\Models\MdhRates\mdh_rate;
use App\Models\Requisition\Requisition;
use App\Models\Requisition\Travelling\requisition_travelling_cost;
use App\Models\Requisition\Travelling\requisition_travelling_cost_district;
use App\Models\System\District;
use App\Repositories\BaseRepository;
use App\Repositories\MdhRates\mdhRatesRepository;
use App\Repositories\Requisition\RequisitionRepository;
use Illuminate\Support\Facades\DB;

class RequisitionTravellingCostDistrictsRepository extends BaseRepository
{

    const MODEL = requisition_travelling_cost_district::class;


    protected $mdh_rates;
    protected $requisition;

    public function __construct()
    {
        //
        $this->mdh_rates = (new mdhRatesRepository());
        $this->requisition = (new RequisitionRepository());
    }


    public function getQuery()
    {
        return $this->query()->select([
            DB::raw('requisition_travelling_cost_districts.id AS id'),
            DB::raw('requisition_travelling_cost_districts.requisition_travelling_cost_id AS requisition_travelling_cost_id'),
            DB::raw('requisition_travelling_cost_districts.created_at AS created_at'),
            DB::raw('requisition_travelling_cost_districts.uuid AS uuid'),
            DB::raw('requisition_travelling_cost_districts.district_id AS district_id'),
            DB::raw('requisition_travelling_cost_districts.mdh_rate_id AS mdh_rate_id'),
            DB::raw('requisition_travelling_cost_districts.from AS from'),
            DB::raw('requisition_travelling_cost_districts.to AS to'),
            DB::raw('requisition_travelling_cost_districts.no_days AS no_days'),
            DB::raw('requisition_travelling_cost_districts.perdiem_total_amount AS perdiem_total_amount'),
            DB::raw('requisition_travelling_cost_districts.transportation AS transportation'),
            DB::raw('requisition_travelling_cost_districts.accommodation AS accommodation'),
            DB::raw('requisition_travelling_cost_districts.total_accommodation AS total_accommodation'),
            DB::raw('requisition_travelling_cost_districts.ontransit AS ontransit'),
            DB::raw('requisition_travelling_cost_districts.ticket_fair AS ticket_fair'),
            DB::raw('requisition_travelling_cost_districts.other_cost AS other_cost'),
            DB::raw('requisition_travelling_cost_districts.other_cost_description AS other_cost_description'),
            DB::raw('requisition_travelling_cost_districts.total_amount AS total_amount'),
        ]);
    }

    public function getTravellerTrips($user_id, $travelling_cost_id)
    {
        return $this->getQuery()
            ->join('requisition_travelling_costs', 'requisition_travelling_costs.id', 'requisition_travelling_cost_districts.requisition_travelling_cost_id')
            ->where('requisition_travelling_costs.traveller_uid', $user_id)
            ->where('requisition_travelling_costs.id', $travelling_cost_id);
    }
    public  function getTripsReagions($user_id, $traveller_region,$travelling_cost_id )
    {
        return $this->getTravellerTrips($user_id, $travelling_cost_id)
            ->join('districts', 'requisition_travelling_cost_districts.district_id', 'districts.id')
            ->join('regions', 'regions.id', 'districts.region_id')
            ->where('regions.id','!=',$traveller_region);
    }
    public function getOntransit($user_id, $travelling_cost_id)
    {
        return $this->getTravellerTrips($user_id, $travelling_cost_id)
            ->where('requisition_travelling_cost_districts.ontransit', '!=', 0)
            ->first();
    }
    public function TripInputProcess($inputs)
    {
        $destination_region = District::query()->find($inputs['district_id'])->region_id;
        $traveller_region_id = User::query()->find($inputs['traveller_uid'])->region_id;
        $days = getNoDays($inputs['from'], $inputs['to']);
        $travelling_cost =  (new RequestTravellingCostRepository())->find($inputs['requisition_travelling_cost_id']);
        $days_difference = getNoDays($travelling_cost->from, $travelling_cost->to);
        if ($days_difference > 2)
        {
            $perdiem_total_amount =  $this->getPerdiem($traveller_region_id,$destination_region,$days);
            $ontransit = 0;
        }
        else{

            $perdiem_total_amount = $this->getTravellerTotalMealsAndIncidentials($traveller_region_id, $destination_region, $days);
            $ontransit = 0;
        }
        $meals_and_incidential_rate_id = $this->mdh_rates->getRateIDByRegion($destination_region);
        $meals_and_incidential_rate_id = $meals_and_incidential_rate_id[0];
//        $ontransit = $this->getTravellerOntransitTotalAmount($traveller_region_id, $destination_region, $days);
        $accommodation = $this->getTravellerTotalAccommodation($inputs['accommodation'], $days);
        $total_amount = $perdiem_total_amount + $ontransit + $accommodation + $inputs['transportation'] + $inputs['ticket_fair'] + $inputs['other_cost'];


        return [
            'perdiem_total_amount' => $perdiem_total_amount,
            'traveller_uid' => $inputs['traveller_uid'],
            'district_id' => $inputs['district_id'],
            'no_days' => $days,
            'ontransit' => $ontransit,
            'accommodation' => $inputs['accommodation'],
            'total_accommodation' => $accommodation,
            'transportation' => $inputs['transportation'],
            'ticket_fair' => $inputs['ticket_fair'],
            'requisition_travelling_cost_id' => $inputs['requisition_travelling_cost_id'],
            'from' => $inputs['from'],
            'to' => $inputs['to'],
            'other_cost' => $inputs['other_cost'],
            'other_cost_description' => $inputs['other_cost_description'],
            'mdh_rate_id' => $meals_and_incidential_rate_id,
            'total_amount' => $total_amount,

        ];
    }

    public function getPerdiem($traveller_region, $destination_region, $days)
    {
        if ($traveller_region == $destination_region) {
                $meals_and_incident = 60000;
                $meals_and_incident_total_amount = $meals_and_incident * ($days);


        }
        if ($traveller_region != $destination_region) {
                $meals_and_incidential_rate = $this->mdh_rates->getRateByRegion($destination_region);
                $meals_and_incident = $meals_and_incidential_rate[0];
                $meals_and_incident_total_amount = $meals_and_incident * ($days);


        }

        return $meals_and_incident_total_amount;
    }
    public function getTravellerTotalMealsAndIncidentials($traveller_region, $destination_region, $days)
    {
        if ($traveller_region == $destination_region) {
            if ($days > 1) {
//                $meals_and_incidential_rate =  $this->mdh_rates->getNotAssignedRegionRate()->get();
                $meals_and_incident = 60000;
                $meals_and_incident_total_amount = $meals_and_incident * ($days - 1);


            }
            if ($days == 1) {
                $meals_and_incident_total_amount = 0;
            }
        }
        if ($traveller_region != $destination_region) {
            if ($days > 2) {
                $meals_and_incidential_rate = $this->mdh_rates->getRateByRegion($destination_region);
                $meals_and_incident = $meals_and_incidential_rate[0];
                $meals_and_incident_total_amount = $meals_and_incident * ($days - 2);


            }
            if ($days <= 2) {
                $meals_and_incident_total_amount = 0;
            }
        }

        return $meals_and_incident_total_amount;
    }

    public function getTravellerTotalAccommodation($accommodation, $days)
    {
        if ($days > 1) {
            $accomodation_total_amount = $accommodation * ($days - 1);
        }

        return $accomodation_total_amount;
    }

    public function getTravellerOntransitTotalAmount($traveller_region, $destination_region, $days)
    {
        if ($traveller_region == $destination_region) {
            $ontransit_total_amount = 0;
        }
        if ($traveller_region != $destination_region) {
            if ($days >= 2) {
                $meals_and_incidential_rate = $this->mdh_rates->getRateByRegion($destination_region);
                $meals_and_incident = $meals_and_incidential_rate[0];
                $ontransit_amount = $meals_and_incident * 0.75;
                $ontransit_total_amount = $ontransit_amount * 2;


            }
            if ($days < 2) {
                $ontransit_total_amount = 0;
            }
        }

        return $ontransit_total_amount;
    }

    public function store($inputs)
    {
        $travelling_cost = (new RequestTravellingCostRepository())->findByUuid($inputs['travelling_cost_uuid']);
        $requisition = $this->requisition->find($travelling_cost->requisition_id);
        $get_total_trips = $this->getTravellerTrips($travelling_cost->traveller_uid, $travelling_cost->id)->get();
//        $get_trip_range = $this->getTripDateRange($inputs['from'],$inputs['to'],$travelling_cost->traveller_uid);

//        Check If Dates are entered correctly

        if ($inputs['from'] > $inputs['to']) {
            alert()->error('Dates selected are ambiguous', 'Error');
        }

//        Check If It is first trip then submit(Add Trip)
        if (!$get_total_trips){
            return DB::transaction(function () use ($inputs) {
                $this->query()->create($this->TripInputProcess($inputs));
                alert()->success('Trip added successfully', 'Success');
            });
        }

//        If it is not first trip

//        Check If there is available days
        if (($get_total_trips->sum('no_days') - $travelling_cost->no_days) != 0){
            return DB::transaction(function () use ($inputs) {
                $this->query()->create($this->TripInputProcess($inputs));
                alert()->success('Trip added successfully', 'Success');
            });
        }
        if (($get_total_trips->sum('no_days') - $travelling_cost->no_days) == 0)
        {
            alert()->error('No available days','Failed');
        }

////        Check If Date Range already Exist
//        if ($get_trip_range)
//        {
//            alert()->error('Date range is already selected', 'Error');
//        }
//        if (!$get_trip_range){
//            return DB::transaction(function () use ($inputs) {
//                $this->query()->create($this->TripInputProcess($inputs));
//                alert()->success('Trip added successfully', 'Success');
//            });
//        }



    }


    public function getTripDateRange($from,$to, $user_id, $travelling_cost_id)
    {
        return $this->getTravellerTrips($user_id, $travelling_cost_id)
            ->whereDate('requisition_travelling_cost_districts.from','>', $from)
//            ->whereDate('requisition_travelling_cost_districts.to','<', $to)
            ->get();
    }


    public function  updateTravellingCostAmounts($uuid, $traveller_id, $travelling_cost_id)
    {
        $travelling_cost = (new RequestTravellingCostRepository())->findByUuid($uuid);
        $traveller_details = $this->getTravellerTrips($traveller_id, $travelling_cost->id)->get();

        $district_id = $traveller_details->first()->district_id;
        $destination_region = $traveller_details->first()->district->region_id;
        $days = getNoDays($travelling_cost->from, $travelling_cost->to);
        $get_none_traveller_regions = $this->getTripsReagions($travelling_cost->traveller_uid, $travelling_cost->user->region_id, $travelling_cost->id)->get();
        $mdh_rate_amount =( $traveller_details->first()->perdiem_total_amount) / ($traveller_details->first()->no_days);

        if ($get_none_traveller_regions->count() > 0)
        {
            $ontransit =  ($mdh_rate_amount * 0.75)*2;
            $perdiem_total_amount = $traveller_details->sum('perdiem_total_amount');

        }
        if ($get_none_traveller_regions->count() == 0){
            $ontransit =  0;
            $perdiem_total_amount = $traveller_details->sum('perdiem_total_amount') + $mdh_rate_amount;

        }


            $accommodation = $traveller_details->sum('total_accommodation');
            $transportation = $traveller_details->sum('transportation');
            $ticket_fair = $traveller_details->sum('ticket_fair');
            $other_cost = $traveller_details->sum('other_cost');
            $total_amount = $accommodation + $transportation + $ticket_fair + $other_cost + $perdiem_total_amount + $ontransit;

            DB::table('requisition_travelling_costs')
                ->where('uuid', $uuid)
                ->update([
                    'district_id'=> $district_id,
                    'perdiem_total_amount' => $perdiem_total_amount,
                    'ontransit' => $ontransit,
                    'accommodation' => $accommodation,
                    'transportation' => $transportation,
                    'ticket_fair' => $ticket_fair,
                    'other_cost' => $other_cost,
                    'total_amount' => $total_amount,
                ]);
        }


    public function delete($uuid)
    {
        $travelling_cost_details = $this->findByUuid($uuid);
        $travelling_cost = (new RequestTravellingCostRepository())->find($travelling_cost_details->requisition_travelling_cost_id);
        $get_traveller_trips = $this->getTravellerTrips($travelling_cost->traveller_uid, $travelling_cost->id)->get();

        if ($get_traveller_trips->count() != 1)
        {
            $travelling_cost_details->forceDelete();
            alert()->success('Trip Deleted Successfully', 'Success');

        }
        else{
            alert()->error('Traveller must have at least one trip','Failed');
        }
    }

public function update($inputs, $uuid)
{
    $trip_details = $this->findByUuid($uuid);
    $travelling_cost = (new RequestTravellingCostRepository())->findByUuid($inputs['travelling_cost_uuid']);
    $requisition = $this->requisition->find($travelling_cost->requisition_id);
    $get_total_trips_days = $this->getTravellerTrips($travelling_cost->traveller_uid, $travelling_cost->id)->get();
    $days = getNoDays($inputs['from'], $inputs['to']);

//    Check if Dates are correct inserted
    if ($inputs['from'] > $inputs['to']) {
        alert()->error('Dates selected are ambiguous', 'Error');
    }

    return DB::transaction(function () use ($inputs, $trip_details) {
        $trip_details->update($this->TripInputProcess($inputs));
        alert()->success('Trip updated successfully', 'Success');
    });

}

public function submitAllTrips($uuid)
{
    $travelling_cost =  (new RequestTravellingCostRepository())->findByUuid($uuid);
    $get_traveller_trips =  $this->getTravellerTrips($travelling_cost->traveller_uid, $travelling_cost->id)->get();
    $requisition =  $this->requisition->find($travelling_cost->requisition_id);
    check_available_budget_individual($requisition,$get_traveller_trips->sum('total_amount'));
    $this->updateTravellingCostAmounts($uuid, $travelling_cost->traveller_uid);
    $this->requisition->updatingTotalAmount($requisition);
}
}
