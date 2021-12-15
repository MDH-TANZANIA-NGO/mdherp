<?php

namespace App\Models\Requisition\Training\Traits\Relationship;

use App\Models\Requisition\Training\requisition_training;
use App\Models\Requisition\Training\requisition_training_cost;
use App\Models\Requisition\Travelling\requisition_travelling_cost;
use App\Models\System\District;
use Illuminate\Database\Eloquent\Model;

trait RequisitionTrainingCostDistrictRelationship

{

    public function trainingItemCost(){

        return $this->belongsTo(requisition_training_cost::class,'requisition_training_cost_id','id');
    }
    public function district()
    {
        return $this->belongsTo(District::class);
    }

}
