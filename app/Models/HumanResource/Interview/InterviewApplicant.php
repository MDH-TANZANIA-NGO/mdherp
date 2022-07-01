<?php

namespace App\Models\HumanResource\Interview;
use App\Models\BaseModel;
class InterviewApplicant extends BaseModel
{
    public $table = 'hr_interview_applicants';

    public function interviews(){
        return $this->hasMany(Interview::class,'interview_id');
    }
    public function schedules(){
        return $this->belongsTo(InterviewSchedule::class,'');
    }

}
