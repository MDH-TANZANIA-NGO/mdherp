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

class QuestionController extends Controller
{
    public $designationRepository;
    public $interviewRepository;
    public $interviewApplicantRepository;
    public $hrHireApplicantRepository;
    public $userRepository;
    public $hireRequisitionJobRepository;
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

    public function store(Request $request){
        $panelists = $request->panelist_id;
        $interview_id = $request->interview_id;
        
        $interview = $this->interviewRepository->find($request->interview_id);
        return redirect()->route('interview.initiate',$interview->uuid); 
    }

    public function create(){

    }
}
