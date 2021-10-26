<?php

namespace App\Models\Budget\Traits\Relationship;

use App\Models\Budget\Budget;

trait FiscalYearRelationship
{
    public function budgets()
    {
        return $this->hasMany(Budget::class);
    }
}
