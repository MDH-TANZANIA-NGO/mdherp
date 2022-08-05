<?php

namespace App\Models\Requisition\Training;

use App\Models\BaseModel;
use App\Models\Requisition\Requisition;
use Illuminate\Database\Eloquent\Model;

class RequisitionTrainingCostFavourite extends BaseModel
{
    //
    public function requisition()
    {
        return $this->belongsTo(Requisition::class);
    }
}
