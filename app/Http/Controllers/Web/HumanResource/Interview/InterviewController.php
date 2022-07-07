<?php

namespace App\Http\Controllers\Web\HumanResource\Interview;

use App\Jobs\IntervieweeEmailJob;
use App\Jobs\InterviewEmailJob;
use App\Models\Auth\User;
use App\Notifications\HumanResource\InterviewCallNotification;
use App\Notifications\HumanResource\IntervieweeCallNotification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Access\UserRepository;
use App\Repositories\Unit\DesignationRepository;
use App\Models\HumanResource\Interview\Interview;
use App\Models\HumanResource\Interview\InterviewTypes;
use App\Models\HumanResource\Interview\InterviewPanelist;
use App\Models\HumanResource\Interview\InterviewSchedule;
use App\Repositories\HumanResource\Interview\InterviewRepository;
use App\Repositories\HumanResource\Interview\InterviewQuestionRepository;
use App\Repositories\HumanResource\Interview\InterviewApplicantRepository;
use App\Repositories\HumanResource\HireRequisition\HrHireApplicantRepository;
use  App\Http\Controllers\Web\HumanResource\Interview\Traits\InterviewDatatable;
use App\Models\HumanResource\Interview\InterviewPanelistCounter;
use App\Models\Unit\Department;
use App\Repositories\HumanResource\HireRequisition\HireRequisitionJobRepository;
use App\Repositories\HumanResource\Interview\InterviewPanelistRepository;
use App\Repositories\System\DistrictRepository;
use Illuminate\Support\Facades\DB;

class InterviewController extends Controller
{
    public $designationRepository;
    public $interviewRepository;
    public $interviewApplicantRepository;
    public $hrHireApplicantRepository;
    public $userRepository;
    public $hireRequisitionJobRepository;
    public $interviewQuestionRepository;
    public $districtRepository;
    public $panelistRepository;

    use InterviewDatatable;
    public function __construct()
    {
        $this->designationRepository = (new DesignationRepository());
        $this->interviewRepository = (new InterviewRepository());
        $this->interviewApplicantRepository = (new InterviewApplicantRepository());
        $this->hrHireApplicantRepository = (new HrHireApplicantRepository());
        $this->userRepository = (new UserRepository());
        $this->hireRequisitionJobRepository = (new HireRequisitionJobRepository());
        $this->interviewQuestionRepository = (new InterviewQuestionRepository());
        $this->districtRepository = (new DistrictRepository());
        $this->panelistRepository = (new InterviewPanelistRepository());
    }

    public function index()
    {
        return view('humanResource.Interview.index');

    }
    public function list()
    {
        // dd($this->interviewRepository->getAccessWaitForReportDatatable()->get());
        return view('humanResource.Interview.list')
            ->with('processing_count', 0)
            ->with('return_for_modification_count', 0)
            ->with('approved_count', 0)
            ->with('wait_interview_question_count', $this->interviewRepository->getAccessWaitForQuestionsDatatable()->get()->count())
            ->with('wait_interview_report_count', $this->interviewRepository->getAccessWaitForReportDatatable()->get()->count())
            ->with('saved_count', 0);
    }

    public function create()
    {
        $designations = $this->designationRepository->getActiveAdvertisedForSelect();
        $interview_types = InterviewTypes::get()->pluck('name', 'id');
        return view('humanResource.Interview.create')
            ->with('designations', $designations)
            ->with('interview_types', $interview_types);
    }
    public function store(Request $request)
    {
        $interview = $this->interviewRepository->store($request->all());
        alert()->success('initiated Successfully');
        return redirect()->route('interview.initiate-panelist', $interview->uuid);
    }
    public function show(Interview $interview)
    {;
        $schedules = InterviewSchedule::where('interview_id', $interview->id)->get()->pluck('id');
        $interviewApplicants = $this->hrHireApplicantRepository->getPendingSelected($interview)->get();
        $interview_type = InterviewTypes::find($interview->interview_type_id);
        $panelists = InterviewPanelist::select([
            DB::raw("CONCAT_WS(' ',users.first_name,users.last_name) as full_name"),
            DB::raw("users.email"),
            DB::raw("hr_interview_panelists.technical_staff"),
            DB::raw("users.id")
        ])
            ->join('users', 'users.id', 'hr_interview_panelists.user_id')
            ->where('interview_id', $interview->id)->get();
        
        $hrHireRequisitionJob = $this->hireRequisitionJobRepository
            ->query()
            ->with('designation')
            ->where('hr_hire_requisitions_jobs.id', $interview->hr_requisition_job_id)
            ->first();
        $job_title = $this->designationRepository->getQueryDesignationUnit()
            ->where('designations.id', $hrHireRequisitionJob->designation_id)
            ->first();
        $questions = $this->interviewQuestionRepository
                            ->query()
                            ->where('interview_id',$interview->id)->get();
        return view('HumanResource.Interview.show')
                ->with('interview', $interview)
                ->with('show', true)
                ->with('interview_type', $interview_type)
                ->with('schedules', $schedules)
                ->with('job_title', $job_title)
                ->with('questions', $questions)
                ->with('interviewApplicants', $interviewApplicants)
                ->with('hrHireRequisitionJob', $hrHireRequisitionJob)
                ->with('panelists', $panelists);
    }

    public function initiate(Interview $interview)
    {
        $users = $this->userRepository->forSelect();
        $schedules = InterviewSchedule::where('interview_id', $interview->id)->get()->pluck('id');
        $interviewApplicants = $this->hrHireApplicantRepository->getPendingSelected($interview)->get();
        $interview_type = InterviewTypes::find($interview->interview_type_id);
        $panelists = InterviewPanelist::select([
            DB::raw("CONCAT_WS(' ',users.first_name,users.last_name) as full_name"),
            DB::raw("users.email"),
            DB::raw("users.id")
        ])
            ->join('users', 'users.id', 'hr_interview_panelists.user_id')
            ->where('interview_id', $interview->id)->get();
        $hrHireRequisitionJob = $this->hireRequisitionJobRepository
            ->query()
            ->with('designation')
            ->where('hr_hire_requisitions_jobs.id', $interview->hr_requisition_job_id)
            ->first();
        $job_title = $this->designationRepository->getQueryDesignationUnit()
            ->where('designations.id', $hrHireRequisitionJob->designation_id)
            ->first();
        $districts = $this->districtRepository->getForPluck();
        return view('HumanResource.Interview.initiate')
            ->with('interview', $interview)
            ->with('interview_type', $interview_type)
            ->with('schedules', $schedules)
            ->with('job_title', $job_title)
            ->with('interviewApplicants', $interviewApplicants)
            ->with('hrHireRequisitionJob', $hrHireRequisitionJob)
            ->with('panelists', $panelists)
            ->with('districts', $districts)
            ->with('users', $users);
    }

    public function initiatePanelist(Interview $interview)
    {
        $users = $this->userRepository->forSelect();
        $schedules = InterviewSchedule::where('interview_id', $interview->id)->get()->pluck('id');
        $interviewApplicants = $this->hrHireApplicantRepository->getPendingSelected($interview)->get();
        $interview_type = InterviewTypes::find($interview->interview_type_id);
        $hrHireRequisitionJob = $this->hireRequisitionJobRepository
            ->query()
            ->with('designation')
            ->where('hr_hire_requisitions_jobs.id', $interview->hr_requisition_job_id)
            ->first();
        $job_title = $this->designationRepository->getQueryDesignationUnit()
                    ->where('designations.id', $hrHireRequisitionJob->designation_id)
                    ->first();
        return view('humanResource.Interview.panelist.create')
            ->with('interview', $interview)
            ->with('job_title', $job_title)
            ->with('interview_type', $interview_type)
            ->with('hrHireRequisitionJob', $hrHireRequisitionJob)
            ->with('users', $users);
    }


    public function addapplicant(Request $request)
    {
        DB::beginTransaction();
        if ($request->has('applicant'))
            $interview = $this->interviewRepository->find($request->interview_id);
            $interviewScheduleData = [
                'interview_id' => $interview->id,
                'interview_date' => $request->interview_date,
                'district_id' => $request->district_id,
                'description' => $request->description
            ];
            $interviewSchedule = InterviewSchedule::create($interviewScheduleData);
            $data = $request->all();
            $data['interview_schedule_id'] = $interviewSchedule->id;
            $this->interviewApplicantRepository->store($data);
        alert()->success('added Successfully');
        DB::commit();
        return redirect()->route('interview.initiate', $interview->uuid);
    }

    public function addPanelist(Request $request)
    {
        DB::beginTransaction();
            $panelists = $request->panelist_id;
            $total_panelist = count($panelists);
            $interview_id = $request->interview_id;
            InterviewPanelistCounter::create(['total_panelist'=> $total_panelist,'interview_id'=>$interview_id]);
            foreach ($panelists as $panelist) {
                InterviewPanelist::create([
                    'interview_id' => $interview_id,
                    'user_id' => $panelist
                ]);
            }
        DB::commit();
        $interview = $this->interviewRepository->find($request->interview_id);
        return redirect()->route('interview.initiate', $interview->uuid);
    }

    public function notifyApplicant(Request $request)
    {
        DB::beginTransaction();
        $interview = $this->interviewRepository->find($request->interview_id);
        $interview->update(['has_interview_invitation'=>1]);
        $selectedApplicant = $this->hrHireApplicantRepository->getSelected($interview)->get();
        InterviewPanelist::where('user_id',$request->technical_staff)->update(['technical_staff'=> 1]);
        foreach ($selectedApplicant as $applicant) {
            IntervieweeEmailJob::dispatch($applicant,$interview);
        }


        $panelist = InterviewPanelist::where('interview_id', $interview->id)->chunk(1, function ($rows) use ($interview) {
            foreach ($rows as $row) {

                InterviewEmailJob::dispatch(User::find($row->user_id),$interview);
            }
        });
        alert()->success('added Successfully');
        DB::commit();
        return redirect()->route('interview.show',$interview->uuid);
    }

    public function applicantlist(Interview $interview)
    {
        $applicants =   $this->hrHireApplicantRepository->getSelectedWithMarks($interview)->get();  
        $completed   =   $this->interviewApplicantRepository->competedScored($interview->id)->count();                     
        $pending   =   $this->interviewApplicantRepository->pendingScored($interview->id)->count();            
        $questions =  $this->interviewQuestionRepository->query()
                        ->where('interview_id', $interview->id)->get();
        $has_report = $this->panelistRepository->query()
                    ->where('interview_id',$interview->id)
                    ->where('has_report',1)
                    ->where('user_id',access()->id())->first();
        if($has_report){
            $has_report = 1;
        }else{
            $has_report = 0;
        } 

        $interview_type = InterviewTypes::find($interview->interview_type_id);
        return view('HumanResource.Interview.question_marks.index')
                ->with('applicants', $applicants)
                ->with('questions', $questions)
                ->with('interview_type', $interview_type)
                ->with('completed', $completed)
                ->with('pending', $pending)
                ->with('has_report', $has_report)
                ->with('interview', $interview);
    }

    

    public function showPanelistJobs()
    {
        return view('humanResource.Interview.job.applications');
    }

    public function submitForReport(Request $request){
        $input['has_report'] = 1;
        $panelist = $this->panelistRepository->query()->where('user_id',access()->id())->first();
        $interview = $this->interviewRepository->find($request->interview_id);     
        InterviewPanelistCounter::where('interview_id',$interview->id)->update([]);
        alert()->success('added Successfully');
        return redirect()->route('interview.showPanelistJobs',$interview->uuid)->with('msg','added');
    }

}
