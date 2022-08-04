<?php

namespace App\Repositories\HumanResource\HireRequisition;

use App\Models\HumanResource\HireRequisition\HrHireRequisitionJobApplicantShortlister;
use App\Repositories\BaseRepository;

class HrHireRequisitionJobApplicantShortlisterRepository extends BaseRepository
{
    const MODEL = HrHireRequisitionJobApplicantShortlister::class;

    public function store($hr_hire_requisition_job_applicant_id)
    {
        //check if selected
    }
}