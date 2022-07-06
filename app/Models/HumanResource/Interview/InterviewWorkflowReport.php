<?php

namespace App\Models\HumanResource\Interview;
use App\Models\BaseModel;
use App\Models\HumanResource\HireRequisition\HireRequisitionJob;


class InterviewWorkflowReport extends BaseModel
{
    protected $table = 'hr_interview_workflow_reports';
    public function getResourceNameAttribute()
    {
        return "<b>".$this->number."</b> <br>".
            $this->type->title."<br>".
            $this->user->full_name_formatted."<br>".
            $this->user->designation_title;
    }

    public function wfTracks()
    {
        return $this->morphMany(WfTrack::class, 'resource');
    }
    

    public function objectives()
    {
        return $this->hasMany(PrObjective::class)->orderBy('id');
    }

    public function attributeRates()
    {
        return $this->hasMany(PrAttributeRate::class)->orderBy('pr_rate_scale_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
