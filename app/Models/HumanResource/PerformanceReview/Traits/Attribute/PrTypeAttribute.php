<?php

namespace App\Models\HumanResource\PerformanceReview\Traits\Attribute;

trait PrTypeAttribute
{
    public function getTitleAttribute()
    {
        return strtoupper($this->attributes['title']);
    }
}
