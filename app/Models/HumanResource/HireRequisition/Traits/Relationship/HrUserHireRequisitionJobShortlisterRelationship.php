<?php

namespace App\Models\HumanResource\HireRequisition\Traits\Relationship;

use App\Models\HumanResource\HireRequisition\HireRequisitionJob;

trait HrUserHireRequisitionJobShortlisterRelationship
{
    public function job()
    {
        return $this->belongsTo(HireRequisitionJob::class,'hr_hire_requisitions_job_id','id');
    }
}