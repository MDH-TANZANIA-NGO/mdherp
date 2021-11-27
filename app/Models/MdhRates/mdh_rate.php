<?php

namespace App\Models\MdhRates;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class mdh_rate extends BaseModel
{
    //
    public function travellingPerdiemAmount(){

        return $this->hasMany('requisition_travelling_costs','perdiem_rate_id','id');
    }

}
