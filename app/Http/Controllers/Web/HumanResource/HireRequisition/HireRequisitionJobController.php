<?php

namespace App\Http\Controllers\Web\HumanResource\HireRequisition;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\HumanResource\HireRequisition\Traits\HireRequisitionJobDatatable;
use App\Models\HumanResource\HireRequisition\HireRequisitionJob;
use App\Repositories\HumanResource\HireRequisition\HireRequisitionJobRepository;
use Illuminate\Http\Request;

class HireRequisitionJobController extends Controller
{
    use HireRequisitionJobDatatable;
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

    public function show(HireRequisitionJob $hire_requisition_job)
    {
        return view('HumanResource.HireRequisition.job.show');
    }

    
}
