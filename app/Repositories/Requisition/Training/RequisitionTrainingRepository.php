<?php

namespace App\Repositories\Requisition\Training;

use App\Models\Requisition\Training\requisition_training;
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
            DB::raw('requisitions.id AS requisition_ID'),
            DB::raw('requisition_trainings.requisition_id AS requisition_id'),
//            DB::raw('program_activities.requisition_training_id AS requisition_training_id'),
            DB::raw('program_activities.id AS program_activity_id'),
            DB::raw('program_activities.number AS program_activity_number'),

        ]);
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
    public function getRequisitionFilter()
    {
        return $this->getRequisition()
            ->select([
                'requisitions.number',
                'requisition_trainings.id',
                DB::raw("CONCAT_WS(' ', requisitions.number, districts.name, requisition_trainings.start_date, requisition_trainings.end_date ) AS training")
            ])
            ->where('requisitions.wf_done', 1)
            ->where('requisitions.user_id', access()->id())
            ->whereDoesntHave('programActivity');
    }
    public function getPluckRequisitionNo()
    {
        return $this->getRequisitionFilter()->pluck('training','requisition_trainings.id');

    }
    public function inputProcess($input)
    {

        return [
            'from' => $input['from'],
            'to' => $input['to'],
            'requisition_id' => $input['requisition_id'],
            'district_id' => $input['district_id'],

        ];
    }

    public function update($uuid, $inputs){
        return DB::transaction(function () use ($uuid, $inputs){

            return $this->query()->update($this->inputProcess($uuid,$inputs));
        });
    }



}
