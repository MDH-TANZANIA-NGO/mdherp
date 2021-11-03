<?php

namespace App\Models\Budget\Traits\Relationship;

use App\Models\Budget\FiscalYear;
use App\Models\Project\Activity;

trait BudgetRelationship
{
    public function fiscalYear()
    {
        return $this->belongsTo(FiscalYear::class);
    }
    public function activity(){
        return $this->belongsTo(Activity::class);
    }
}
