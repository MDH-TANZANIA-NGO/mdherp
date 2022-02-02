<?php

namespace App\Models\Retirement;
use App\Models\BaseModel;

use App\Models\System\District;
use Illuminate\Database\Eloquent\Model;

class RetirementDetail extends BaseModel
{
    public function districts()
    {
        return $this->belongsTo(District::class, 'district_id', 'id');
    }
}