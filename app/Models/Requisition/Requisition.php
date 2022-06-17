<?php

namespace App\Models\Requisition;

use App\Models\BaseModel;
use App\Models\Requisition\Traits\Attribute\RequisitionAttribute;
use App\Models\Requisition\Traits\Relaltionship\RequisitionRelationship;

class Requisition extends BaseModel
{
    use RequisitionAttribute, RequisitionRelationship;
}
