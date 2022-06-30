<?php

namespace App\Models\HumanResource\Interview;
use App\Models\BaseModel;

class InterviewSchedule extends BaseModel
{
    protected $table  = 'hr_interview_schedules';

    public function applicants(){
        return $this->hasMany(InterviewApplicant::class,'interview_id','id');
    }
    public function interview(){
        return $this->belongsTo(Interview::class,'interview_id','id');
    }
}
