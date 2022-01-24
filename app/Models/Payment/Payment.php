<?php

namespace App\Models\Payment;

use App\Models\Auth\User;
use App\Models\BaseModel;
use App\Models\Workflow\WfTrack;
use Illuminate\Database\Eloquent\Model;

class Payment extends BaseModel
{
    //
    public function wfTracks()
    {
        return $this->morphMany(WfTrack::class, 'resource');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
