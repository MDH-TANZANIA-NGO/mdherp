<?php

namespace App\Models\Requisition\Training;

use App\Models\BaseModel;
use App\Models\Requisition\Training\Traits\Relationship\RequisitionTrainingCostRelationship;
use Illuminate\Database\Eloquent\Model;

class requisition_training_cost extends BaseModel
{
    use RequisitionTrainingCostRelationship;
}
