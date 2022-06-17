<?php

namespace App\Models\HumanResource\PerformanceReview;

use App\Models\HumanResource\PerformanceReview\Traits\Attribute\PrRateScaleAttribute;
use App\Models\HumanResource\PerformanceReview\Traits\Relationship\PrRateScaleRelationship;
use Illuminate\Database\Eloquent\Model;

class PrRateScale extends Model
{
    use PrRateScaleAttribute, PrRateScaleRelationship;
}
