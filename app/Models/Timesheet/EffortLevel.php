<?php

namespace App\Models\Timesheet;

use App\Models\Auth\User;
use App\Models\Project\Project;
use Illuminate\Database\Eloquent\Model;

class EffortLevel extends Model
{
    protected $guarded = ['id'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function projects(){
        return $this->belongsTo(Project::class);
    }
}
