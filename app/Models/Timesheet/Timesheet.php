<?php

namespace App\Models\Timesheet;

use App\Models\Attendance\Attendance;
use App\Models\Auth\User;
use App\Models\BaseModel;
use App\Models\Workflow\WfTrack;

class Timesheet extends BaseModel
{
    /**
     * @return mixed
     */
    public function wfTracks()
    {
        return $this->morphMany(WfTrack::class, 'resource');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function getResourceNameAttribute()
    {
        return "<b>".$this->id."</b> <br>".
            $this->user->full_name_formatted."<br>".
            $this->user->designation_title;
    }

    public function attendances(): \Illuminate\Database\Eloquent\Relations\HasMany
    {

        return $this->hasMany(Attendance::class);
    }
}
