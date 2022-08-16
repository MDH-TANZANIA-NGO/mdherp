<?php

namespace App\Models\Leave;

use App\Models\Auth\User;
use App\Models\BaseModel;
use App\Models\System\Region;
use App\Models\Workflow\WfTrack;

class Leave extends BaseModel
{
    /**
     * @return mixed
     */
    public function wfTracks()
    {
        return $this->morphMany(WfTrack::class, 'resource');
    }

    public function user()
    {

        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function employee() {

        return $this->belongsTo(User::class, 'employee_id','id');

    }

    public function type()
    {
        return $this->belongsTo(LeaveType::class, 'leave_type_id', 'id');
    }

    public function balance()
    {
        return $this->belongsTo(LeaveBalance::class, 'leave_balance');
    }

    public function getResourceNameAttribute()
    {
        return "<b>".$this->id."</b> <br>".
            $this->user->full_name_formatted."<br>".
            $this->user->designation_title;
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function getRemainingDays(){
        $balance = LeaveBalance::where('leave_type_id', $this->leave_type_id)
            ->where('user_id', $this->user_id)
            ->first();
        return $balance->remaining_days;
    }

}
