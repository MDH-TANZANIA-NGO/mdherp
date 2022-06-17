<?php

namespace App\Models\Payment\Traits\Relationship;

use App\Models\Auth\User;
use App\Models\Requisition\Requisition;
use App\Models\Workflow\WfTrack;

trait PaymentRelationship
{

    //
    public function wfTracks()
    {
        return $this->morphMany(WfTrack::class, 'resource');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function requisition()
    {
        return $this->belongsTo(Requisition::class);
    }


}
