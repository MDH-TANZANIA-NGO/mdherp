<?php

namespace App\Http\Controllers\Web\HumanResource\HireRequisition;

use App\Http\Controllers\Controller;
use App\Models\HumanResource\HireRequisition\HireRequisitionJob;
use App\Repositories\Access\UserRepository;
use App\Repositories\HumanResource\HireRequisition\HrHireRequisitionJobShortlistRepository;
use App\Services\Workflow\Traits\WorkflowInitiator;
use Illuminate\Http\Request;

class HrHireRequisitionJobShortlistController extends Controller
{
    use WorkflowInitiator;

    protected $hr_hire_requisition_job_shortlists;

    public function __construct()
    {
        $this->hr_hire_requisition_job_shortlists = (new HrHireRequisitionJobShortlistRepository());
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function shortlist(HireRequisitionJob $hire_requisition_job, $input)
    {
        $this->hr_hire_requisition_job_shortlists->shortlist($hire_requisition_job, $input);
        alert()->success('Shortlist Has been done Successfully');
        return view('HumanResource.HireRequisition.shortlist.show');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function submit($hire_requisition_job_id)
    {
        $hr_hire_requisition_job_shortlist = $this->hr_hire_requisition_job_shortlists->store($hire_requisition_job_id);
        $next_user_id = (new UserRepository())->getDirectorOfHR()->first()->user_id;
        $this->startWorkflow($hr_hire_requisition_job_shortlist, 1, $next_user_id); 
        alert()->success('Shortlist submited to workflow Successfully');
        return view('HumanResource.HireRequisition.shortlist.show');
    }

}
