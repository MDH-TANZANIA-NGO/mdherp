<?php

namespace App\Models\JobOffer;

use App\Models\Auth\User;
use App\Models\BaseModel;
use App\Models\HumanResource\Interview\InterviewApplicant;
use App\Models\HumanResource\Interview\InterviewReportRecommendation;
use App\Models\JobOffer\Traits\JobOfferAttribute;
use App\Models\Project\Project;
use App\Models\Workflow\WfTrack;
use Illuminate\Database\Eloquent\Model;

class JobOffer extends BaseModel
{
    use JobOfferAttribute;
    //

    public function interviewApplicant()
    {
        return $this->belongsTo(InterviewReportRecommendation::class ,'hr_interview_applicant_id', 'id');
    }
    
    /**
     * @return mixed
     */
    public function wfTracks()
    {
        return $this->morphMany(WfTrack::class, 'resource');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }
    public function remarks()
    {
        return $this->hasMany(JobOfferRemark::class);
    }
}
