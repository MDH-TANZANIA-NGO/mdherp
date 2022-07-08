<?php

namespace App\Http\Controllers\Web\HumanResource\Interview;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\Workflow\Workflow;
use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use App\Repositories\Access\UserRepository;
use App\Repositories\Unit\DesignationRepository;
use App\Repositories\Workflow\WfTrackRepository;
use App\Models\HumanResource\Interview\Interview;
use App\Services\Workflow\Traits\WorkflowInitiator;
use App\Models\HumanResource\Interview\InterviewWorkflowReport;
use App\Models\HumanResource\Interview\InterviewReportRecommendation;
use App\Repositories\HumanResource\Interview\InterviewReportRepository;
use App\Repositories\HumanResource\Interview\InterviewApplicantRepository;
use App\Repositories\HumanResource\HireRequisition\HireRequisitionJobRepository;
use App\Http\Controllers\Web\HumanResource\Interview\Traits\InterviewReportDatatable;
use App\Models\HumanResource\Interview\InterviewReportComment;

class InterviewReportController extends Controller
{
    use WorkflowInitiator,InterviewReportDatatable;
    public $designationRepository;
    public $interviewRepository;
    public $interviewReportRepository;
    public $interviewApplicantRepository;
    public $users;
    public $wf_tracks;
    public $hireRequisitionJobRepository;
    public function __construct()
    {
        $this->designationRepository = (new DesignationRepository());
        $this->interviewRepository = (new Interview());
        $this->interviewReportRepository = (new InterviewReportRepository());
        $this->interviewApplicantRepository = (new InterviewApplicantRepository());
        $this->hireRequisitionJobRepository = (new HireRequisitionJobRepository());
        $this->users = (new UserRepository());
        $this->wf_tracks = (new WfTrackRepository());
    }
    public function index()
    {
        return view('humanResource.Interview.report.index')
        ->with('processing_count', $this->interviewReportRepository->getAccessProcessingDatatable()->get()->count())
         ->with('denied_count', $this->interviewReportRepository->getAccessDeniedDatatable()->get()->count())
         ->with('rejected_count', $this->interviewReportRepository->getAccessRejectedDatatable()->get()->count())
         ->with('proved_count',$this->interviewReportRepository->getAccessProvedDatatable()->get()->count())
         ->with('saved_count', $this->interviewReportRepository->getAccessSavedDatatable()->get()->count());
        
    }
    public function initiate(Request $request)
    {        
        
        // if($this->interviewReportRepository->query()->where('hr_requisition_job_id',$request->hr_requisition_job_id)->first()){
        //     throw new GeneralException('already created');
        // }else{

        $hr_requisition_job_id =  $request->hr_requisition_job_id;      
        $hireRequisitionJob = $this->hireRequisitionJobRepository->find($hr_requisition_job_id);
        $interviewReport = $this->interviewReportRepository->store($request->all());
        $interviews = $this->interviewRepository->query()->where('hr_requisition_job_id', $hireRequisitionJob->id)->orderBy('id', 'DESC')->get();
        $this->interviewReportRepository->storeInterviewReport($interviews,$interviewReport->id);  
        $job_title = $this->designationRepository->getQueryDesignationUnit()->where('designations.id', $hireRequisitionJob->designation_id)->first(); 
        $recommended_applicants = InterviewReportRecommendation::join('hr_hire_applicants', 'hr_hire_applicants.id', 'hr_interview_report_recommendations.applicant_id')
            ->select([
                    DB::raw("CONCAT_WS(' ',hr_hire_applicants.first_name,hr_hire_applicants.middle_name,hr_hire_applicants.last_name) as full_name"),
                    'hr_hire_applicants.email'])
            ->where('hr_interview_report_recommendations.hr_requisition_job_id', $hireRequisitionJob->id)
            ->get();

        $applicants = $this->interviewApplicantRepository->getForSelect($interviews->pluck('id')->toArray());
        return view('HumanResource.Interview.report.initiate')
            ->with('job_title', $job_title)
            ->with('applicants', $applicants)
            ->with('interviews', $interviews)
            ->with('recommended_applicants', $recommended_applicants)
            ->with('hireRequisitionJob', $hireRequisitionJob->id)
            ->with('interview_workflow_report_id', $interviewReport->id);
    }

    public function recommend(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = [
                'applicant_id' => $request->applicant_id,
                'hr_requisition_job_id' => $request->hr_requisition_job_id
            ];
            InterviewReportRecommendation::create($data);
            alert()->success('Applicant Added Successfully', 'success');
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw new \Exception($e->getMessage());
        }
        return redirect()->back();
    }

    public function create(Request $request)
    {
        $designations = $this->designationRepository->getActiveAdvertisedForSelect();
        return view('humanResource.Interview.report.create')
                ->with('designations',$designations);
                
    }
    public function store(Request $request)
    {
        $intervies = $request->interviews;
        $comment = $request->comment;
        try {
            DB::beginTransaction();
            $interviewReport = $this->interviewReportRepository->find($request->interview_workflow_report_id);
            $this->interviewReportRepository->submit($interviewReport);
            InterviewReportComment::create([
                'user_id'=>access()->id(),
                'interview_report_id'=> $interviewReport->id,
                'comment' => $comment
            ]);
            $next_user = $this->users->getDirectorOfHR()->first()->user_id;
            $this->startWorkflow($interviewReport, 1,  $next_user);
            alert()->success('Interview Report Created Successfully', 'success');
            DB::commit();
            return redirect()->route('interview.report.show', $interviewReport->uuid);
        } catch (\Exception $e) {
            DB::rollback();
            throw new \Exception($e->getMessage());
        }
    }

    public function show(InterviewWorkflowReport $interviewReport)
    {
        $hireRequisitionJob = $this->hireRequisitionJobRepository->find($interviewReport->hr_requisition_job_id);
        $job_title = $this->designationRepository->getQueryDesignationUnit()
            ->where('designations.id', $hireRequisitionJob->designation_id)
            ->first();
        $interviews = $this->interviewRepository->query()
            ->where('hr_requisition_job_id', $hireRequisitionJob->id)
            ->orderBy('id', 'DESC')
            ->get();
        $recommended_applicants = InterviewReportRecommendation::join('hr_hire_applicants', 'hr_hire_applicants.id', 'hr_interview_report_recommendations.applicant_id')
            ->select([
                    DB::raw("CONCAT_WS(' ',hr_hire_applicants.first_name,hr_hire_applicants.middle_name,hr_hire_applicants.last_name) as full_name"),
                    'hr_hire_applicants.email'])
            ->where('hr_interview_report_recommendations.hr_requisition_job_id', $hireRequisitionJob->id)
            ->get();
             
        $comments = InterviewReportComment::where(['interview_report_id'=>$interviewReport->id])->get();
        $applicants = $this->interviewApplicantRepository->getForSelect($interviews->pluck('id')->toArray());
        $wf_module_group_id = 12;
        $wf_module = $this->wf_tracks->getWfModuleAfterWorkflowStart($wf_module_group_id, $interviewReport->id);
        $workflow = new Workflow(['wf_module_group_id' => $wf_module_group_id, "resource_id" => $interviewReport->id, 'type' => $wf_module->type]);
        $current_wf_track = $workflow->currentWfTrack();
        $current_level = $workflow->currentLevel();
        $can_edit_resource = $this->wf_tracks->canEditResource($interviewReport, $current_level, $workflow->wf_definition_id);
        return view('HumanResource.Interview.report.show')
            ->with('current_level', $current_level)
            ->with('job_title', $job_title)
            ->with('recommended_applicants', $recommended_applicants)
            ->with('applicants', $applicants)
            ->with('interviews', $interviews)
            ->with('hireRequisitionJob', $hireRequisitionJob->id)
            ->with('current_wf_track', $current_wf_track)
            ->with('can_edit_resource', $can_edit_resource)
            ->with('wfTracks', (new WfTrackRepository())->getStatusDescriptions($interviewReport))
            ->with('interview_report', $interviewReport)
            ->with('comments', $comments)
            ->with("show", true);
    }
}
