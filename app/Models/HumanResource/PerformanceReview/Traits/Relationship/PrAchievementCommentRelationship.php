<?php

namespace App\Models\HumanResource\PerformanceReview\Traits\Relationship;

use App\Models\Auth\User;

trait PrAchievementCommentRelationship
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}