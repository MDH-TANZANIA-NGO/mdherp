<?php

namespace App\Models\HumanResource\PerformanceReview;

use App\Models\BaseModel;
use App\Models\HumanResource\PerformanceReview\Traits\Attribute\PrNextObjectiveAttribute;
use App\Models\HumanResource\PerformanceReview\Traits\Relationship\PrNextObjectiveRelationship;
use Illuminate\Database\Eloquent\Model;

class PrNextObjective extends BaseModel
{
    use PrNextObjectiveAttribute, PrNextObjectiveRelationship;
}
