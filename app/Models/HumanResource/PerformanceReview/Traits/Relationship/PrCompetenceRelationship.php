<?php

namespace App\Models\HumanResource\PerformanceReview\Traits\Relationship;

use App\Models\HumanResource\PerformanceReview\PrCompetenceKeyNarration;

trait PrCompetenceRelationship
{
    public function narration()
    {
        return $this->belongsTo(PrCompetenceKeyNarration::class,'pr_competence_key_nation_id','id');
    }
}
