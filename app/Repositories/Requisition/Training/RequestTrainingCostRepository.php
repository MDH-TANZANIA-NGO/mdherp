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
            DB::raw('requisition_training_costs.others_description AS others_description'),
            DB::raw('requisition_training_costs.requisition_id AS requisition_id'),
            DB::raw('requisition_training_costs.perdiem_rate_id AS perdiem_rate_id'),
            DB::raw('requisition_training_costs.participant_uid AS participant_uid'),
            DB::raw('requisition_training_costs.remarks AS remarks'),
            DB::raw('requisition_training_costs.amount_paid AS amount_paid'),
            DB::raw('requisition_training_costs.is_substitute AS is_substitute'),
            DB::raw('requisition_training_costs.account_no AS account_no'),
            DB::raw('requisition_training_costs.uuid AS uuid'),
            DB::raw('requisition_trainings.id AS training_id'),
            DB::raw('program_activities.id AS activity_id'),
            DB::raw('program_activities.uuid AS activity_uuid')
        ])
            ->join('requisition_trainings', 'requisition_trainings.id', 'requisition_training_costs.requisition_training_id')
            ->leftjoin('program_activities', 'program_activities.requisition_training_id', 'requisition_trainings.id');
    }

    public function payWithSwap($uuid, $inputs)
    {
        return DB::transaction(function () use ($uuid, $inputs){
            if ($inputs['substitute_participant'] ==  null)
            {
                $this->findByUuid($uuid)->update([
                    'amount_paid'=>$inputs['amount_paid'],
                    'account_no'=>$inputs['account_no'],
                    'remarks'=>$inputs['remarks']
                ]);
            }
            else{
                $this->findByUuid($uuid)->update([
                    'amount_paid'=>$inputs['amount_paid'],
                    'account_no'=>$inputs['account_no'],
                    'remarks'=>$inputs['remarks'],
                    'is_substitute'=> true,
                    'substituted_user_id'=>$inputs['current_participant'],
                    'participant_uid'=>$inputs['substitute_participant']
                ]);
            }
        });
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

    public function insertBulkFromFavourites($training_costs, $current_requisition)
    {

       foreach ($training_costs as $cost)
       {
           $this->query()->create([
               'requisition_id'=>$current_requisition->requisition_id,
               'participant_uid'=>$cost->participant_uid,
               'perdiem_rate_id'=>$cost->perdiem_rate_id,
               'no_days'=>$current_requisition->no_days,
               'perdiem_total_amount'=>$cost->perdiem_total_amount,
               'transportation'=> $cost->transportation,
               'other_cost'=>$cost->other_cost,
               'total_amount'=>$cost->total_amount,
               'others_description'=>$cost->others_description,
               'requisition_training_id'=>$current_requisition->id
           ]);
       }
       $requisition =  Requisition::query()->find($current_requisition->requisition_id);
        $requisition->updatingTotalAmount();
       return redirect()->back();
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
    public function update($training_cost, $inputs)
    {

        return DB::transaction(function () use ($training_cost, $inputs){
            $this->findByUuid($inputs['uuid'])->update($this->inputProcess($inputs));
            $requisition =  Requisition::query()->find($this->findByUuid($inputs['uuid'])->requisition_id);
            $requisition->updatingTotalAmount();
        });
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
