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

    public function inputProcess($inputs)
    {

    $perdiem_id = $inputs['perdiem_rate_id'];
        $perdiem_total_amount = (mdh_rate::query()->find($perdiem_id)->amount  * $inputs['no_days']);
        $total_amount = $perdiem_total_amount + $inputs['transportation'] + $inputs['other_cost'] + ($inputs['accommodation'] * $inputs['no_days']);
        return [
            'perdiem_total_amount'=> $perdiem_total_amount,
            'traveller_uid' => $inputs['traveller_uid'],
            'description' => $inputs['description'],
            'district_id'=> $inputs['district_id'],
            'no_days' => $inputs['no_days'],
            'perdiem_rate_id' => $inputs['perdiem_rate_id'],
            'transportation' => $inputs['transportation'],
            'accommodation' => $inputs['accommodation'],
            'other_cost' => $inputs['other_cost'],
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
            return $requisition->travellingCost()->create($this->inputProcess($inputs));
        });
    }
}
