<?php

namespace App\Models\GOfficer\Traits\Relationship;

use App\Models\GOfficer\GScale;
use App\Models\Requisition\Training\requisition_training_cost;

trait GRateRelationship
{
    public function scales()
    {
        return $this->belongsToMany(GScale::class,'g_rate_scale')->withTimestamps();
    }

    public function amount(){

        return $this->belongsToMany(requisition_training_cost::class, 'requisition_training_cost');

    }
}
