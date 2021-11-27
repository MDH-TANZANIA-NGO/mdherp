<?php

namespace App\Models\Requisition\Training\Traits\Relationship;

use App\Models\Requisition\Requisition;
use App\Models\System\District;
use Illuminate\Database\Eloquent\Model;

trait RequisitionTrainingCostRelationship {
    public function requisition()
    {
        return $this->belongsTo(Requisition::class);
    }

    public function districts()
    {
        return $this->belongsToMany(District::class, 'requisition_item_districts')->withTimestamps();
    }


}
