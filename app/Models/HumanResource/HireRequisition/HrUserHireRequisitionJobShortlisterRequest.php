<?php

namespace App\Models\HumanResource\HireRequisition;

use App\Models\BaseModel;
use App\Models\HumanResource\HireRequisition\HrUserHireRequisitionJobShortlister;

class HrUserHireRequisitionJobShortlisterRequest extends BaseModel
{
    public function jobs()
    {
        return $this->hasMany(HrUserHireRequisitionJobShortlister::class,'hr_user_hire_requisition_job_shortlister_request_id','id');
    }
}
