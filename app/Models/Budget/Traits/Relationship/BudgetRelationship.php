<?php

namespace App\Models\Budget\Traits\Relationship;

use App\Models\Budget\FiscalYear;

trait BudgetRelationship
{
    public function fiscalYear()
    {
        return $this->belongsTo(FiscalYear::class);
    }
}
