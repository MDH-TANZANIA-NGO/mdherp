<?php

namespace App\Models\GOfficer;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class GovernmentRate extends BaseModel
{
    //

    public function govScales()
    {
        return $this->belongsToMany(GovernmentScale::class,'government_rate_scale')->withTimestamps();
    }
}
