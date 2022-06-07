<?php

namespace App\Models\GOfficer;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class GovernmentScale extends BaseModel
{
    //

    public function govRates()
    {
        return $this->belongsToMany(GovernmentRate::class,'government_rate_scale','government_scale_id','id')->withTimestamps();
    }
}
