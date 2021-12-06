<?php

namespace App\Repositories\Requisition\Travelling;

use App\Models\MdhRates\mdh_rate;
use App\Models\Requisition\Requisition;
use App\Models\Requisition\Travelling\requisition_travelling_cost;
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

        $from = $inputs['from'];
        $to = $inputs['to'];
        $datetime1 = new \DateTime($from);
        $datetime2 = new  \DateTime($to);
        $interval = $datetime1->diff($datetime2);
        $days = $interval->format('%a');

    $perdiem_id = $inputs['perdiem_rate_id'];
        $perdiem_total_amount = (mdh_rate::query()->find($perdiem_id)->amount  * $days);
        $total_amount = $perdiem_total_amount + $inputs['transportation'] + $inputs['other_cost'] + ($inputs['accommodation'] * $days);
        return [
            'perdiem_total_amount'=> $perdiem_total_amount,
            'traveller_uid' => $inputs['traveller_uid'],
//            'description' => $inputs['description'],
            'district_id'=> $inputs['district_id'],
            'no_days' => $days,
            'perdiem_rate_id' => $inputs['perdiem_rate_id'],
            'transportation' => $inputs['transportation'],
            'accommodation' => $inputs['accommodation'],
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
