<?php

namespace App\Models\HumanResource\PerformanceReview;

use App\Models\BaseModel;
use App\Models\HumanResource\PerformanceReview\Traits\Attribute\PrSkillAttribute;
use App\Models\HumanResource\PerformanceReview\Traits\Relationship\PrSkillRelationship;

class PrSkill extends BaseModel
{
    use PrSkillAttribute, PrSkillRelationship;
    
}
