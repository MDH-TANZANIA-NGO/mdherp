<?php

namespace App\Models\HumanResource\PerformanceReview;

use App\Models\HumanResource\PerformanceReview\Traits\Attribute\PrCompetenceKeyNarrationAttribute;
use App\Models\HumanResource\PerformanceReview\Traits\Relationship\PrCompetenceKeyNarrationRelationship;
use Illuminate\Database\Eloquent\Model;

class PrCompetenceKeyNarration extends Model
{
    use PrCompetenceKeyNarrationAttribute, PrCompetenceKeyNarrationRelationship;
}
