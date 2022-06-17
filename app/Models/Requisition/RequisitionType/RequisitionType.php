<?php

namespace App\Models\Requisition\RequisitionType;

use App\Models\Requisition\RequisitionType\Traits\Attribute\RequisitionTypeAttribute;
use App\Models\Requisition\RequisitionType\Traits\Relaltionship\RequisitionTypeRelationship;
use Illuminate\Database\Eloquent\Model;

class RequisitionType extends Model
{
    use RequisitionTypeAttribute, RequisitionTypeRelationship;
}
