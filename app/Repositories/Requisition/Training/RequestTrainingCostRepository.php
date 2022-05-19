<?php

namespace App\Repositories\Requisition\Training;

use App\Models\GOfficer\GRate;
use App\Models\Requisition\Requisition;
use App\Models\Requisition\Training\requisition_training;
use App\Models\Requisition\Training\requisition_training_cost;
use App\Models\Requisition\Training\Traits\Relationship\RequisitionTrainingCostRelationship;
use App\Models\Requisition\Training\Traits\Relationship\RequisitionTrainingRelationship;
use App\Models\Requisition\Travelling\Traits\Relationship\RequisitionTravellingCostRelationship;
use App\Repositories\BaseRepository;
use App\Repositories\GOfficer\GRateRepository;
use Illuminate\Support\Facades\DB;

class RequestTrainingCostRepository extends BaseRepository
{
    use RequisitionTrainingCostRelationship;
    const MODEL = requisition_training_cost::class;

    public function getQuery()
    {
        return $this->query()->select([
            DB::raw('requisition_training_costs.id AS id'),
            DB::raw('requisition_training_costs.perdiem_total_amount AS perdiem_total_amount'),
            DB::raw('requisition_training_costs.transportation AS transportation'),
            DB::raw('requisition_training_costs.total_amount AS total_amount'),
            DB::raw('requisition_training_costs.other_cost AS other_cost'),
            DB::raw('requisition_training_costs.requisition_id AS requisition_id'),
            DB::raw('requisition_training_costs.participant_uid AS participant_uid'),
            DB::raw('requisition_trainings.id AS training_id'),
            DB::raw('program_activities.id AS activity_id'),
            DB::raw('program_activities.uuid AS activity_uuid')
        ])
            ->join('requisition_trainings', 'requisition_trainings.id', 'requisition_training_costs.requisition_training_id')
            ->join('program_activities', 'program_activities.requisition_training_id', 'requisition_trainings.id');
    }

    public function getActivityParticipants($uuid)
    {
        return $this->getQuery()
            ->whereHas('training')
            ->where('program_activities.uuid', $uuid);
    }



    public function inputProcess($inputs)
    {
        $requisition_training_details =  requisition_training::query()->where('id', $inputs['requisition_training_id'])->first();
        $days = getNoDays($requisition_training_details->start_date, $requisition_training_details->end_date);

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
            'others_description' => $inputs['others_description'],
            'total_amount' => $total_amount,
        ];
    }

    public function store(Requisition $requisition, $inputs)
    {
        return DB::transaction(function () use ($requisition, $inputs){
            check_available_budget_individual($requisition, $this->inputProcess($inputs)['total_amount'],0,$this->inputProcess($inputs)['total_amount']);
            $requisition->trainingCost()->create($this->inputProcess($inputs));
            $requisition->updatingTotalAmount();
            return $requisition;
        });
    }
}
