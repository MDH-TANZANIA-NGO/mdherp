<?php

namespace App\Repositories\Requisition\Training;

use App\Models\Requisition\Training\requisition_training_cost;
use App\Models\Requisition\Training\training_cost;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class trainingRepository extends BaseRepository
{
//    const MODEL = training_cost::class;
        const MODEL = requisition_training_cost::class;
    public function __construct()
    {
        //
    }

    public function training()
    {

        return $this->query()->select([
            DB::raw('requisition_training_costs.no_days AS no_days'),
            DB::raw('requisition_training_costs.transportation AS transportation'),
            DB::raw('requisition_training_costs.perdiem_rate_id AS perdiem_rate_id'),
            DB::raw('requisition_training_costs.perdiem_rate_total_amount AS perdiem_rate_total_amount'),
            DB::raw('requisition_training_costs.other_cost AS other_cost'),
            DB::raw('requisition_training_costs.total_amount AS total_amount'),
            DB::raw('requisition_training_costs.district_id AS district_id'),
            DB::raw('requisition_training_costs.participant_uid AS participant_uid'),
            DB::raw('g_officers.id AS userID'),
            DB::raw('g_officers.first_name AS first_name'),
            DB::raw('g_officers.last_name AS last_name'),
            DB::raw('MAX(requisition_training_costs.requisition_id) AS recent_requisition_id'),



        ])->leftjoin('g_officers','g_officers.id','requisition_training_costs.participant_uid')
            ->groupBy(['requisition_training_costs.no_days',
                        'requisition_training_costs.transportation',
                        'requisition_training_costs.perdiem_rate_total_amount',
                        'requisition_training_costs.other_cost',
                        'requisition_training_costs.total_amount',
                        'requisition_training_costs.district_id',
                        'requisition_training_costs.participant_uid',
                        'g_officers.id',
                        'g_officers.first_name',
                        'g_officers.last_name'
                ]);
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
