<?php

namespace App\Models\HumanResource\Interview;
use App\Models\BaseModel;
use App\Models\HumanResource\HireRequisition\HrHireApplicant;

class InterviewApplicant extends BaseModel
{
    public $table = 'hr_interview_applicants';

    public function interviews(){
        return $this->hasMany(Interview::class,'interview_id');
    }
    public function schedules(){
        return $this->belongsTo(InterviewSchedule::class,'');
    }

    public function applicant()
    {
        return $this->belongsTo(HrHireApplicant::class,'applicant_id', 'id');
    }

}
