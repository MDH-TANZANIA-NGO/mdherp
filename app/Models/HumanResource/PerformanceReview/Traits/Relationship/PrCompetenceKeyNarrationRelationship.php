<?php

namespace App\Models\HumanResource\PerformanceReview\Traits\Relationship;

use App\Models\HumanResource\PerformanceReview\PrCompetenceKey;

trait PrCompetenceKeyNarrationRelationship
{
    public function key()
    {
        return $this->belongsTo(PrCompetenceKey::class,'pr_competence_key_id', 'id');
    }
}
