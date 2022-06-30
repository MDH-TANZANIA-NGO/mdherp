<?php

namespace App\Http\Controllers\Web\HumanResource\HireRequisition;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\HumanResource\HireRequisition\HrHireRequisitionJobApplicantRepository;

class HrHireRequisitionJobApplicantController extends Controller
{
    protected $hr_hire_requisition_job_applicants;

    public function __construct()
    {
        $this->hr_hire_requisition_job_applicants = (new HrHireRequisitionJobApplicantRepository());
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function attach($hr_hire_requisitions_job_id, $hr_hire_applicant_id, $online_applicant_id)
    {

        return redirect()->route('hr.job.show',$hr_hire_requisitions_job_id);
    }

}
