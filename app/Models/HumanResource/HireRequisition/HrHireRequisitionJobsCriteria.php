<?php
namespace App\Models\HumanResource\HireRequisition;
use App\Models\BaseModel;

class HrHireRequisitionJobsCriteria extends BaseModel
{
    protected $table = "hr_hire_requisition_jobs_criterias";

    public function resource()
    {
        return $this->morphTo()->withoutGlobalScopes();
    }
}
