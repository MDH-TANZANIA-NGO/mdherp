<?php

namespace App\Http\Controllers\Web\HumanResource\Interview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Repositories\Unit\DesignationRepository;
use App\Models\HumanResource\Interview\Interview;
use App\Models\HumanResource\HireRequisition\HireRequisitionJob;

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
        $intervies = $request->interviews;
        $comment = $request->comment;
        try{
            DB::beginTransaction();

            DB::commit();
        }catch (\Exception $e) {
            DB::rollback();
            throw new \Exception($e->getMessage());
        }
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
