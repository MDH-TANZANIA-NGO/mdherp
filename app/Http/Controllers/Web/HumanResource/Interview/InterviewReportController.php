<?php

namespace App\Http\Controllers\Web\HumanResource\Interview;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Unit\DesignationRepository;
use App\Models\HumanResource\HireRequisition\HireRequisitionJob;
use App\Models\HumanResource\Interview\Interview;

class InterviewReportController extends Controller
{
    public $designationRepository;
    public $interviewRepository;
    public function __construct()
    {
        $this->designationRepository = (New DesignationRepository());
        $this->interviewRepository = (New Interview());
    }
    public function index(){
        
    }
    public function show(){

    }
    public function store(Request $request){
        return $request;

    }
    public function create(HireRequisitionJob $hireRequisitionJob){

        $job_title = $this->designationRepository->getQueryDesignationUnit()
            ->where('designations.id', $hireRequisitionJob->designation_id)
            ->first();
        $interviews = $this->interviewRepository->query()
                    ->where('hr_requisition_job_id',$hireRequisitionJob->id)
                    ->orderBy('id', 'DESC')
                    ->get();
        return view('HumanResource.Interview.report.create')
                ->with('job_title',$job_title)
                ->with('interviews',$interviews);

    }
}
