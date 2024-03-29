<?php

namespace App\Models\SafariAdvance\Traits;

use App\Models\Auth\User;
use App\Models\Requisition\Travelling\requisition_travelling_cost;
use App\Models\Retirement\Retirement;
use App\Models\SafariAdvance\SafariAdvancePayment;
use App\Models\System\District;
use App\Models\System\Region;
use App\Models\Workflow\WfTrack;
use App\SafariAdvanceDetails;

trait SafariAdvanceRelationship
{
    public function travellingCost()
    {
        return $this->belongsTo(requisition_travelling_cost::class, 'requisition_travelling_cost_id', 'id');
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
    public function SafariDetails()
    {
     return $this->hasOne(\App\Models\SafariAdvance\SafariAdvanceDetails::class);
    }

    public function retirement()
    {
        return $this->hasOne(Retirement::class);
    }
    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public  function safariPayment()
    {
        return $this->hasOne(SafariAdvancePayment::class);
    }

}
