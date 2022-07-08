<?php

namespace App\Models\HumanResource\PerformanceReview\Traits\Relationship;

use App\Models\HumanResource\PerformanceReview\PrReport;

trait PrEducationOpportunityRelationship
{
    public function report()
    {
        return $this->belongsTo(PrReport::class, 'pr_report_id', 'id');
    }
}