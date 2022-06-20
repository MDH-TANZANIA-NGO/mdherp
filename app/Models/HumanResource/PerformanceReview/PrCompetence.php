<?php

namespace App\Models\HumanResource\PerformanceReview;

use App\Models\HumanResource\PerformanceReview\Traits\Attribute\PrCompetenceAttribute;
use App\Models\HumanResource\PerformanceReview\Traits\Relationship\PrCompetenceRelationship;
use App\Models\BaseModel;

class PrCompetence extends BaseModel
{
    use PrCompetenceAttribute, PrCompetenceRelationship;
}
