<?php

namespace App\Models\Budget\Traits\Relationship;

use App\Models\Budget\Budget;
use App\Models\System\Region;

trait SubBudgetRelationship
{
    public function budget(){
        return $this->belongsTo(Budget::class);
    }

    public function region(){
        return $this->belongsTo(Region::class);
    }
}
