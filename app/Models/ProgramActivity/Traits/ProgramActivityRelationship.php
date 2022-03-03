<?php

namespace App\Models\ProgramActivity\Traits;

use App\Models\Auth\User;
use App\Models\Requisition\Requisition;
use App\Models\Requisition\Training\requisition_training;
use App\Models\Requisition\Training\requisition_training_cost;
use App\Models\Retirement\Retirement;
use App\Models\System\District;
use App\Models\System\Region;
use App\Models\Workflow\WfTrack;
use App\Models\ProgramActivity\ProgramActivityParticipant;

trait ProgramActivityRelationship
{

public function requisition()
{
    return $this->belongsTo(Requisition::class);
}

public function training()
{
    return$this->belongsTo(requisition_training::class, 'requisition_training_id', 'id');
}

public function costs(){
    return $this->hasManyThrough(requisition_training_cost::class, requisition_training::class);
}
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function district()
    {
        return $this->hasOne(District::class);
    }
    public function participants()
    {
        return$this->hasMany(ProgramActivityParticipant::class);
    }

    public function retirement()
    {
        return $this->hasOne(Retirement::class);
    }

    /**
     * @return mixed
     */
    public function wfTracks()
    {
        return $this->morphMany(WfTrack::class, 'resource');
    }
    public function region()
    {
        return $this->belongsTo(Region::class);
    }

}
