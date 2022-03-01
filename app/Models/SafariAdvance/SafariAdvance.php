<?php

namespace App\Models\SafariAdvance;

use App\Models\BaseModel;
use App\Models\Requisition\Travelling\requisition_travelling_cost;
use App\Models\Requisition\Travelling\travelling_cost;
use App\Models\SafariAdvance\Traits\SafariAdvanceAttribute;
use App\Models\SafariAdvance\Traits\SafariAdvanceRelationship;
use Illuminate\Database\Eloquent\Model;

class SafariAdvance extends BaseModel
{
    //
use  SafariAdvanceRelationship, SafariAdvanceAttribute;

public function safariAdvancePayment(){
    return $this->hasOne(SafariAdvancePayment::class);
}
}
