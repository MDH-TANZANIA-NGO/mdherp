<?php

namespace App\Models\HumanResource\PerformanceReview\Traits\Relationship;

use App\Models\Auth\User;

trait PrRecommendationRelationship
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}