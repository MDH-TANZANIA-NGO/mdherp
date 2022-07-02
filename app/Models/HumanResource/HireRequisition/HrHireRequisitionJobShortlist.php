<?php

namespace App\Models\HumanResource\HireRequisition;

use App\Models\BaseModel;
use App\Models\HumanResource\HireRequisition\Traits\Attribute\HrHireRequisitionJobShortlistAttribute;
// use App\Models\HumanResource\HireRequisition\Traits\Relationshp\HrHireRequisitionJobShortlistRelationship;

class HrHireRequisitionJobShortlist extends BaseModel
{
    use HrHireRequisitionJobShortlistAttribute;
}
