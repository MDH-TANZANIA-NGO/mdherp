<?php

namespace App\Models\Fleet;

use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;
use App\Models\Auth\User;
use App\Models\Workflow\WfTrack;

class FleetRequest extends BaseModel
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function wfTracks()
    {
        return $this->morphMany(WfTrack::class, 'resource');
    }
    public function getResourceNameAttribute()
    {
        return "<b>" . $this->id . "</b> <br>" .
        $this->user->full_name_formatted . "<br>" .
        $this->user->designation_title;
    }
    
}
