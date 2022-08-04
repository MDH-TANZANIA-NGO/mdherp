<?php

namespace App\Models\Attendance;

use App\Models\Auth\User;
use App\Models\BaseModel;
use App\Models\GOfficer\GOfficer;
use Illuminate\Database\Eloquent\Model;

class ActivityAttendance extends BaseModel
{
    //
    public function user()
    {
        return $this->belongsTo(User::class, 'creator_id', 'id');
    }
    public function gOfficer()
    {
        return $this->belongsTo(GOfficer::class, 'creator_id', 'id');
    }
}
