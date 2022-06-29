<?php

namespace App\Models\HumanResource\Interview;

use Illuminate\Database\Eloquent\Model;

class InterviewApplicant extends Model
{
    public $table = 'hr_interview_applicants';

    public function interview(){
        return $this->belongsTo(Interview::class,'interview_id');
    }
}
