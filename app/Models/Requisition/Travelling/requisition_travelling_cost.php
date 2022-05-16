<?php

namespace App\Models\Requisition\Travelling;

use App\Models\BaseModel;
use App\Models\Requisition\Travelling\Traits\Relationship\RequisitionTravellingCostRelationship;
use Illuminate\Database\Eloquent\Model;

class requisition_travelling_cost extends BaseModel
{
    use RequisitionTravellingCostRelationship;


}
