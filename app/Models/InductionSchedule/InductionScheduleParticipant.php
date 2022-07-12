<?php

namespace App\Models\InductionSchedule;

use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Model;

class InductionScheduleParticipant extends Model
{
    protected $guarded = [];

    public function inductionSchedule(){
        return $this->belongsTo(InductionSchedule::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
