<?php

namespace App\Repositories\Requisition\Training;

use App\Models\GOfficer\GRate;
use App\Models\Requisition\Requisition;
use App\Models\Requisition\Training\requisition_training_cost;
use App\Repositories\GOfficer\GRateRepository;
use Illuminate\Support\Facades\DB;

class RequestTrainingCostRepository
{
    const MODEL = requisition_training_cost::class;



    public function inputProcess($inputs)
    {

        $from = $inputs['from'];
        $to = $inputs['to'];
        $datetime1 = new \DateTime($from);
        $datetime2 = new  \DateTime($to);
        $interval = $datetime1->diff($datetime2);
        $days = $interval->format('%a');

        $perdiem_id = $inputs['perdiem_rate_id'];
        $perdiem_total_amount = (GRate::query()->find($perdiem_id)->amount  * $days);
        $total_amount = $perdiem_total_amount + $inputs['transportation'] + $inputs['other_cost'];
        return [
            'requisition_training_id'=>$inputs['requisition_training_id'],
            'peridem_rate_amount'=> $inputs['perdiem_rate_id'],
            'participant_uid' => $inputs['participant_uid'],
//            'description' => $inputs['description'],
//            'district_id'=> $inputs['district_id'],
        'perdiem_total_amount' => $perdiem_total_amount,
            'no_days' => $days,
            'perdiem_rate_id' => $inputs['perdiem_rate_id'],
            'transportation' => $inputs['transportation'],
            'other_cost' => $inputs['other_cost'],
            'perdiem_rate_id_total_amount' =>$perdiem_total_amount,
            'total_amount' => $total_amount,
        ];
    }

    public function store(Requisition $requisition, $inputs)
    {
        return DB::transaction(function () use ($requisition, $inputs){
            $requisition->trainingCost()->create($this->inputProcess($inputs));
            $requisition->updatingTotalAmount();
            return $requisition;
        });
    }
}
