<?php

namespace App\Models\HumanResource\PerformanceReview\Traits\Relationship;

use App\Models\HumanResource\PerformanceReview\PrRateScale;

trait PrObjectiveRelationship
{
    public function rate()
    {
        return $this->belongsTo(PrRateScale::class,'pr_rate_scale_id', 'id');
    }
}
