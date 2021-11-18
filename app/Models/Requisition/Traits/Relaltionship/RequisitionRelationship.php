<?php

namespace App\Models\Requisition\Traits\Relaltionship;

use App\Models\Requisition\RequisitionType\RequisitionType;

trait RequisitionRelationship
{
    public function type()
    {
        return $this->belongsTo(RequisitionType::class,'requisition_type_id','id');
    }
}
