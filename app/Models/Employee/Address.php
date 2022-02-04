<?php

namespace App\Models\Employee;

use App\Models\BaseModel;
use App\Models\System\District;
use App\Models\System\Region;

class Address extends BaseModel
{
    public function region(){
        return $this->belongsTo(Region::class);
    }
    public function district(){
        return $this->belongsTo(District::class);
    }
}
