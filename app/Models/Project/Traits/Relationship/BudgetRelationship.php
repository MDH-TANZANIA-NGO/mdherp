<?php

namespace App\Models\Project\Traits\Relationship;

trait BudgetRelationship
{
    public function budgetable()
    {
        return $this->morphTo();
    }
}
