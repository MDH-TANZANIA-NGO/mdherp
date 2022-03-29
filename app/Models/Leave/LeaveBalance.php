<?php

namespace App\Models\Leave;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class LeaveBalance extends Model
{
    //
    public function leaveType()
    {
        return $this->belongsTo(LeaveType::class);
    }
}
