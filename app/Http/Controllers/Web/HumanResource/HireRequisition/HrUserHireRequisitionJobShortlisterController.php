<?php

namespace App\Http\Controllers\Web\HumanResource\HireRequisition;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\HumanResource\HireRequisition\HrUserHireRequisitionJobShortlisterRepository;

class HrUserHireRequisitionJobShortlisterController extends Controller
{
    protected $hr_user_hire_requisition_job_shortlisters;

    public function __construct()
    {
        $this->hr_user_hire_requisition_job_shortlisters = (new HrUserHireRequisitionJobShortlisterRepository());
    }
    
    public function addUser(Request $request)
    {
        
    }
}
