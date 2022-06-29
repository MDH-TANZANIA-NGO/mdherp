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

class InterviewController extends Controller
{

    public $designationRepository;
    public $interviewRepository;
    public $interviewApplicantRepository;
    public $hrHireApplicantRepository;
    public $userRepository;

    use InterviewDatatable;
    public function __construct()
    {
        $this->designationRepository = (New DesignationRepository());
        $this->interviewRepository = (New InterviewRepository());
        $this->interviewApplicantRepository = (New InterviewApplicantRepository());
        $this->hrHireApplicantRepository = (New HrHireApplicantRepository());
        $this->userRepository = (New UserRepository());

    } 

    public function index(){
         
    }


    public function create(){
        $designations = $this->designationRepository->getActiveForSelect();
        $interview_types = InterviewTypes::get() ->pluck('name', 'id');
        return view('HumanResource.Interview.create')
                ->with('designations',$designations)
                ->with('interview_types',$interview_types);
    }
    public function store(Request $request){
        $interview = $this->interviewRepository->store($request->all());
        
        alert()->success('initiated Successfully');
        return redirect()->route('interview.initiate',$interview->uuid);
               

    }

    public function initiate(Interview $interview){
        $users = $this->userRepository->forSelect();
        $schedules = InterviewSchedule::where('interview_id',$interview->id)->get()->pluck('id');
        $interviewApplicants = 0;
        if(count($schedules ))
            $interviewApplicants = $this->hrHireApplicantRepository->getSelected($interview->id)->get();
            return view('HumanResource.Interview.saved')
                ->with('interview',$interview)
                ->with('interviewApplicants',$interviewApplicants)
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
}
