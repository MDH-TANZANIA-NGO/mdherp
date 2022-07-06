<?php

namespace App\Models\HumanResource\HireRequisition\Traits\Relationship;

use App\Models\Workflow\WfTrack;
use App\Models\HumanResource\HireRequisition\HrUserHireRequisitionJobShortlister;

trait HrUserHireRequisitionJobShortlisterRequestRelationship
{
    public function jobs()
    {
        return $this->hasMany(HrUserHireRequisitionJobShortlister::class,'hr_user_hire_requisition_job_shortlister_request_id','id');
    }
    /**
     * @return mixed
     */
    public function wfTracks()
    {
        return $this->morphMany(WfTrack::class, 'resource');
    }
}