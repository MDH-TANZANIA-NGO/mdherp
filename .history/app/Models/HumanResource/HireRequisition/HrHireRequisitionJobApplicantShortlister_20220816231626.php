<?php

namespace App\Models\HumanResource\HireRequisition;

use Illuminate\Database\Eloquent\Model;

class HrHireRequisitionJobApplicantShortlister extends Model
{
    protected $guarded[
        'hr_hire_requisition_job_applicant_id',
        'user_id'
    ];
}
