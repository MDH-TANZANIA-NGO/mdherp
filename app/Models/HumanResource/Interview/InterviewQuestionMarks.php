<?php

namespace App\Models\HumanResource\Interview;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Console\Question\Question;
use App\Models\BaseModel;

class InterviewQuestionMarks extends BaseModel
{
    //
    protected $table = 'hr_interview_question_marks';

    public function question(){
        return $this->belongsTo(Question::class,'question_id');
    }
    public function panelist(){
        return $this->belongsTo(User::class,'panelist_id');
    }

}
