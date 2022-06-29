<?php

namespace App\Models\HumanResource\Interview;
use App\Models\BaseModel;
class InterviewApplicant extends BaseModel
{
    public $table = 'hr_interview_applicants';

    public function interview(){
        return $this->belongsTo(Interview::class,'interview_id');
    }
}
