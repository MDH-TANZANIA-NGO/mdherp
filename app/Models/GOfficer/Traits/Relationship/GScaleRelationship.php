<?php

namespace App\Models\GOfficer\Traits\Relationship;

use App\Models\GOfficer\GRate;

trait GScaleRelationship
{
    public function rates()
    {
        return $this->belongsToMany(GRate::class,'g_rate_scale','g_scale_id','id')->withTimestamps();
    }
}
