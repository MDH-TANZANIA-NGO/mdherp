<?php

namespace App\Models\HumanResource\HireRequisition\Traits\Relationshp;

use App\Models\System\Region;
use App\Models\HumanResource\HireRequisition\HireRequisitionLocation;
use App\Models\HumanResource\HireRequisition\HireRequisitionReplacedStaff;
use App\Models\HumanResource\HireRequisition\HrHireRequisitionJobsCriteria;

trait HireRequisitionJobRelationship
{
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