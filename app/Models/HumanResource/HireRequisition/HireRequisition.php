<?php

namespace App\Models\HumanResource\HireRequisition;

use App\Models\Auth\User;
use App\Models\BaseModel;
use App\Models\System\CodeValue;
use App\Models\Unit\Department;
use App\Models\Workflow\WfTrack;
use App\Models\HumanResource\HireRequisition\HireRequisitionWorkingTool;
use App\Models\System\WorkingTool;

class HireRequisition extends BaseModel
{
    protected $table= 'hr_hire_requisitions';
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function workingTools(){
        return $this->hasMany(HireRequisitionWorkingTool::class);
    }

    public function wfTracks()
    {
        return $this->morphMany(WfTrack::class, 'resource');
    }

    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function employment(){
        return $this->belongsTo(CodeValue::class, 'employment_condition_cv_id');
    }

    public function getResourceNameAttribute()
    {
        return "<b>".$this->id."</b> <br>".
            $this->user->full_name_formatted."<br>".
            $this->user->designation_title;
    }
}
