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

    protected $grate;

    public function __construct()
    {
        $this->grate = (new GRateRepository());
    }

    public function inputProcess($inputs)
    {

        return [
            'peridem_rate_amount'=> $inputs['perdiem_rate_id'],
            'participant_uid' => $inputs['participant_id'],
            'description' => $inputs['description'],
            'district_id'=> $inputs['district_id'],
            'no_days' => $inputs['no_days'],
            'perdiem_rate_id' => $inputs['perdiem_rate_id'],
            'transportation' => $inputs['transportation'],
            'other_cost' => $inputs['other_cost'],
            'perdiem_rate_id_total_amount' =>$inputs['no_days'] *  $inputs['perdiem_rate_id'],
            'total_amount' => $inputs['no_days'] * $inputs['perdiem_rate_id'] + $inputs['transportation'] + $inputs['other_cost']
        ];
    }

    public function store(Requisition $requisition, $inputs)
    {
        return DB::transaction(function () use ($requisition, $inputs){
            $trainingCost = $requisition->trainingCost()->create($this->inputProcess($inputs));

        });
    }
}
