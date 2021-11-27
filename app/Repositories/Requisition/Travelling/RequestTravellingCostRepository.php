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
    $perdiem_amount = $perdiem_id->mdh_rates;
        return [
            'perdiem_total_amount'=> $perdiem_amount,
            'traveller_uid' => $inputs['traveller_uid'],
            'description' => $inputs['description'],
            'district_id'=> $inputs['district_id'],
            'no_days' => $inputs['no_days'],
            'perdiem_rate_id' => $inputs['perdiem_rate_id'],
            'transportation' => $inputs['transportation'],
            'accommodation' => $inputs['accommodation'],
            'other_cost' => $inputs['other_cost'],
//            'perdiem_rate_id_total_amount' =>$inputs['no_days'] *  $inputs['perdiem_rate_id'],
            'total_amount' =>  $inputs['transportation'] + $inputs['other_cost']
        ];
    }

    public function store(Requisition $requisition, $inputs)
    {
        return DB::transaction(function () use ($requisition, $inputs){
            $travellingItemCost = $requisition->travellingCost()->create($this->inputProcess($inputs));
//            $travellingItemCost->districts()->sync($inputs['districts']);
        });
    }
}
