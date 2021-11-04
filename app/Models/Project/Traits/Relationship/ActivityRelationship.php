<?php

namespace App\Models\Project\Traits\Relationship;

use App\Models\Budget\Budget;
use App\Models\Project\OutputUnit;

trait ActivityRelationship
{
    public function outputUnit()
    {
        return $this->belongsTo(OutputUnit::class);
    }

    public function budgets()
    {
        return $this->hasMany(Budget::class);
    }
}
