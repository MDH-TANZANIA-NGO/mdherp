<?php

namespace App\Models\HumanResource\HireRequisition;

use App\Models\BaseModel;
use App\Models\HumanResource\HireRequisition\Traits\Relationship\HireRequisitionJobRelationship;
use App\Models\System\Region;
use App\Models\HumanResource\HireRequisition\HireRequisitionLocation;
use App\Models\HumanResource\HireRequisition\HireRequisitionReplacedStaff;
use App\Models\HumanResource\HireRequisition\HrHireRequisitionJobsCriteria;
use App\Models\Unit\Department;
use App\Models\Unit\Designation;
use App\Models\Unit\Unit;

class HireRequisitionJob extends BaseModel
{
    // use HireRequisitionJobRelationship;
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

    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }
    public function unit()
    {
        return $this->hasOneThrough(Unit::class,Designation::class,'designation_id','id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    // public function locations()
    // {
    //     return $this->hasMany(HireRequisitionLocation::class,'hr_requisition_job_id')
    // }

    public function locations()
    {
        return $this->hasMany(HireRequisitionLocation::class,'hr_requisition_job_id','id');
    }

    public function shortlists()
    {
        return $this->hasMany(HrHireRequisitionJobApplicant::class,'hr_hire_requisitions_job_id','id');
    }

}
