<?php

namespace App\Models\Retirement;

use App\Models\BaseModel;
use App\Models\Retirement\Traits\Attribute\RetirementAttribute;
//use App\Models\Retirement\Traits\RetirementAttribute;
use App\Models\Retirement\Traits\Relationship\RetirementRelationship;
use Illuminate\Database\Eloquent\Model;

class Retirement extends BaseModel
{
    use RetirementAttribute, RetirementRelationship;
}
