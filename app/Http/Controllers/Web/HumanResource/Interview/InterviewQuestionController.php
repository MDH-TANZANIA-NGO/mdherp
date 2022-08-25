<?php
namespace App\Http\Controllers\Web\HumanResource\Interview;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use App\Repositories\Access\UserRepository;
use App\Models\HumanResource\Interview\Question;
use App\Repositories\Unit\DesignationRepository;
use App\Models\HumanResource\Interview\Interview;
use App\Models\HumanResource\Interview\InterviewTypes;
use App\Models\HumanResource\Interview\InterviewPanelist;
use App\Models\HumanResource\Interview\InterviewQuestion;
use App\Models\HumanResource\Interview\InterviewPanelistMarks;
use App\Models\HumanResource\Interview\InterviewApplicantMarks;
use App\Models\HumanResource\Interview\InterviewPanelistCounter;
use App\Models\HumanResource\Interview\InterviewSchedule;
use App\Repositories\HumanResource\Interview\InterviewRepository;
use App\Repositories\HumanResource\Interview\InterviewQuestionRepository;
use App\Repositories\HumanResource\Interview\InterviewApplicantRepository;
use App\Repositories\HumanResource\HireRequisition\HrHireApplicantRepository;
use App\Repositories\HumanResource\Interview\InterviewQuestionMarksRepository;
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

        $total_questions_marks = $this->interviewQuestionRepository->query()->where('interview_id',$request->interview_id)->sum('marks');
        $marks = $total_questions_marks + $request->marks;
       
        if($marks > 100 ){
            throw new GeneralException('Total Marks Cannot Exceed 100');
        }
        $this->interviewQuestionRepository->store($request->all());      
        $interview = $this->interviewRepository->find($request->interview_id);
        $interview->update(['has_questions'=>1]);
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
        $questions = $this->interviewQuestionRepository->query()->where('interview_id',$interview->id)->get();
        $hrHireRequisitionJob = $this->hireRequisitionJobRepository->query()->with('designation')->where('hr_hire_requisitions_jobs.id', $interview->hr_requisition_job_id)
                                ->first();                
        $interview_type = InterviewTypes::find($interview->interview_type_id);
        $interview_date = InterviewSchedule::select(DB::raw("DATE(interview_date) as interview_date"))->where('interview_id',$interview->id)->get()->implode('interview_date',',');
        $job_title = $this->designationRepository->getQueryDesignationUnit()->where('designations.id', $hrHireRequisitionJob->designation_id)
                    ->first(); 
        return view('HumanResource.Interview.question')
                ->with('job_title',$job_title)
                ->with('interview_type',$interview_type)
                ->with('interview_date',$interview_date)
                ->with('questions',$questions)
                ->with('interview',$interview);
    }

    public function destroy(InterviewQuestion $uuid){
        $uuid->delete();
        alert()->success('initiated Successfully');
        return redirect()->back();
    }


    public function addQuestionMarks(Interview $interview){
        $interview_type = InterviewTypes::find($interview->interview_type_id);;

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
                    ->where('interview_id',$interview->id)
                    ->get();
        return view('HumanResource.Interview.question_marks')
                ->with('questions',$questions)
                ->with('job_title',$job_title)
                ->with('interview_type',$interview_type)
                ->with('interview',$interview);
    }
    public function storeMarks(Request $request){
        $total_questions = $request->total_questions;
        $interview_id = $request->interview_id;
        $interview = $this->interviewRepository->find($interview_id);
        $applicant_id = $request->applicant_id;
        // $total_panelist = InterviewPanelistCounter::where('interview_id',$interview_id)->first();
        $total_panelist  = InterviewPanelistMarks::where('interview_id', $interview_id)->where('applicant_id', $applicant_id)->count();  
        $total_panelist = $total_panelist + 1;
        $input['applicant_id'] = $request->applicant_id;
        try{
            DB::beginTransaction();
                $this->interviewQuestionMarksRepository->query()->where('interview_id',$interview_id)->where('applicant_id',$applicant_id)->delete();
                $total_marks = 0;
                for($i=1; $i<=$total_questions; $i++){
                    $question = $request->input('question'.$i);
                    $marks = $request->input('marks'.$i);
                    $input['interview_id'] = $interview_id;
                    $input['interview_question_id'] = $question;
                    $input['panelist_id'] = access()->id();
                    $input['marks']  = $marks;
                    $this->interviewQuestionMarksRepository->store($input);
                    $total_marks +=  $marks;
                }
                InterviewPanelistMarks::where('interview_id', $interview_id)->where('panelist_id', access()->id())->where('applicant_id', $applicant_id)->delete();                             
                InterviewPanelistMarks::create([
                    'interview_id'=> $interview_id,
                    'panelist_id'=> access()->id(),
                    'marks'=> $total_marks,
                    'applicant_id' => $applicant_id,
                ]);
                $total_panelist_marks = InterviewPanelistMarks::where('interview_id', $interview_id)->where('applicant_id', $applicant_id)->sum('marks');
                $interviewApplicantMarks = InterviewApplicantMarks::where('interview_id', $interview_id)->where('applicant_id',$applicant_id)->first();
                if(!is_null($interviewApplicantMarks)){
                    $total = ($total_panelist_marks / $total_panelist);
                    $interviewApplicantMarks->update(['marks'=>$total]);   
                }else{
                    $total = ($total_panelist_marks / $total_panelist);
                    InterviewApplicantMarks::create(['interview_id'=> $interview_id,
                    'marks'=> $total,
                    'applicant_id' => $applicant_id]);
                }              
                $this->interviewApplicantRepository->query()
                ->where('applicant_id', $applicant_id)
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
