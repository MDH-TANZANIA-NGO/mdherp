<?php

namespace App\Models\ProgramActivity;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class ProgramActivityPayment extends BaseModel
{
    //
public function activityReport()
{
    return $this->belongsTo(ProgramActivityReport::class, 'program_activity_report_id','id');
}

}
