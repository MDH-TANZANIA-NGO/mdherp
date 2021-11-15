<?php

namespace App\Models\GOfficer\Traits\Relationship;

use App\Models\GOfficer\GScale;

trait GRateRelationship
{
    public function scales()
    {
        return $this->belongsToMany(GScale::class,'g_rate_scale')->withTimestamps();
    }
}
