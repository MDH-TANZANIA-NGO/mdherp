<?php

namespace App\Models\Requisition\Travelling\Traits\Relationship;

use App\Models\Auth\User;
use App\Models\MdhRates\mdh_rate;
use App\Models\Requisition\Requisition;
use App\Models\Requisition\Travelling\requisition_travelling_cost_district;
use App\Models\SafariAdvance\SafariAdvance;
use App\Models\System\District;

use App\SafariAdvanceDetails;
use Illuminate\Database\Eloquent\Model;

trait RequisitionTravellingCostRelationship {

    public function requisition()
    {
        return $this->belongsTo(Requisition::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, "traveller_uid", 'id');
    }

    public function mdhRate()
    {
        return $this->belongsTo(mdh_rate::class,'perdiem_rate_id','id');
    }
    public function safariAdvance()
    {
        return $this->hasOne(SafariAdvance::class);
    }

    public function trips()
    {
        return $this->hasMany(requisition_travelling_cost_district::class);
    }


}
