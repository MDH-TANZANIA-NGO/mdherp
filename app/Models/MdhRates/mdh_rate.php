<?php

namespace App\Models\MdhRates;

use App\Models\BaseModel;
use App\Models\Requisition\Travelling\requisition_travelling_cost;
use Illuminate\Database\Eloquent\Model;

class mdh_rate extends BaseModel
{
    //
    public function travellingPerdiemAmount(){

        return $this->hasMany(requisition_travelling_cost::class,'perdiem_rate_id','id');
    }

}
