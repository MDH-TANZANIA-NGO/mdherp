<?php

namespace App\Models\InductionSchedule;

use App\Models\BaseModel;
use App\Models\Unit\Designation;
use Illuminate\Database\Eloquent\Model;

class InductionSchedule extends BaseModel
{
    public function designation(){
        return $this->belongsTo(Designation::class);
    }
}
