<?php

namespace App\Models\Requisition\Travelling\Traits\Relationship;

use App\Models\Auth\User;
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
        return $this->belongsToMany(District::class, 'requisition_item_districts')->withTimestamps();
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
