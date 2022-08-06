<?php

namespace App\Models\HumanResource\Interview;
use App\Models\BaseModel;
use App\Models\HumanResource\HireRequisition\HrHireApplicant;
use App\Models\JobOffer\JobOffer;

class InterviewApplicant extends BaseModel
{
    public $table = 'hr_interview_applicants';

    public function interviews(){
        return $this->belongsTo(Interview::class,'interview_id');
    }
    public function schedules(){
        return $this->belongsTo(InterviewSchedule::class,'interview_schedule_id', 'id');
    }

    public function applicant()
    {
        return $this->belongsTo(HrHireApplicant::class,'applicant_id', 'id');
    }

    public function jobOffer()
    {
        return $this->hasOne(JobOffer::class, 'hr_interview_applicant_id', 'id');
    }

}
