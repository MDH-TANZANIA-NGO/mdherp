<?php

namespace App\Models\HumanResource\HireRequisition;

use App\Models\BaseModel;
use App\Models\HumanResource\Advertisement\HireAdvertisementRequisition;
use App\Models\HumanResource\HireRequisition\Traits\Relationship\HireRequisitionJobRelationship;
use App\Models\System\Region;
use App\Models\HumanResource\HireRequisition\HireRequisitionLocation;
use App\Models\HumanResource\HireRequisition\HireRequisitionReplacedStaff;
use App\Models\HumanResource\HireRequisition\HrHireRequisitionJobsCriteria;
use App\Models\Project\Project;
use App\Models\Unit\Department;
use App\Models\Unit\Designation;
use App\Models\Unit\Unit;

class HireRequisitionJob extends BaseModel
{
    // use HireRequisitionJobRelationship;
    protected $table = 'hr_hire_requisitions_jobs';
    protected $guarded = [];

    public function regions()
    {
        return $this->belongsToMany(Region::class,HireRequisitionLocation::class,'hr_requisition_job_id');
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
    public function reportTo()
    {
        return $this->belongsTo(Designation::class,'report_to','id')->with('unit');
    }

    public function unit()
    {
        return $this->hasOneThrough(Unit::class,Designation::class,'designation_id','id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

     public function locations()
     {
         return $this->hasMany(HireRequisitionLocation::class,'hr_requisition_job_id');
     }
     public function project()
     {
         return $this->belongsTo(Project::class,'project_id');
     }

     public function advertisment()
     {
         return $this->hasOne(HireAdvertisementRequisition::class);
     }

    public function shortlists()
    {
        return $this->hasMany(HrHireRequisitionJobApplicant::class,'hr_hire_requisitions_job_id','id');
    }

    public function shortlisted()
    {
        return $this->hasOne(HrUserHireRequisitionJobShortlister::class,'hr_hire_requisitions_job_id','id');
    }

    public function applicant()
    {
        return $this->belongsTo(HrHireApplicant::class,'hr_hire_applicant_id','id');
    }

}
