<?php

namespace App\Models\Requisition\Item;

use App\Models\Requisition\Item\Traits\Attribute\RequisitionItemDistrictAttribute;
use App\Models\Requisition\Item\Traits\Relationship\RequisitionItemDistrictRelationship;
use Illuminate\Database\Eloquent\Model;

class RequisitionItemDistrict extends Model
{
    use RequisitionItemDistrictAttribute, RequisitionItemDistrictRelationship;
}
