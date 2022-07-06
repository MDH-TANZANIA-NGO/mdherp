<?php

namespace App\Models\HumanResource\Interview;
use App\Models\Auth\User;
use App\Models\BaseModel;
use App\Models\Workflow\WfTrack;

class InterviewWorkflowReport extends BaseModel
{
    protected $table = 'hr_interview_workflow_reports';
    public function getResourceNameAttribute()
    {
        return "<b>".$this->number."</b> <br>".
            $this->user->full_name_formatted."<br>".
            $this->user->designation_title;
    }

    public function wfTracks()
    {
        return $this->morphMany(WfTrack::class, 'resource');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
