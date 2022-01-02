<?php

namespace App\Repositories\Requisition\Training;

use App\Models\Requisition\Training\requisition_training;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class RequisitionTrainingRepository extends BaseRepository
{
    const MODEL = requisition_training::class;
    public function __construct()
    {
        //
    }
    public function getQuery()
    {
        return $this->query()->select([
            DB::raw('requisition_trainings.id AS id'),
            DB::raw('requisition_trainings.from AS from'),
            DB::raw('requisition_trainings.to AS to'),
            DB::raw('requisition_trainings.district_id AS district_id'),
            DB::raw('requisition.id AS requisition_ID'),
            DB::raw('requisition_trainings.requisition_id AS requisition_id')
        ]);
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
                DB::raw("CONCAT_WS(' ', requisitions.number, districts.name, requisition_trainings.from, requisition_trainings.to ) AS training")
            ])
            ->where('requisitions.wf_done', 1)
            ->where('requisitions.user_id', access()->id())
            ->whereDoesntHave('programActivity');
    }
    public function getPluckRequisitionNo()
    {
        return $this->getRequisitionFilter()->pluck('training','requisition_trainings.id');

    }



}
