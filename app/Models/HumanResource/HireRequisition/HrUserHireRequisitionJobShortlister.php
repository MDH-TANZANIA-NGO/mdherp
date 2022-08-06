<?php

namespace App\Models\HumanResource\HireRequisition;

use App\Models\HumanResource\HireRequisition\Traits\Attribute\HrUserHireRequisitionJobShortlisterAttribute;
use App\Models\HumanResource\HireRequisition\Traits\Relationship\HrUserHireRequisitionJobShortlisterRelationship;
use Illuminate\Database\Eloquent\Model;

class HrUserHireRequisitionJobShortlister extends Model
{
    use HrUserHireRequisitionJobShortlisterAttribute, HrUserHireRequisitionJobShortlisterRelationship;
    protected $guarded = [];
}
