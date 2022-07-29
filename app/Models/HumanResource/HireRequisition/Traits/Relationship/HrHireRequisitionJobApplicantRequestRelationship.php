<?php

namespace App\Models\HumanResource\HireRequisition\Traits\Relationship;

use App\Models\Auth\User;
use App\Models\Workflow\WfTrack;
use App\Models\HumanResource\HireRequisition\HrUserHireRequisitionJobShortlister;

trait HrHireRequisitionJobApplicantRequestRelationship
{
    /**
     * @return mixed
     */
    public function wfTracks()
    {
        return $this->morphMany(WfTrack::class, 'resource');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}