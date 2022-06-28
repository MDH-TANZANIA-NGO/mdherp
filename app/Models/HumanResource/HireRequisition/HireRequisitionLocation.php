<?php

namespace App\Models\HumanResource\HireRequisition;

use App\Models\BaseModel;
use App\Models\System\Region;
use Illuminate\Database\Eloquent\Model;

class HireRequisitionLocation extends BaseModel
{
    protected $table = 'hr_hire_requisition_locations';

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

}
