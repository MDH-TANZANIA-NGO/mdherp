<?php

namespace App\Models\Project\Traits\Relationship;

use App\Models\Project\Budget;

trait ProjectRelationship
{
    public function budgets()
    {
        return $this->morphMany(Budget::class, 'budgetable');
    }
}
