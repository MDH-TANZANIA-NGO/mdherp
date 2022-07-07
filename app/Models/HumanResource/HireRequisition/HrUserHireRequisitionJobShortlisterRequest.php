<?php

namespace App\Models\HumanResource\HireRequisition;

use App\Models\BaseModel;
use App\Models\HumanResource\HireRequisition\Traits\Attribute\HrUserHireRequisitionJobShortlisterRequestAttribute;
use App\Models\HumanResource\HireRequisition\Traits\Relationship\HrUserHireRequisitionJobShortlisterRequestRelationship;

class HrUserHireRequisitionJobShortlisterRequest extends BaseModel
{
    use HrUserHireRequisitionJobShortlisterRequestAttribute, HrUserHireRequisitionJobShortlisterRequestRelationship;
}
