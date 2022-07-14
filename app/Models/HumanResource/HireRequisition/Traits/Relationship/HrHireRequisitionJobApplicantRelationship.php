<?php

namespace App\Models\HumanResource\HireRequisition\Traits\Relationship;

use App\Models\Auth\User;
use App\Models\HumanResource\HireRequisition\HrHireApplicant;
use App\Models\HumanResource\HireRequisition\HrHireRequisitionJobApplicantRequest;

trait HrHireRequisitionJobApplicantRelationship
{
    public function request()
    {
        return $this->belongsTo(HrHireRequisitionJobApplicantRequest::class,'hr_hire_requisition_job_applicant_request_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function applicant()
    {
        return $this->belongsTo(HrHireApplicant::class,'hr_hire_applicant_id', 'id');
    }
}