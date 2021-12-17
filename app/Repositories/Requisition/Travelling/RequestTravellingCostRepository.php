<?php

namespace App\Repositories\Requisition\Travelling;

use App\Models\Auth\User;
use App\Models\MdhRates\mdh_rate;
use App\Models\Requisition\Requisition;
use App\Models\Requisition\Travelling\requisition_travelling_cost;
use App\Models\System\District;
use App\Models\System\Region;
use Illuminate\Support\Facades\DB;

class RequestTravellingCostRepository
{
    const MODEL = requisition_travelling_cost::class;
    public function __construct()
    {
        //
    }
    public function getQuery()
    {
        return $this->query()->select([
            DB::raw('requisition_travelling_costs.id AS id'),
            DB::raw('requisition_travelling_costs.traveller_uid AS traveller_uid'),
            DB::raw('requisition_travelling_costs.no_days AS no_days'),
            DB::raw('requisition_travelling_costs.perdiem_total_amount AS perdiem_total_amount'),
            DB::raw('requisition_travelling_costs.accommodation AS accommodation'),
            DB::raw('requisition_travelling_costs.transportation AS transportation'),
            DB::raw('requisition_travelling_costs.other_cost AS other_cost'),
            DB::raw('requisition_travelling_costs.total_amount AS total_amount'),
        ]);
    }

    public function inputProcess($inputs)
    {
        $destination_region = District::query()->find($inputs['district_id'])->region_id;
        $traveller_region_id = User::query()->find($inputs['traveller_uid'])->region_id;
        $region_status = Region::query()->find($destination_region)->is_city;
        $from = $inputs['from'];
        $to = $inputs['to'];
        $datetime1 = new \DateTime($from);
        $datetime2 = new  \DateTime($to);
        $interval = $datetime1->diff($datetime2);
        $days = $interval->format('%a');
        $accommodation = $inputs['accommodation'];

        if ($destination_region == $traveller_region_id){
            $perdiem_rate = 60000;
            $ontransit = 0;
            $perdiem_total_amount = $perdiem_rate *$days;
            $accommodation = $accommodation * $days;
            $total_amount = $perdiem_total_amount + $inputs['transportation'] + $inputs['other_cost'] + $accommodation;

        }
        else{
                if ($region_status == 'TRUE'){
                    $perdiem_rate = 90000;
                    $perdiem_total_amount = $perdiem_rate *($days-2);
                    $ontransit = ($perdiem_rate * (0.75)) * 2;
                    $accommodation = $accommodation * ($days);
                    $total_amount = $perdiem_total_amount + $ontransit + $inputs['transportation'] + $inputs['other_cost'] + $accommodation;

                }
                else{

                    $perdiem_rate = 75000;
                    $perdiem_total_amount = $perdiem_rate *($days-2);
                    $accommodation = $accommodation * ($days);
                    $ontransit = ($perdiem_rate * (0.75)) * 2;
                    $total_amount = $perdiem_total_amount + $ontransit + $inputs['transportation'] + $inputs['other_cost'] + $accommodation;

                }

        }

        return [
            'perdiem_total_amount'=> $perdiem_total_amount,
            'traveller_uid' => $inputs['traveller_uid'],
            'district_id'=> $inputs['district_id'],
            'no_days' => $days,
            'ontransit'=> $ontransit,
            'transportation' => $inputs['transportation'],
            'accommodation' => $accommodation,
            'other_cost' => $inputs['other_cost'],
            'from' => $from,
            'to' => $to,
            'total_amount' =>  $total_amount,

        ];



    }

    /**
     * @param Requisition $requisition
     * @param $inputs
     * @return mixed
     */
    public function store(Requisition $requisition, $inputs)
    {
        return DB::transaction(function () use ($requisition, $inputs){
            $requisition->travellingCost()->create($this->inputProcess($inputs));
            $requisition->updatingTotalAmount();
            return $requisition;
        });
    }
}
