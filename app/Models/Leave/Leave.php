<?php

namespace App\Models\Leave;

use App\Models\Auth\User;
use App\Models\BaseModel;
use App\Models\Workflow\WfTrack;

class Leave extends BaseModel
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

    public function employee() {
        return $this->belongsTo(User::class, 'employee_id');
    }

    public function getResourceNameAttribute()
    {
        return "<b>".$this->id."</b> <br>".
            $this->user->full_name_formatted."<br>".
            $this->user->designation_title;
    }
}
