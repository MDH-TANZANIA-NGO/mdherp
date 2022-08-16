<?php

namespace App\Models\HumanResource\PerformanceReview;

use App\Models\BaseModel;
use App\Models\HumanResource\PerformanceReview\Traits\Attribute\PrRemarkAttribute;
use App\Models\HumanResource\PerformanceReview\Traits\Relationship\PrRemarkRelationship;

class PrRemark extends BaseModel
{
    use PrRemarkAttribute, PrRemarkRelationship;
}
