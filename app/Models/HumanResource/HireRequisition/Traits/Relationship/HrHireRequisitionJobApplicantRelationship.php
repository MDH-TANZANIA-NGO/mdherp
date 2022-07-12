<?php

namespace App\Models\HumanResource\HireRequisition\Traits\Relationship;

use App\Models\HumanResource\HireRequisition\HrHireRequisitionJobApplicantRequest;

trait HrHireRequisitionJobApplicantRelationship
{
    public function request()
    {
        return $this->belongsTo(HrHireRequisitionJobApplicantRequest::class,'hr_hire_requisition_job_applicant_request_id','id');
    }
}