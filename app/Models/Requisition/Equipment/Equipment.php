<?php

namespace App\Models\Requisition\Equipment;

use App\Models\BaseModel;
use App\Models\Requisition\Equipment\Traits\Attribute\EquipmentAttribute;
use App\Models\Requisition\Equipment\Traits\Relationship\EquipmentRelationship;

class Equipment extends BaseModel
{
    use EquipmentAttribute, EquipmentRelationship;
}
