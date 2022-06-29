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
        return view('HumanResource.HireRequisition.job.applications');
    }

    //HireRequisitionJob $hire_requisition_job

    public function show(HireRequisitionJob $hire_requisition_job)
    {
        $applicants = $this->getApplicants($hire_requisition_job->id);
        
        return view('HumanResource.HireRequisition.job.show')
        ->with('hire_requisition_job', $hire_requisition_job)
        ->with('applicants', $this->getApplicants($hire_requisition_job->id));
    }

    
}
