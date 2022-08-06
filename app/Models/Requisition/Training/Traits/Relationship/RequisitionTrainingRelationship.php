<?php

namespace App\Models\Requisition\Training\Traits\Relationship;

use App\Models\ProgramActivity\ProgramActivity;
use App\Models\Requisition\Requisition;
use App\Models\Requisition\Training\requisition_training;
use App\Models\Requisition\Training\requisition_training_cost;
use App\Models\Requisition\Training\requisition_training_item;
use App\Models\System\District;

trait RequisitionTrainingRelationship
{
    public function trainingCost()
    {
        return $this->hasMany(requisition_training_cost::class);
    }
    public function trainingItems()
    {
        return $this->hasMany(requisition_training_item::class);
    }
    public function programActivity()
    {
        return $this->hasOne(ProgramActivity::class);
    }
    public function requisition()
    {
        return $this->hasOne(Requisition::class);
    }
    public function district()
    {
        return $this->belongsTo(District::class);
    }



}

