<?php

namespace App\Models\ProgramActivity\Traits;

use App\Models\Auth\User;
use App\Models\Requisition\Requisition;
use App\Models\Requisition\Training\requisition_training;
use App\Models\Requisition\Training\requisition_training_cost;
use App\Models\Workflow\WfTrack;

trait ProgramActivityRelationship
{

public function requisition()
{
    return $this->belongsTo(Requisition::class);
}

public function training()
{
    return$this->hasOne(requisition_training::class);
}

public function costs(){
    return $this->hasManyThrough(requisition_training_cost::class, requisition_training::class);
}
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return mixed
     */
    public function wfTracks()
    {
        return $this->morphMany(WfTrack::class, 'resource');
    }

}
