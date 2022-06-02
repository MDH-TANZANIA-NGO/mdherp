<?php

namespace App\Models\HumanResource\PerformanceReview;

use App\Models\BaseModel;
use App\Models\HumanResource\PerformanceReview\Traits\Attribute\PrObjectiveAttribute;
use App\Models\HumanResource\PerformanceReview\Traits\Relationship\PrObjectRelationship;

class PrObjective extends BaseModel
{
    use PrObjectiveAttribute, PrObjectRelationship;
}
