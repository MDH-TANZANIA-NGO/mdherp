<?php

namespace App\Models\Requisition\Item;

use App\Models\BaseModel;
use App\Models\Requisition\Item\Traits\Attribute\RequisitionItemAttribute;
use App\Models\Requisition\Item\Traits\Relationship\RequisitionItemRelationship;

class RequisitionItem extends BaseModel
{
    use RequisitionItemAttribute, RequisitionItemRelationship;
}
