<?php

namespace App\Models\HumanResource\PerformanceReview\Traits\Relationship;

use App\Models\HumanResource\PerformanceReview\PrCompetenceKeyNarration;
use App\Models\HumanResource\PerformanceReview\PrRateScale;

trait PrCompetenceRelationship
{
    public function narration()
    {
        return $this->belongsTo(PrCompetenceKeyNarration::class,'pr_competence_key_narration_id','id');
    }

    public function rate()
    {
        return $this->belongsTo(PrRateScale::class,'pr_rate_scale_id', 'id');
    }
}
