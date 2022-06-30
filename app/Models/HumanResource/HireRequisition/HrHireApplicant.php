<?php

namespace App\Models\HumanResource\HireRequisition;

use App\Models\BaseModel;
use App\Models\HumanResource\HireRequisition\Traits\Attribute\HrHireApplicantAttribute;
use App\Models\HumanResource\HireRequisition\Traits\Relationship\HrHireApplicantRelationship;

class HrHireApplicant extends BaseModel
{
    use HrHireApplicantAttribute, HrHireApplicantRelationship;

}
