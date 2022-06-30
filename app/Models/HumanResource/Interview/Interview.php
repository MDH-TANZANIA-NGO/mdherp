<?php

namespace App\Models\HumanResource\Interview;
use App\Models\BaseModel;


class Interview extends BaseModel
{
    protected $table = 'hr_interviews';

    public function questions(){
        return $this->hasManyThrough(Questions::class,InterviewQuestion::class);
    }
    public function interviewType(){
        return $this->belongsTo(InterviewType::class,'interview_type_id');
    }
    public function InterviewSchedules(){
        return $this->hasMany(InterviewSchedule::class,'interview_id','id');
    }
}
