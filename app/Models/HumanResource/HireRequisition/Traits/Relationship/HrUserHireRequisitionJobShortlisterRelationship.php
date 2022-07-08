<?php

namespace App\Models\HumanResource\HireRequisition\Traits\Relationship;

use App\Models\HumanResource\HireRequisition\HireRequisitionJob;
use App\Models\HumanResource\HireRequisition\HrUserHireRequisitionJobShortlisterUser;

trait HrUserHireRequisitionJobShortlisterRelationship
{
    public function job()
    {
        return $this->belongsTo(HireRequisitionJob::class,'hr_hire_requisitions_job_id','id');
    }

    public function listUsers()
    {
        return $this->hasMany(HrUserHireRequisitionJobShortlisterUser::class,'hr_user_hire_requisition_job_shortlister_id','id');
    }


}