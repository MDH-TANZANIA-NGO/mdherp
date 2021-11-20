<?php

namespace App\Models\Requisition\Item\Traits\Relationship;

use App\Models\Requisition\Item\RequisitionItemDistrict;
use App\Models\Requisition\Requisition;
use App\Models\System\District;

trait RequisitionItemRelationship
{
    public function requisition()
    {
        return $this->belongsTo(Requisition::class);
    }

    public function districts()
    {
        return $this->belongsToMany(District::class, 'requisition_item_districts')->withTimestamps();
    }

}
