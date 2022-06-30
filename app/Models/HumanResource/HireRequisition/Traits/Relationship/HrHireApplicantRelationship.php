<?php

namespace App\Models\HumanResource\HireRequisition\Traits\Relationship;
use App\Models\HumanResource\Interview\InterviewApplicant;
use App\Models\HumanResource\Interview\InterviewSchedule;

trait HrHireApplicantRelationship
{
    // public function interviewSchedules(){
    //     return $this->hasManyThrough(InterviewSchedule::class,InterviewApplicant::class,'applicant_id','interview_schudule_id','id','id');
    // }

    public function interviews(){
        return $this->hasMany(InterviewApplicant::class,'applicant_id','id');
    }

    public function schedules()
    {
        return $this->hasManyThrough(InterviewSchedule::class, InterviewApplicant::class,'applicant_id','interview_id','id','id');
    }


    
}