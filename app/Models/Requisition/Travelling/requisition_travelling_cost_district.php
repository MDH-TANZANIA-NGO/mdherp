<?php

namespace App\Models\Requisition\Travelling;

use App\Models\BaseModel;
use App\Models\MdhRates\mdh_rate;
use App\Models\System\District;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class requisition_travelling_cost_district extends BaseModel
{
    //
    use SoftDeletes;
    public function travellingCost()
    {
        return $this->belongsTo(requisition_travelling_cost::class);
    }
    public function district()
    {
        return $this->belongsTo(District::class);
    }
    public function mdhRate()
    {
        return $this->belongsTo(mdh_rate::class);
    }
}
