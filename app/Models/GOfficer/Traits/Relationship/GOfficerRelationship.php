<?php

namespace App\Models\GOfficer\Traits\Relationship;

use App\Models\GOfficer\GScale;
use App\Models\System\Region;

trait GOfficerRelationship
{
    public function scale()
    {
        return $this->belongsTo(GScale::class,'g_scale_id','id');
    }
    public function region()
    {
        return$this->belongsTo(Region::class, 'region_id','id');
    }
}
