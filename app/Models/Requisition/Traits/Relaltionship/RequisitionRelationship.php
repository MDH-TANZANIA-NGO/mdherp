<?php

namespace App\Models\Requisition\Traits\Relaltionship;

use App\Models\Requisition\Item\RequisitionItem;
use App\Models\Requisition\RequisitionType\RequisitionType;

trait RequisitionRelationship
{
    public function type()
    {
        return $this->belongsTo(RequisitionType::class,'requisition_type_id','id');
    }

    public function items()
    {
        return $this->hasMany(RequisitionItem::class,'requisition_id','id')->orderBy('id');
    }

}
