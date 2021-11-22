<?php

namespace App\Repositories\Requisition\RequisitionType;

use App\Models\Requisition\RequisitionType\RequisitionType;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class RequisitionTypeRepository extends BaseRepository
{
    const MODEL = RequisitionType::class;

    public function getQuery()
    {
        return $this->query()->select([
//            DB::raw('requisitions.')
        ])
            ->join('requisition_types', 'requisition_types.id','requisitions.id')
            ->join('requisition_items', 'requisition_items.id','requisitions.requisition_type_id')
            ->join('projects','projects.id', 'requisitions.project_id')
            ->join('activities','activities.id','requisitions.activity_id');
    }

    public function processingDatatable()
    {

    }
}
