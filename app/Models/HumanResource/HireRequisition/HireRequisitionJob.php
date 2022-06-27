<?php

namespace App\Models\HumanResource\HireRequisition;

use App\Models\BaseModel;
use App\Models\HumanResource\HireRequisition\Traits\Relationshp\HireRequisitionJobRelationship;

class HireRequisitionJob extends BaseModel
{
    use HireRequisitionJobRelationship;
    protected $table = 'hr_hire_requisitions_jobs';
    protected $guarded =[];

}
