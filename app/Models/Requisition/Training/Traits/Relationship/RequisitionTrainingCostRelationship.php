<?php

namespace App\Models\Requisition\Training\Traits\Relationship;

use App\Models\Auth\User;
use App\Models\GOfficer\GOfficer;
use App\Models\GOfficer\GRate;
use App\Models\Requisition\Requisition;
use App\Models\System\District;
use Illuminate\Database\Eloquent\Model;

trait RequisitionTrainingCostRelationship {
    public function requisition()
    {
        return $this->belongsTo(Requisition::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function user()
    {
        return $this->belongsTo(GOfficer::class,'participant_uid','id');
    }

    public function gRate()
    {
        return $this->belongsTo(GRate::class,'perdiem_rate_id', 'id');
    }



}
