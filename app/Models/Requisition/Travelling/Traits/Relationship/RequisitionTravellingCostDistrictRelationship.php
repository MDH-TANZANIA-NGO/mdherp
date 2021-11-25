<?php

namespace App\Models\Requisition\Travelling\Traits\Relationship;

use App\Models\Requisition\Travelling\requisition_travelling_cost;
use App\Models\System\District;
use Illuminate\Database\Eloquent\Model;

trait RequisitionTravellingCostDistrictRelationship {

    public function trainingItemCost(){

        return $this->belongsTo(requisition_travelling_cost::class,'requisition_training_cost_id','id');
    }
    public function district()
    {
        return $this->belongsTo(District::class);
    }
}
