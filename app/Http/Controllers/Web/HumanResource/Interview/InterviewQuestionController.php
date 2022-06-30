<?php
namespace App\Http\Controllers\Web\HumanResource\Interview;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Access\UserRepository;
use App\Models\HumanResource\Interview\Question;
use App\Repositories\Unit\DesignationRepository;
use App\Models\HumanResource\Interview\Interview;
use App\Models\HumanResource\Interview\InterviewQuestion;
use App\Repositories\HumanResource\Interview\InterviewRepository;
use App\Repositories\HumanResource\Interview\InterviewQuestionRepository;
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

    public function store(Request $request){

        $this->interviewQuestionRepository->store($request->all());
        $interview = $this->interviewRepository->find($request->interview_id);
        alert()->success('initiated Successfully');
        return redirect()->route('interview.question.create',$interview->uuid); 
    }
    public function update(Request $request){
        $question = $this->interviewQuestionRepository->find($request->question_id);
        $question->update($request->all());
        $interview = $this->interviewRepository->find($request->interview_id);
        alert()->success('initiated Successfully');
        return redirect()->route('interview.question.create',$interview->uuid); 
    }

    public function create(Interview $interview){
        $questions = $this->interviewQuestionRepository
                    ->query()
                    ->where('interview_id',$interview->id)
                    ->get();
        return view('HumanResource.Interview.question')
                ->with('questions',$questions)
                ->with('interview',$interview);               
    }

    public function destroy(InterviewQuestion $uuid){
        $question = $this->interviewQuestionRepository->find($request->question_id);
        $question->update($request->all());
        $interview = $this->interviewRepository->find($request->interview_id);
        alert()->success('initiated Successfully');
        return redirect()->route('interview.question.create',$interview->uuid); 
    }


    public function addQuestionMarks(Interview $interview){
        $questions = $this->interviewQuestionRepository
                    ->query()
                    ->where('interview_id',$interview->id)
                    ->get();
        return view('HumanResource.Interview.question_marks')
                ->with('questions',$questions)
                ->with('interview',$interview);   
    }
    public function storeMarks(Request $request){
        $questions = $this->interviewQuestionRepository
                    ->query()
                    ->where('interview_id',$interview->id)
                    ->get();

        return view('HumanResource.Interview.question_marks')
            ->with('questions',$questions)
            ->with('interview',$interview);   
    }


    
}
