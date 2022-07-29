<?php

namespace App\Models\HumanResource\HireRequisition;

use App\Models\HumanResource\HireRequisition\Traits\Attribute\HrUserHireRequisitionJobShortlisterUserAttribute;
use App\Models\HumanResource\HireRequisition\Traits\Relationship\HrUserHireRequisitionJobShortlisterUserRelationship;
use Illuminate\Database\Eloquent\Model;

class HrUserHireRequisitionJobShortlisterUser extends Model
{
    use HrUserHireRequisitionJobShortlisterUserAttribute, HrUserHireRequisitionJobShortlisterUserRelationship;

    protected $guarded = [];
}
