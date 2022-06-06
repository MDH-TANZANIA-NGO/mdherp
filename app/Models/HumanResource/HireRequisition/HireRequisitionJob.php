<?php

namespace App\Models\HumanResource\HireRequisition;

use App\Models\Auth\User;
use App\Models\BaseModel;
use App\Models\System\Region;
use App\Models\System\WorkingTool;
use Illuminate\Database\Eloquent\Model;

class HireRequisitionJob extends BaseModel
{
    protected $table = 'hr_hire_requisitions_jobs';
    protected $guarded =[];


 
    public function regions()
    {
        
    }

}
