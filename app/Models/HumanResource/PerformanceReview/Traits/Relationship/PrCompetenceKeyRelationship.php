<?php

namespace App\Models\HumanResource\PerformanceReview\Traits\Relationship;

use App\Models\HumanResource\PerformanceReview\PrCompetenceKeyNarration;

trait PrCompetenceKeyRelationship
{
    public function narrations()
    {
        return $this->hasMany(PrCompetenceKeyNarration::class,'pr_competence_key_id', 'id')->orderBy('id');
    }
}
