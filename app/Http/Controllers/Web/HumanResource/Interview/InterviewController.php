<?php
namespace App\Http\Controllers\Web\HumanResource\Interview;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Access\UserRepository;
use App\Repositories\Unit\DesignationRepository;
use App\Models\HumanResource\Interview\Interview;
use App\Models\HumanResource\Interview\InterviewTypes;
use App\Models\HumanResource\Interview\InterviewSchedule;
use App\Repositories\HumanResource\Interview\InterviewRepository;
use App\Repositories\HumanResource\Interview\InterviewApplicantRepository;
use App\Repositories\HumanResource\HireRequisition\HrHireApplicantRepository;
use  App\Http\Controllers\Web\HumanResource\Interview\Traits\InterviewDatatable;
use App\Models\HumanResource\Interview\InterviewPanelist;
use App\Repositories\HumanResource\HireRequisition\HrHireRequisitionJobShortlistRepository;
use App\Repositories\HumanResource\HireRequisition\HireRequisitionJobRepository;

class InterviewController extends Controller
{
    public $designationRepository;
    public $interviewRepository;
    public $interviewApplicantRepository;
    public $hrHireApplicantRepository;
    public $userRepository;
    public $hireRequisitionJobRepository;

    use InterviewDatatable;
    public function __construct()
    {
        $this->designationRepository = (New DesignationRepository());
        $this->interviewRepository = (New InterviewRepository());
        $this->interviewApplicantRepository = (New InterviewApplicantRepository());
        $this->hrHireApplicantRepository = (New HrHireApplicantRepository());
        $this->userRepository = (New UserRepository());
        $this->hireRequisitionJobRepository = (New HireRequisitionJobRepository());
    } 

    public function index(){
         
    }

    public function create(){
        $designations = $this->designationRepository->getActiveAdvertisedForSelect();
        $interview_types = InterviewTypes::get() ->pluck('name', 'id');
        return view('HumanResource.Interview.create')
                ->with('designations',$designations)
                ->with('interview_types',$interview_types);
    }
    public function store(Request $request){
        $interview = $this->interviewRepository->store($request->all());
        alert()->success('initiated Successfully');
        return redirect()->route('interview.initiate-panelist',$interview->uuid);          
    }

    public function initiate(Interview $interview){
        $users = $this->userRepository->forSelect();
        $schedules = InterviewSchedule::where('interview_id',$interview->id)->get()->pluck('id');
        $interviewApplicants = $this->hrHireApplicantRepository->getPendingSelected($interview)->get();
         
        $hrHireRequisitionJob = $this->hireRequisitionJobRepository
                                ->query()
                                ->with('designation')
                                // ->with('unit')
                                ->where('hr_hire_requisitions_jobs.id',$interview->hr_requisition_job_id)
                                ->first();
        return view('HumanResource.Interview.saved')
            ->with('interview',$interview)
            ->with('schedules',$schedules )
            ->with('interviewApplicants',$interviewApplicants )
            ->with('hrHireRequisitionJob',$hrHireRequisitionJob )
            ->with('users',$users);
    }
    public function initiatePanelist(Interview $interview){
        $users = $this->userRepository->forSelect();
        $schedules = InterviewSchedule::where('interview_id',$interview->id)->get()->pluck('id');
        $interviewApplicants = $this->hrHireApplicantRepository->getPendingSelected($interview)->get();
         
        $hrHireRequisitionJob = $this->hireRequisitionJobRepository
                                ->query()
                                ->with('designation')
                                ->where('hr_hire_requisitions_jobs.id',$interview->hr_requisition_job_id)
                                ->first();
        return view('HumanResource.Interview.panelist')
            ->with('interview',$interview)
            ->with('hrHireRequisitionJob',$hrHireRequisitionJob )
            ->with('users',$users);
    }


    public function addapplicant(Request $request){
        if($request->has('applicant'))
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
            return redirect()->route('interview.initiate',$interview->uuid);
        return redirect()->back();
    }
    public function addPanelist(Request $request){
        $panelists = $request->panelist_id;
        $interview_id = $request->interview_id;
        foreach($panelists as $panelist){
            InterviewPanelist::create([
                'interview_id'=> $interview_id,
                'user_id' => $panelist
            ]);
        }
        $interview = $this->interviewRepository->find($request->interview_id);
        return redirect()->route('interview.initiate',$interview->uuid); 
    }


    public function notifyApplicant(Request $request){
        $interview = $this->interviewRepository->find($request->interview_id);
        $selectedApplicant = $this->hrHireApplicantRepository->getSelected($interview)->get();
        $panelist          = InterviewPanelist::select([
                                \DB::raw("CONCAT_WS(' ',users.first_name,users.last_name) as full_name"),
                                \DB::raw("users.email"),
                            ])
                            ->join('users','users.id','hr_interview_panelists.user_id')
                            ->where('interview_id',$interview->id)->get();
        return $selectedApplicant;
        return redirect()->route('interview.question.create',$interview->uuid);
    }
   
 
}
