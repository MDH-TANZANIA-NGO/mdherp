<?php

namespace App\Models\HumanResource\Interview;
use App\Models\BaseModel;
use App\Models\JobOffer\JobOffer;
use App\Models\HumanResource\HireRequisition\HrHireApplicant;

class InterviewReportRecommendation extends BaseModel
{
    protected $table = 'hr_interview_report_recommendations';

    public function jobOffer()
    {
        return $this->hasOne(JobOffer::class, 'hr_interview_applicant_id', 'id');
    }
    public function applicant()
    {
        return $this->belongsTo(HrHireApplicant::class,'applicant_id', 'id');
    }
  
}
