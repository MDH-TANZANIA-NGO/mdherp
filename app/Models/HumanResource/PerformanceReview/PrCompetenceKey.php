<?php

namespace App\Models\HumanResource\PerformanceReview;

use App\Models\HumanResource\PerformanceReview\Traits\Attribute\PrCompetenceKeyAttribute;
use App\Models\HumanResource\PerformanceReview\Traits\Relationship\PrCompetenceKeyRelationship;
use Illuminate\Database\Eloquent\Model;

class PrCompetenceKey extends Model
{
    use PrCompetenceKeyAttribute, PrCompetenceKeyRelationship;
}
