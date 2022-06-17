<?php

namespace App\Models\HumanResource\PerformanceReview;

use App\Models\HumanResource\PerformanceReview\Traits\Attribute\PrAttributeRateAttribute;
use App\Models\HumanResource\PerformanceReview\Traits\Relationship\PrAttributeRateRelationship;
use App\Models\BaseModel;

class PrAttributeRate extends BaseModel
{
    use PrAttributeRateAttribute, PrAttributeRateRelationship;
}
