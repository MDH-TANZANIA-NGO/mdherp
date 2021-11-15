<?php

namespace App\Models\GOfficer\Traits\Relationship;

use App\Models\GOfficer\GScale;

trait GOfficerRelationship
{
    public function scale()
    {
        return $this->belongsTo(GScale::class,'g_scale_id','id');
    }
}
