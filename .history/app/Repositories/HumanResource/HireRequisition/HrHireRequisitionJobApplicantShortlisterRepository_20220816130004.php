<?php

namespace App\Repositories\HumanResource\HireRequisition;

use App\Exceptions\GeneralException;
use App\Models\HumanResource\HireRequisition\HireRequisitionJob;
use App\Models\HumanResource\HireRequisition\HrHireRequisitionJobApplicantShortlister;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class HrHireRequisitionJobApplicantShortlisterRepository extends BaseRepository
{
    const MODEL = HrHireRequisitionJobApplicantShortlister::class;

    public function store($hr_hire_requisition_job_applicant_id)
    {
        //check if selected
    }

    public function checkIfHrHireRequisitionsJobSelected($input)
    {
        if (!isset($input['hr_applicants'])) {
            throw new GeneralException('Please select atleast one job to proceed');
        }
    }

    public function shortlist(HireRequisitionJob $hire_requisition_job, $input)
    {
        $this->checkIfHrHireRequisitionsJobSelected($input);
        return DB::transaction(function() use($))
    }
}