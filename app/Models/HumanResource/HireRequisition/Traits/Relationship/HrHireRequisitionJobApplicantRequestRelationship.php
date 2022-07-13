<?php

namespace App\Models\HumanResource\HireRequisition\Traits\Relationship;

use App\Models\Workflow\WfTrack;

trait HrHireRequisitionJobApplicantRequestRelationship
{
    /**
     * @return mixed
     */
    public function wfTracks()
    {
        return $this->morphMany(WfTrack::class, 'resource');
    }
}