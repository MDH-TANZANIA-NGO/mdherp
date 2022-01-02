<?php

namespace App\Models\Requisition\Training;

use App\Models\BaseModel;
use App\Models\Requisition\Training\Traits\Relationship\RequisitionTrainingRelationship;
use Faker\Provider\Base;
use Illuminate\Database\Eloquent\Model;

class requisition_training extends BaseModel
{
    //
    use RequisitionTrainingRelationship;
}
