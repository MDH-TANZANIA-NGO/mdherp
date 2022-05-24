<?php

namespace App\Models\HumanResource\PerformanceReview;

use App\Models\HumanResource\PerformanceReview\Traits\Attribute\PrObjectiveAttribute;
use App\Models\HumanResource\PerformanceReview\Traits\Relationship\PrObjectiveRelationship;
use App\Models\BaseModel;

class PrObjective extends BaseModel
{
    use PrObjectiveAttribute, PrObjectiveRelationship;
}
