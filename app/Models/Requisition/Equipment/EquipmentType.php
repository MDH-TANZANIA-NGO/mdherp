<?php

namespace App\Models\Requisition\Equipment;

use App\Models\BaseModel;
use App\Models\Requisition\Equipment\Traits\Attribute\EquipmentTypeAttribute;
use App\Models\Requisition\Equipment\Traits\Relationship\EquipmentTypeRelationship;

class EquipmentType extends BaseModel
{
    use EquipmentTypeAttribute, EquipmentTypeRelationship;
}
