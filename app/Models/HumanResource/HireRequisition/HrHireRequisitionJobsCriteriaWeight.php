<?php
namespace App\Models\HumanResource\HireRequisition;
use App\Models\BaseModel;

class HrHireRequisitionJobsCriteriaWeight extends BaseModel
{
    protected $table = "hr_hire_requisitioin_job_criteria_weights";

    public function resource()
    {
        return $this->morphTo()->withoutGlobalScopes();
    }
}
