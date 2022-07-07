<?php

namespace App\Models\InductionSchedule;

use App\Models\Unit\Department;
use Illuminate\Database\Eloquent\Model;

class InductionScheduleItem extends Model
{
    protected $guarded = [];
    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function inductionSchedule(){
        return $this->belongsTo(InductionSchedule::class);
    }
}
