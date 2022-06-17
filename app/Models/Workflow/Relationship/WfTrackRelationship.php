<?php

namespace App\Models\Workflow\Relationship;

use App\Models\Auth\User;
use App\Models\Workflow\WfDefinition;

trait WfTrackRelationship
{

    public function wfDefinition()
    {
        return $this->belongsTo(WfDefinition::class);
    }

    public function user()
    {
        return $this->morphTo();
    }

    /*public function resource()
    {
        return $this->morphTo()->withoutGlobalScopes();
    }*/

    public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }


    public function resource()
    {
        //TODO Recheck if system works withoutGlobalScopes
        return $this->morphTo()->withoutGlobalScopes();
    }
}
