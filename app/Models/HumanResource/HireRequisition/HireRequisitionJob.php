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
        return $this->belongsToMany(Region::class,HireRequisitionLocation::class,'region_id');
    }

    public function getRegionAttribute()
    {
        return $this->regions->implode('region.name', ',');
    }

    public function replacedStaffs()
    {
        return $this->hasMany(HireRequisitionReplacedStaff::class,'hr_requisition_job_id');
    }

    public function jobCriterias()
    {
        return $this->hasMany(HrHireRequisitionJobsCriteria::class,'hr_requisitions_jobs_id');
    }

}
