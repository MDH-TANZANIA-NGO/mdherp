<?php

namespace App\Models\Attendance;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class Hotspot extends BaseModel
{
    //
    public function attendances()
    {
        $this->hasMany(ActivityAttendance::class);
    }
}
