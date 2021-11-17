<?php

namespace App\Models\Requisition\RequisitionType\Traits\Relaltionship;

use App\Models\Requisition\Requisition;

trait RequisitionTypeRelationship
{
    public function requisitions()
    {
        return $this->hasMany(Requisition::class);
    }

}
