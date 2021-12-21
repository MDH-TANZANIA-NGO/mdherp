<?php

namespace App\Models\SafariAdvance\Traits;

use App\Models\Requisition\Travelling\requisition_travelling_cost;

trait SafariAdvanceRelationship
{
    public function travellingCost()
    {
        return $this->belongsTo(requisition_travelling_cost::class, 'requisition_travelling_cost_id', 'id');
    }
}
