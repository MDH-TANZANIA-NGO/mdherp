<?php

namespace App\Models\HumanResource\PerformanceReview\Traits\Relationship;

use App\Models\HumanResource\PerformanceReview\PrAttribute;
use App\Models\HumanResource\PerformanceReview\PrRateScale;

trait PrAttributeRateRelationship
{
    public function rate()
    {
        return $this->belongsTo(PrRateScale::class,'pr_rate_scale_id','id');
    }

    public function attribute()
    {
        return $this->belongsTo(PrAttribute::class,'pr_attribute_id');
    }

}
