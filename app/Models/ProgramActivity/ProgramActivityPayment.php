<?php

namespace App\Models\ProgramActivity;

use App\Models\Activities\Reports\ActivityReport;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class ProgramActivityPayment extends BaseModel
{
    //
public function activityReport()
{
    return $this->belongsTo(ActivityReport::class);
}

}
