<?php

namespace App\Models\ProgramActivity;

use App\Models\BaseModel;
use App\Models\GOfficer\GOfficer;
use App\Models\Requisition\Training\requisition_training_cost;
use Illuminate\Database\Eloquent\Model;

class ProgramActivityAttendance extends BaseModel
{
    //
    public function trainingCost()
    {
        return $this->belongsTo(requisition_training_cost::class,'requisition_training_cost_id', 'id');
    }
    public function programActivity()
    {
        return $this->belongsTo(ProgramActivity::class);
    }
}
