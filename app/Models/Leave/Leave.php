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
}
