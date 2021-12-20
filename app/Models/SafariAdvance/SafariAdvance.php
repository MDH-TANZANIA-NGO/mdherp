<?php

namespace App;

use App\Models\BaseModel;
use App\Models\Requisition\Travelling\requisition_travelling_cost;
use App\Models\Requisition\Travelling\travelling_cost;
use Illuminate\Database\Eloquent\Model;

class SafariAdvance extends BaseModel
{
    //

    public function travellingCosts()
    {
        return $this->hasMany(requisition_travelling_cost::class);
    }

}
