<?php

namespace App\Models\Retirement\Traits\Relationship;

use App\Models\Auth\User;
use App\Models\FilesAttachment\FilesAttachment;
use App\Models\Retirement\RetirementDetail;
use App\Models\SafariAdvance\SafariAdvance;
use App\Models\System\District;
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
public function details()
{
    return $this->hasOne(RetirementDetail::class, 'retirement_id', 'id');
}
public function attachment()
{
    return $this->hasOne(FilesAttachment::class, 'retirement_id', 'id');
}
public function safari()
{
    //return $this->belongsTo(SafariAdvance::class);
    return $this->belongsTo(SafariAdvance::class, 'safari_advance_id', 'id');
}

}
