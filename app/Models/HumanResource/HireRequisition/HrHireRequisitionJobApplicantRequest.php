<?php

namespace App\Models\HumanResource\HireRequisition;

use App\Models\BaseModel;
use App\Models\HumanResource\HireRequisition\Traits\Attribute\HrHireRequisitionJobApplicantRequestAttribute;
use App\Models\HumanResource\HireRequisition\Traits\Relationship\HrHireRequisitionJobApplicantRequestRelationship;
use Illuminate\Database\Eloquent\Model;

class HrHireRequisitionJobApplicantRequest extends BaseModel
{
    use HrHireRequisitionJobApplicantRequestAttribute, HrHireRequisitionJobApplicantRequestRelationship;
    
}
