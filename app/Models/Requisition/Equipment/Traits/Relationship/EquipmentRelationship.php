<?php

namespace App\Models\Requisition\Equipment\Traits\Relationship;

use App\Models\Requisition\Equipment\EquipmentType;

trait EquipmentRelationship
{

    public function type()
    {
        return $this->belongsTo(EquipmentType::class,'equipment_type_id','id');
    }
}
