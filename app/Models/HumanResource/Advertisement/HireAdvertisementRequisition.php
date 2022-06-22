<?php

namespace App\Models\HumanResource\Advertisement;

use App\Models\Auth\User;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;
use App\Models\Workflow\WfTrack;

class HireAdvertisementRequisition extends BaseModel
{
    protected $table = 'hr_hire_advertisement_requisitions';
    public function getResourceNameAttribute()
    {
        return "<b>".$this->number."</b> <br>".
            $this->user->full_name_formatted."<br>".
            $this->user->designation_title;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function wfTracks()
    {
        return $this->morphMany(WfTrack::class, 'resource');
    }

}
