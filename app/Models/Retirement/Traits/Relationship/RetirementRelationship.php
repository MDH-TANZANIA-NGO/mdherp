<?php

namespace App\Models\Retirement\Traits\Relationship;

use App\Models\Auth\User;
use App\Models\Workflow\WfTrack;

trait RetirementRelationship
{
public function user()
{
    return $this->belongsTo(User::class, 'user_id','id');
}
    public function wfTracks()
    {
        return $this->morphMany(WfTrack::class, 'resource');
    }

}
