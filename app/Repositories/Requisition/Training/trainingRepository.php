<?php

namespace App\Repositories\Requisition\Training;

use App\Models\Requisition\Training\requisition_training;
use App\Models\Requisition\Training\requisition_training_cost;
use App\Models\Requisition\Training\requisition_training_item;
use App\Models\Requisition\Training\training;
use App\Models\Requisition\Training\training_cost;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class trainingRepository extends BaseRepository
{
//    const MODEL = training_cost::class;
        const MODEL = requisition_training::class;
    public function __construct()
    {
        //
    }

    public function training()
    {

        return $this->query()->select([
            DB::raw('requisition_trainings.id AS id'),
            DB::raw('requisition_trainings.requisition_id AS requisition_id'),
            DB::raw('requisition_trainings.district_id AS district_id'),
            DB::raw('requisition_trainings.from AS from'),
            DB::raw('requisition_trainings.to AS to'),
            DB::raw('requisitions.id AS requisition_ID'),




        ])->join('requisitions','requisitions.id','requisition_trainings.requisition_id');
    }

    public function inputsProcessor($inputs)
    {
        return [
            'no_days' => $inputs['no_days'],
            'perdiem_rate_id' => $inputs['perdiem_rate_id'],
            'district_id' => $inputs['district_id'],
            'transportation' => $inputs['transportation'],
            'other_cost' => $inputs['other_cost'],
        ];
    }

    public function update($uuid, $inputs)
    {
        $training_costs = $this->findByUuid($uuid);
        return DB::transaction(function () use($training_costs, $inputs){
            return $training_costs->update($this->inputsProcessor($inputs));
        });
    }
}
