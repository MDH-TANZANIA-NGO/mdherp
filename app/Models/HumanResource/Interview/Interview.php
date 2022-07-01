<?php

namespace App\Models\HumanResource\Interview;
use App\Models\BaseModel;
use App\Models\HumanResource\HireRequisition\HireRequisitionJob;


class Interview extends BaseModel
{
    protected $table = 'hr_interviews';

    public function questions(){
        return $this->hasManyThrough(Question::class,InterviewQuestion::class);
    }
    public function interviewType(){
        return $this->belongsTo(InterviewTypes::class,'interview_type_id', 'id');
    }

    public function jobRequisition(){
        return $this->belongsTo(HireRequisitionJob::class, 'hr_requisition_job_id', 'id');
    }

    public function InterviewSchedules(){
        return $this->hasMany(InterviewSchedule::class,'interview_id','id');
    }
}
