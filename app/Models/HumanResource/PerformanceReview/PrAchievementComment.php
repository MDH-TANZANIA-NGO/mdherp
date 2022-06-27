<?php

namespace App\Models\HumanResource\PerformanceReview;

use App\Models\BaseModel;
use App\Models\HumanResource\PerformanceReview\Traits\Attribute\PrAchievementCommentAttribute;
use App\Models\HumanResource\PerformanceReview\Traits\Relationship\PrAchievementCommentRelationship;

class PrAchievementComment extends BaseModel
{
    use PrAchievementCommentAttribute, PrAchievementCommentRelationship;
}
