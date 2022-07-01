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
use App\Repositories\HumanResource\Interview\InterviewQuestionMarksRepository;
use App\Repositories\HumanResource\HireRequisition\HireRequisitionJobRepository;
use Illuminate\Support\Facades\DB;

class InterviewQuestionController extends Controller
{
    public $designationRepository;
    public $interviewRepository;
    public $interviewApplicantRepository;
    public $hrHireApplicantRepository;
    public $userRepository;
    public $hireRequisitionJobRepository;
    public $interviewQuestionRepository;
    public $interviewQuestionMarksRepository;
    public function __construct()
    {
        $this->designationRepository = (New DesignationRepository());
        $this->interviewRepository = (New InterviewRepository());
        $this->interviewApplicantRepository = (New InterviewApplicantRepository());
        $this->hrHireApplicantRepository = (New HrHireApplicantRepository());
        $this->userRepository = (New UserRepository());
        $this->hireRequisitionJobRepository = (New HireRequisitionJobRepository());
        $this->interviewQuestionRepository = (New InterviewQuestionRepository());
        $this->interviewQuestionMarksRepository = (New InterviewQuestionMarksRepository());
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
       
        $total_questions = $request->total_questions;
        $interview_id = $request->interview_id;
        $interview = $this->interviewRepository->find($interview_id);
        $input['applicant_id'] = $request->applicant_id;
        try{
            DB::beginTransaction();
                for($i=1; $i<=$total_questions; $i++){
                    $question = $request->input('question'.$i);
                    $marks = $request->input('marks'.$i);
                    $input['interview_id'] = $interview_id;
                    $input['interview_question_id'] = $question;
                    $input['panelist_id'] = access()->id();
                    $input['marks']  = $marks;
                    $this->interviewQuestionMarksRepository->store($input);
                }
                $this->interviewApplicantRepository->query()
                ->where('applicant_id',$request->applicant_id)
                ->where('interview_id',$interview_id)
                ->first()
                ->update(['is_scored'=>1]);
            DB::commit();
            alert()->success('initiated Successfully');
        } catch (\Exception $e) {
            DB::rollback();
            throw new \Exception($e->getMessage());
        }
        $questions = $this->interviewQuestionRepository
                    ->query()
                    ->where('interview_id',$interview->id)
                    ->get();

        return redirect()->route('interview.applicantlist',$interview->uuid);
    }


    
}
