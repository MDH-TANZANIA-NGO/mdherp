<?php

namespace App\Models\HumanResource\PerformanceReview;

use App\Models\BaseModel;
use App\Models\HumanResource\PerformanceReview\Traits\Attribute\PrEducationOpportunityAttribute;
use App\Models\HumanResource\PerformanceReview\Traits\Relationship\PrEducationOpportunityRelationship;

class PrEducationOpportunity extends BaseModel
{
    use PrEducationOpportunityAttribute, PrEducationOpportunityRelationship;
    
}
