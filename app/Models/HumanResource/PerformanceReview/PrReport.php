<?php

namespace App\Models\HumanResource\PerformanceReview;

use App\Models\HumanResource\PerformanceReview\Traits\Attribute\PrReportAttribute;
use App\Models\HumanResource\PerformanceReview\Traits\Relationship\PrReportRelationship;
use App\Models\BaseModel;

class PrReport extends BaseModel
{
    use PrReportAttribute,PrReportRelationship;
}
