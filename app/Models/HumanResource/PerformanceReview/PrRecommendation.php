<?php

namespace App\Models\HumanResource\PerformanceReview;

use App\Models\BaseModel;
use App\Models\HumanResource\PerformanceReview\Traits\Attribute\PrRecommendationAttribute;
use App\Models\HumanResource\PerformanceReview\Traits\Relationship\PrRecommendationRelationship;

class PrRecommendation extends BaseModel
{
    use PrRecommendationAttribute, PrRecommendationRelationship;
}
