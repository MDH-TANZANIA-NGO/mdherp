<?php

namespace App\Models\Requisition;

use Illuminate\Database\Eloquent\Model;

class RequisitionFundChecker extends Model
{
    //
    protected $guarded=[];

    public function requisition()
    {
        return $this->belongsTo(Requisition::class);
    }
}
