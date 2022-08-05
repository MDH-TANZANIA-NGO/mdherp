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
            DB::raw('requisition_training_costs.requisition_training_id AS requisition_training_id'),
            DB::raw('requisition_training_costs.perdiem_total_amount AS perdiem_total_amount'),
            DB::raw('requisition_training_costs.transportation AS transportation'),
            DB::raw('requisition_training_costs.total_amount AS total_amount'),
            DB::raw('requisition_training_costs.other_cost AS other_cost'),
            DB::raw('requisition_training_costs.requisition_id AS requisition_id'),
            DB::raw('requisition_training_costs.perdiem_rate_id AS perdiem_rate_id'),
            DB::raw('requisition_training_costs.participant_uid AS participant_uid'),
            DB::raw('requisition_trainings.id AS training_id'),
            DB::raw('program_activities.id AS activity_id'),
            DB::raw('program_activities.uuid AS activity_uuid')
        ])
            ->join('requisition_trainings', 'requisition_trainings.id', 'requisition_training_costs.requisition_training_id')
            ->leftjoin('program_activities', 'program_activities.requisition_training_id', 'requisition_trainings.id');
    }
public function getParticipantsByRequisition($requisition_id)
{

    return $this->getQuery()
        ->where('requisition_training_costs.requisition_id', $requisition_id);
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
//        dd($days);
        if ( isset($inputs['perdiem_rate_id']) ){
            $perdiem_rate_amount = GRate::query()->find($inputs['perdiem_rate_id'])->amount;

            $perdiem_rate_id  = $inputs['perdiem_rate_id'];
        }
        else{
            $perdiem_rate_amount = 0;
            $perdiem_rate_id = 0;
        }

        $perdiem_total_amount = ($perdiem_rate_amount  * $days);
        $total_amount = $perdiem_total_amount + $inputs['transportation'] + $inputs['other_cost'];
        return [
            'requisition_training_id'=>$inputs['requisition_training_id'],
            'peridem_rate_amount'=> $perdiem_rate_amount,
            'participant_uid' => $inputs['participant_uid'],
            'perdiem_total_amount' => $perdiem_total_amount,
            'no_days' => $days,
            'perdiem_rate_id' => $perdiem_rate_id,
            'transportation' => $inputs['transportation'],
            'other_cost' => $inputs['other_cost'],
            'others_description' => $inputs['others_description'],
            'total_amount' => $total_amount,
        ];
    }

    public function store(Requisition $requisition, $inputs)
    {
        return DB::transaction(function () use ($requisition, $inputs){
//            check_available_budget_individual($requisition, $this->inputProcess($inputs)['total_amount'],0,$this->inputProcess($inputs)['total_amount']);
            $requisition->trainingCost()->create($this->inputProcess($inputs));
            $requisition->updatingTotalAmount();
            return $requisition;
        });
    }
    public function getActivityCostWithParticipants()
    {
        return $this->query()->select([
            DB::raw('requisition_training_costs.id AS id'),
            DB::raw('requisition_training_costs.requisition_training_id AS requisition_training_id'),
            DB::raw('requisition_training_costs.perdiem_total_amount AS perdiem_total_amount'),
            DB::raw('requisition_training_costs.transportation AS transportation'),
            DB::raw('requisition_training_costs.total_amount AS total_amount'),
            DB::raw('requisition_training_costs.other_cost AS other_cost'),
            DB::raw('requisition_training_costs.amount_paid AS amount_paid'),
            DB::raw('requisition_training_costs.requisition_id AS requisition_id'),
            DB::raw('requisition_training_costs.participant_uid AS participant_uid'),
            DB::raw('requisition_training_costs.participant_uid AS participant_uid'),
            DB::raw('g_officers.phone AS phone'),
            DB::raw("CONCAT_WS(', ',g_officers.last_name, g_officers.first_name) AS full_name"),
        ])
            ->join('requisitions', 'requisitions.id','requisition_training_costs.requisition_id')
            ->join('g_officers', 'g_officers.id','requisition_training_costs.participant_uid');
    }
    public function getActivityCostWithParticipantsByRequisitionId($requisition_id)
    {
        return $this->getActivityCostWithParticipants()
            ->where('requisition_training_costs.requisition_id', $requisition_id);
    }
}
