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
use App\Repositories\HumanResource\HireRequisition\HireRequisitionJobRepository;
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
    }

    public function index()
    {
        return view('HumanResource.Interview.index')
            ->with('processing_count', 0)
            ->with('return_for_modification_count', 0)
            ->with('approved_count', 0)
            ->with('wait_verification_count', 0)
            ->with('saved_count', 0);
    }

    public function create()
    {
        $designations = $this->designationRepository->getActiveAdvertisedForSelect();
        $interview_types = InterviewTypes::get()->pluck('name', 'id');
        return view('HumanResource.Interview.create')
            ->with('designations', $designations)
            ->with('interview_types', $interview_types);
    }
    public function store(Request $request)
    {
        $interview = $this->interviewRepository->store($request->all());
        alert()->success('initiated Successfully');
        return redirect()->route('interview.initiate-panelist', $interview->uuid);
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
        return view('HumanResource.Interview.interview_date')
            ->with('interview', $interview)
            ->with('interview_type', $interview_type)
            ->with('schedules', $schedules)
            ->with('job_title', $job_title)
            ->with('interviewApplicants', $interviewApplicants)
            ->with('hrHireRequisitionJob', $hrHireRequisitionJob)
            ->with('panelists', $panelists)
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
        return view('HumanResource.Interview.panelist')
            ->with('interview', $interview)
            ->with('job_title', $job_title)
            ->with('interview_type', $interview_type)
            ->with('hrHireRequisitionJob', $hrHireRequisitionJob)
            ->with('users', $users);
    }


    public function addapplicant(Request $request)
    {
        if ($request->has('applicant'))
            $interview = $this->interviewRepository->find($request->interview_id);
        $interviewScheduleData = [
            'interview_id' => $interview->id,
            'interview_date' => $request->interview_date
        ];
        $interviewSchedule = InterviewSchedule::create($interviewScheduleData);
        $data = $request->all();
        $data['interview_schedule_id'] = $interviewSchedule->id;
        $this->interviewApplicantRepository->store($data);
        alert()->success('added Successfully');
        return redirect()->route('interview.initiate', $interview->uuid);
    }

    public function addPanelist(Request $request)
    {
        $panelists = $request->panelist_id;
        $interview_id = $request->interview_id;
        foreach ($panelists as $panelist) {
            InterviewPanelist::create([
                'interview_id' => $interview_id,
                'user_id' => $panelist
            ]);
        }
        $interview = $this->interviewRepository->find($request->interview_id);
        return redirect()->route('interview.initiate', $interview->uuid);
    }


    /*public function notifyApplicant(Request $request)
    {
        $interview = $this->interviewRepository->find($request->interview_id);
        $interview->update(['technical_staff'=> $request->technical_staff]);
        $selectedApplicant = $this->hrHireApplicantRepository->getSelected($interview)->get();
        $panelist = InterviewPanelist::select([
                DB::raw("CONCAT_WS(' ',users.first_name,users.last_name) as full_name"),
                DB::raw("users.email"),
            ])
            ->join('users', 'users.id', 'hr_interview_panelists.user_id')
            where('interview_id', $interview->id)->chunk(2, function($rows){
                foreach ($rows as $row){
                    dd(User::find($row->user_id)->notify(new InterviewCallNotification()));
                }
        });*/

    public function notifyApplicant(Request $request)
    {
        $interview = $this->interviewRepository->find($request->interview_id);
        $selectedApplicant = $this->hrHireApplicantRepository->getSelected($interview)->get();
        InterviewPanelist::where('user_id',$request->technical_staff)->update(['technical_staff'=> 1]);
        //dd($selectedApplicant);
        foreach ($selectedApplicant as $applicant) {
            IntervieweeEmailJob::dispatch($applicant,$interview);
        }


        $panelist = InterviewPanelist::where('interview_id', $interview->id)->chunk(1, function ($rows) use ($interview) {
            foreach ($rows as $row) {

                InterviewEmailJob::dispatch(User::find($row->user_id),$interview);
            }
        });
        alert()->success('added Successfully');
        return redirect()->back()->with('message','submited');
    }

    public function applicantlist(Interview $interview)
    {

        $applicants = $this->hrHireApplicantRepository->getSelected($interview)
            ->where('hr_interview_applicants.is_scored', 0)
            ->get();
        $questions =  $this->interviewQuestionRepository->query()
            ->where('interview_id', $interview->id)->get();
        return view('HumanResource.Interview.interview_question_marks.index')
            ->with('applicants', $applicants)
            ->with('questions', $questions)
            ->with('interview', $interview);
    }

    public function showPanelistJobs()
    {
        return view('HumanResource.Interview.job.applications');
    }
}
