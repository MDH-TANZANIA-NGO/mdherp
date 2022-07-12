<?php

namespace App\Http\Controllers\Web\HumanResource\HireRequisition;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\HumanResource\HireRequisition\Traits\HireRequisitionJobDatatable;
use App\Models\HumanResource\HireRequisition\HireRequisitionJob;
use App\Repositories\HumanResource\HireRequisition\HireRequisitionJobRepository;
use App\Services\RecruitmentApi\HumanResource\HireRequisition\HireRequisitionJobService;
use Illuminate\Http\Request;

class HireRequisitionJobController extends Controller
{
    use HireRequisitionJobDatatable, HireRequisitionJobService;
    protected $hire_requisition_jobs;

    public function __construct()
    {
        $this->hire_requisition_jobs = (new HireRequisitionJobRepository());
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function applications()
    {
        return view('HumanResource.hireRequisition.job.applications');
    }

    public function show(HireRequisitionJob $hire_requisition_job)
    {
        return view('HumanResource.hireRequisition.job.show')
        ->with('hire_requisition_job', $hire_requisition_job)
        ->with('applicants', $this->getApplicantsByJob($hire_requisition_job->id));
    }

    public function showMore(HireRequisitionJob $hire_requisition_job, $online_applicant_id)
    {
        $applicant = $this->getApplicantByJob($online_applicant_id, $hire_requisition_job->id);
        return view('HumanResource.hireRequisition.job.applicant_details')
        ->with('hire_requisition_job', $hire_requisition_job)
        ->with('applicants', $this->getApplicantsByJob($hire_requisition_job->id))
        ->with('applicant', $applicant)
        ->with('personal_info', $applicant->applicant)
        ->with('educations', $applicant->educations)
        ->with('addresses', $applicant->addresses)
        ->with('experiences', $applicant->experiences)
        ->with('skills', $applicant->skills)
        ->with('referees', $applicant->referees)
        ->with('attachment', $applicant->applications);
    }


}
