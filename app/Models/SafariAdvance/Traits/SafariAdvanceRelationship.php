<?php

namespace App\Models\SafariAdvance\Traits;

use App\Models\Requisition\Travelling\requisition_travelling_cost;

trait SafariAdvanceRelationship
{
    public function travellingCosts()
    {
        return $this->hasMany(requisition_travelling_cost::class);
    }
}
