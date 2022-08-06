<?php

namespace App\Repositories\Requisition\Training;

use App\Models\Requisition\Training\requisition_training;
use App\Models\Requisition\Training\requisition_training_cost;
use App\Models\Requisition\Training\Traits\Relationship\RequisitionTrainingRelationship;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class RequisitionTrainingRepository extends BaseRepository
{
    use RequisitionTrainingRelationship;
    const MODEL = requisition_training::class;
    public function __construct()
    {
        //
    }
    public function getQuery()
    {
        return $this->query()->select([
            DB::raw('requisition_trainings.id AS id'),
            DB::raw('requisition_trainings.start_date AS start_date'),
            DB::raw('requisition_trainings.end_date AS end_date'),
            DB::raw('requisition_trainings.district_id AS district_id'),
            DB::raw('requisition_trainings.no_days AS no_days'),
//            DB::raw('requisitions.id AS requisition_ID'),
            DB::raw('requisition_trainings.requisition_id AS requisition_id'),
//            DB::raw('program_activities.requisition_training_id AS requisition_training_id'),
            DB::raw('program_activities.id AS program_activity_id'),
            DB::raw('program_activities.number AS program_activity_number'),

        ])
            ->leftjoin('program_activities', 'program_activities.requisition_training_id','requisition_trainings.id');
    }

    public function getValidProgramActivity(){
        return $this->getRequisition()
            ->join('program_activities', 'program_activities.requisition_training_id','requisition_trainings.id')
            ->where('program_activities.wf_done', true);
    }
    public function getRequisition()
    {
        return $this->getQuery()
            ->join('requisitions', 'requisitions.id', 'requisition_trainings.requisition_id')
            ->join('districts', 'districts.id', 'requisition_trainings.district_id');
    }
    public function getByRequisitionId($requisition_id)
    {
        return $this->getQuery()
            ->where('requisition_trainings.requisition_id', $requisition_id);
    }
    public function getRequisitionFilter()
    {
        return $this->getRequisition()
            ->select([
                'requisitions.number',
                'requisitions.id AS requisition_id',
                'requisition_trainings.id',
                DB::raw("CONCAT_WS(' ', requisitions.number, districts.name, requisition_trainings.start_date, requisition_trainings.end_date ) AS training")
            ])

            ->where('requisitions.wf_done', 1)
            ->where('requisitions.is_closed', false)
            ->where('requisition_trainings.completed', false)
            ->where('requisitions.user_id', access()->id());
    }


    public function getPluckRequisitionNo()
    {
        return $this->getRequisitionFilter()->pluck('training','requisition_trainings.id');

    }
    public function getPluckRequisitionNoWithRequisitionId()
    {
        return $this->getRequisitionFilter()
//            ->join('program_activities', 'program_activities.requisition_training_id','requisition_trainings.id')
            ->whereHas('programActivity', function ($query){
                $query->where('program_activities.wf_done', 1);
            })
            ->where('requisition_trainings.completed', false)

            ->pluck('training','requisition_id');

    }
    public function inputProcess($input)
    {

        return [
            'start_date' => $input['from'],
            'end_date' => $input['to'],
            'requisition_id' => $input['requisition_id'],
            'district_id' => $input['district_id'],

        ];
    }



    public function update($uuid, $inputs){



        return DB::transaction(function () use ($uuid, $inputs){


            return $this->updatePerdiemAmount($inputs,$uuid);
        });
    }
    public function updatePerdiemAmount($inputs,$uuid)
    {
        $get_inputs = $this->inputProcess($inputs);
        $requisition_training = $this->findByUuid($uuid);
        $requisition_training_costs =  requisition_training_cost::query()->where('requisition_id', $requisition_training->requisition_id)->get();
        $no_days =  getNoDays($inputs['from'], $inputs['to']);

        foreach ($requisition_training_costs as $costs)
        {
            if ($no_days != $costs->no_days)
            {
                $perdiem_amount_rate = $costs->perdiem_total_amount/$costs->no_days;
                $new_perdiem_total_amount =  $perdiem_amount_rate*$no_days;
                $total_amount = ($costs->total_amount - $costs->perdiem_total_amount) + $new_perdiem_total_amount;
                requisition_training_cost::query()->where('id', $costs->id)->update(['perdiem_total_amount'=> $new_perdiem_total_amount, 'total_amount'=>$total_amount]);
            }
            else{
                requisition_training_cost::query()->where('id', $costs->id)->update(['no_days'=> $no_days]);

            }

        }

        return $requisition_training->update($this->inputProcess($inputs));


    }



}
