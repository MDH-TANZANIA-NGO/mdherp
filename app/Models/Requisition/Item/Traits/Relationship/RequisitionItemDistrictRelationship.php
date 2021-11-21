<?php

namespace App\Models\Requisition\Item\Traits\Relationship;

use App\Models\Requisition\Item\RequisitionItem;
use App\Models\System\District;

trait RequisitionItemDistrictRelationship
{
    public function item()
    {
        return $this->belongsTo(RequisitionItem::class,'requisition_item_id','id');
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }
}
