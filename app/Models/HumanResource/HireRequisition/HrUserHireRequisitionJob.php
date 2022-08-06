<?php

namespace App\Models\HumanResource\HireRequisition;

use App\Models\HumanResource\HireRequisition\Traits\Attribute\HrUserHireRequisitionJobAttribute;
use App\Models\HumanResource\HireRequisition\Traits\Relationship\HrUserHireRequisitionJobRelationship;
use Illuminate\Database\Eloquent\Model;

class HrUserHireRequisitionJob extends Model
{
    use HrUserHireRequisitionJobAttribute, HrUserHireRequisitionJobRelationship;

    protected $guarded = [];
}
