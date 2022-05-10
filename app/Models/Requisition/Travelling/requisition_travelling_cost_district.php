<?php

namespace App\Models\Requisition\Travelling;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class requisition_travelling_cost_district extends BaseModel
{
    //
    public function travellingCost()
    {
        return $this->belongsTo(requisition_travelling_cost::class);
    }
}
