<?php

namespace App\Models\Leave;

use App\Models\BaseModel;

class LeaveBalance extends BaseModel
{
    //
    public function leaveType()
    {
        return $this->belongsTo(LeaveType::class, 'leave_id', 'id');
    }
}
