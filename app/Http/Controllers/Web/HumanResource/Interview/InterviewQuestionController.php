<?php
namespace App\Http\Controllers\Web\HumanResource\Interview;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Access\UserRepository;
use App\Repositories\Unit\DesignationRepository;
use App\Repositories\HumanResource\Interview\InterviewRepository;
use App\Repositories\HumanResource\Interview\InterviewApplicantRepository;
use App\Repositories\HumanResource\HireRequisition\HrHireApplicantRepository;
use App\Repositories\HumanResource\HireRequisition\HireRequisitionJobRepository;

class InterviewQuestionController extends Controller
{
    public $designationRepository;
    public $interviewRepository;
    public $interviewApplicantRepository;
    public $hrHireApplicantRepository;
    public $userRepository;
    public $hireRequisitionJobRepository;
    public $interviewQuestionRepository;
    public function __construct()
    {
        $this->designationRepository = (New DesignationRepository());
        $this->interviewRepository = (New InterviewRepository());
        $this->interviewApplicantRepository = (New InterviewApplicantRepository());
        $this->hrHireApplicantRepository = (New HrHireApplicantRepository());
        $this->userRepository = (New UserRepository());
        $this->hireRequisitionJobRepository = (New HireRequisitionJobRepository());
        $this->interviewQuestionRepository = (New InterviewQuestionRepository());
    }


    public function index(){

    }

    public function store(Request $request,$uuid){

        $this->interviewQuestionRepository->store($request->all());
        $interview = $this->interviewRepository->find($request->interview_id);
        alert()->success('initiated Successfully');
        return redirect()->route('interview.question.create',$uuid); 
    }

    public function create(){
        return view('HumanResource.Interview.question');
        // ->with('interview',$interview)
        // ->with('hrHireRequisitionJob',$hrHireRequisitionJob )
        // ->with('users',$users);
    }
}
