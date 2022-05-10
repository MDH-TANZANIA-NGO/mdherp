<?php

namespace App\Repositories\Requisition\Travelling;

use App\Models\Auth\User;
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

    const MODEL =  requisition_travelling_cost_district::class;


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
            DB::raw('requisition_travelling_cost_districts.other_cost AS other_cost'),
            DB::raw('requisition_travelling_cost_districts.other_cost_description AS other_cost_description'),
            DB::raw('requisition_travelling_cost_districts.total_amount AS total_amount'),
        ]);
    }
    public function getTravellerTrips($user_id)
    {
        return $this->getQuery()
            ->join('requisition_travelling_costs', 'requisition_travelling_costs.id', 'requisition_travelling_cost_districts.requisition_travelling_cost_id')
            ->where('requisition_travelling_costs.traveller_uid', $user_id);
    }

    public function TripInputProcess($inputs)
    {
        $destination_region = District::query()->find($inputs['district_id'])->region_id;
        $traveller_region_id = User::query()->find($inputs['traveller_uid'])->region_id;
        $days = getNoDays($inputs['from'], $inputs['to']);
        $meals_and_incidential_rate_id =  $this->mdh_rates->getRateIDByRegion($destination_region);
        $meals_and_incidential_rate_id = $meals_and_incidential_rate_id[0];
        $meals_and_incidential_rate =  $this->mdh_rates->getRateByRegion($destination_region);
        $perdiem_total_amount = $this->getTravellerTotalMealsAndIncidentials($traveller_region_id, $destination_region, $days);
        $ontransit =  $this->getTravellerOntransitTotalAmount($traveller_region_id, $destination_region, $days);
        $accommodation = $this->getTravellerTotalAccommodation($inputs['accommodation'], $days);
        $total_amount =  $perdiem_total_amount + $ontransit + $accommodation + $inputs['transportation'] + $inputs['ticket_fair'] + $inputs['other_cost'] ;





        return [
            'perdiem_total_amount'=> $perdiem_total_amount,
            'traveller_uid' => $inputs['traveller_uid'],
            'district_id'=> $inputs['district_id'],
            'no_days' => $days,
            'ontransit'=> $ontransit,
            'accommodation'=>$inputs['accommodation'],
            'total_accommodation'=>$accommodation,
            'transportation'=> $inputs['transportation'],
            'ticket_fair'=>$inputs['ticket_fair'],
            'requisition_travelling_cost_id'=>$inputs['requisition_travelling_cost_id'],
            'from' => $inputs['from'],
            'to' => $inputs['to'],
            'other_cost'=>$inputs['other_cost'],
            'other_cost_description'=>$inputs['other_cost_description'],
            'mdh_rate_id'=>$meals_and_incidential_rate_id,
            'total_amount' =>  $total_amount,

        ];
    }



    public function getTravellerTotalMealsAndIncidentials($traveller_region,$destination_region, $days)
    {
        if ($traveller_region == $destination_region){
            if ($days > 1)
            {
//                $meals_and_incidential_rate =  $this->mdh_rates->getNotAssignedRegionRate()->get();
                $meals_and_incident = 60000;
                $meals_and_incident_total_amount = $meals_and_incident *($days-1);


            }
            if ($days == 1)
            {
                $meals_and_incident_total_amount = 0;
            }
        }
        if ($traveller_region != $destination_region){
            if ($days > 2)
            {
                $meals_and_incidential_rate =  $this->mdh_rates->getRateByRegion($destination_region);
                $meals_and_incident = $meals_and_incidential_rate[0];
                $meals_and_incident_total_amount = $meals_and_incident *($days-2);


            }
            if ($days <= 2)
            {
                $meals_and_incident_total_amount = 0;
            }
        }

        return $meals_and_incident_total_amount;
    }

    public function getTravellerTotalAccommodation($accommodation, $days)
    {
        if ($days >1){
            $accomodation_total_amount =  $accommodation * ($days-1);
        }

        return $accomodation_total_amount;
    }
    public function getTravellerOntransitTotalAmount($traveller_region,$destination_region, $days)
    {
        if ($traveller_region == $destination_region){

            $ontransit_total_amount = 0;
        }
        if ($traveller_region != $destination_region){
            if ($days >= 2)
            {
                $meals_and_incidential_rate =  $this->mdh_rates->getRateByRegion($destination_region);
                $meals_and_incident = $meals_and_incidential_rate[0];
                $ontransit_amount =  $meals_and_incident *(0.75);
                $ontransit_total_amount = $ontransit_amount * 2;


            }
            if ($days < 2)
            {
                $ontransit_total_amount = 0;
            }
        }

        return $ontransit_total_amount;
    }

    public function store($inputs)
    {
        $inputs_captured =  $this->TripInputProcess($inputs);
        $travelling_cost = requisition_travelling_cost::query()->where('id', $this->TripInputProcess($inputs)['requisition_travelling_cost_id'])->first();
       $requisition =  $this->requisition->find($travelling_cost->requisition_id);
       $current_amount = $requisition->amount;
       $updated_amount = $inputs_captured['total_amount'];
        check_available_budget_individual($requisition,$current_amount,$current_amount, $updated_amount);
        $this->updateTravellingCostAmounts($travelling_cost->uuid,$travelling_cost->traveller_uid);
        $this->requisition->updatingTotalAmount($requisition);
        return DB::transaction(function () use ($inputs){
            return $this->query()->create($this->TripInputProcess($inputs));
        });
    }

    public function  updateTravellingCostAmounts($uuid, $traveller_id)
    {
        $traveller_details =  $this->getTravellerTrips($traveller_id)->get();
        $perdiem_total_amount = $traveller_details->sum('perdiem_total_amount');
        $ontransit = $traveller_details->sum('ontransit');
        $accommodation = $traveller_details->sum('accommodation');
        $transportation = $traveller_details->sum('transportation');
        $ticket_fair = $traveller_details->sum('ticket_fair');
        $other_cost = $traveller_details->sum('other_cost');
        $total_amount = $traveller_details->sum('total_amount');

        DB::table('requisition_travelling_costs')
            ->where('uuid', $uuid)
            ->update([
                'perdiem_total_amount'=> $perdiem_total_amount,
                'ontransit'=> $ontransit,
                'accommodation'=>$accommodation,
                'transportation'=> $transportation,
                'ticket_fair'=>$ticket_fair,
                'other_cost'=>$other_cost,
                'total_amount' =>  $total_amount,
            ]);
    }




}
