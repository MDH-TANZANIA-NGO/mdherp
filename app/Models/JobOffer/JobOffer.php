<?php

namespace App\Models\JobOffer;

use App\Models\BaseModel;
use App\Models\HumanResource\Interview\InterviewApplicant;
use Illuminate\Database\Eloquent\Model;

class JobOffer extends BaseModel
{
    //

    public function interviewApplicant()
    {
        return $this->belongsTo(InterviewApplicant::class ,'hr_hire_requisitions_job_applicants_id', 'applicant_id')
    }
}
