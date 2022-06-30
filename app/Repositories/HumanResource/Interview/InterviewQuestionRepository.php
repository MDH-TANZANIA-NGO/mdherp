<?php

namespace App\Repositories\HumanResource\Interview;

use App\Exceptions\GeneralException;
use App\Models\Auth\User;
use App\Models\Budget\FiscalYear;
use App\Models\HumanResource\Interview\Interview;
use App\Models\HumanResource\Interview\InterviewQuestion;
use App\Models\HumanResource\Interview\Question;
use App\Notifications\Workflow\WorkflowNotification;
use App\Repositories\BaseRepository;
use App\Services\Generator\Number;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use League\Flysystem\Plugin\PluggableTrait;

class InterviewQuestionRepository extends BaseRepository
{
    const MODEL = InterviewQuestion::class;

    use Number;

    public function getQuery()
    {
        return $this->query()->select([

            'hr_interview_questions.interview_id AS interview_id',
            'hr_interview_questions.id AS id',
            'hr_question.question AS question',
        ])
            ->join('hr_question', 'hr_question.id', 'hr_interview_questions.question_id')
            ->join('hr_interview', 'hr_interview.id', 'hr_interview_questions.interview_id')
    }


    public function getAll()
    {
        return $this->getQuery()->get();
    }


    public function store($input){
         
        $question = Question::create($input);
        $question_id = $question->id;
        $input['question_id'] = $question_id;
        $input['interview_id'] = $question_id;
        $this->query()->create($input);
    }
   
}
