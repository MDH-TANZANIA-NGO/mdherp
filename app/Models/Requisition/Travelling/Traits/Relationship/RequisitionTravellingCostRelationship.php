<?php

namespace App\Models\Requisition\Travelling\Traits\Relationship;

use App\Models\Auth\User;
use App\Models\MdhRates\mdh_rate;
use App\Models\Requisition\Requisition;
use App\Models\System\District;
use Illuminate\Database\Eloquent\Model;

trait RequisitionTravellingCostRelationship {

    public function requisition()
    {
        return $this->belongsTo(Requisition::class);
    }

    public function districts()
    {
        return $this->belongsToMany(District::class, 'requisition_travelling_cost_districts','requisition_travelling_cost_id','district_id')->withTimestamps();
    }
    public function user()
    {
        return $this->belongsTo(User::class, "traveller_uid", 'id');
    }

    public function mdhRate()
    {
        return $this->belongsTo(mdh_rate::class,'perdiem_rate_id','id');
    }
}
