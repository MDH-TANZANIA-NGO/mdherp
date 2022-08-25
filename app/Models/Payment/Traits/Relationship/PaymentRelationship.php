<?php

namespace App\Models\Payment\Traits\Relationship;

use App\Models\Activities\Reports\ActivityReport;
use App\Models\Auth\User;
use App\Models\ProgramActivity\ProgramActivityPayment;
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

    public function activityPayment()
    {
        return $this->belongsTo(ProgramActivityPayment::class);
    }


}
