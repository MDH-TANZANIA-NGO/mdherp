<?php

namespace App\Models\ProgramActivity\Traits;

use App\Models\Requisition\Requisition;

trait ProgramActivityRelationship
{
public function requisition()
{
    return $this->belongsTo(Requisition::class);
}
}
