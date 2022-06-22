<?php

namespace App\Models\HumanResource\PerformanceReview\Traits\Relationship;

use App\Models\HumanResource\PerformanceReview\PrReport;

trait PrNextObjectiveRelationship
{
    public function prReport()
    {
        return $this->belongsTo(PrReport::class);
    }
}