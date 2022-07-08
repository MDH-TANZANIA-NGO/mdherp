<?php

namespace App\Models\HumanResource\HireRequisition\Traits\Relationship;

use App\Models\Auth\User;
use App\Models\HumanResource\HireRequisition\HireRequisitionJob;

trait HrUserHireRequisitionJobShortlisterUserRelationship
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function job()
    {
        return $this->belongsTo(HireRequisitionJob::class,'hr_hire_requisitions_job_id','id');
    }
}