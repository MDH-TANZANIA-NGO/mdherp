<?php

namespace App\Models\Listing;

use App\Models\Auth\User;
use App\Models\BaseModel;
use App\Models\Workflow\WfTrack;

class Listing extends BaseModel
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function workingTools(){
        return $this->belongsToMany(WorkingTool::class, 'listing_working_tool');
    }

    public function wfTracks()
    {
        return $this->morphMany(WfTrack::class, 'resource');
    }

    public function getResourceNameAttribute()
    {
        return "<b>".$this->id."</b> <br>".
            $this->user->full_name_formatted."<br>".
            $this->user->designation_title;
    }
}
