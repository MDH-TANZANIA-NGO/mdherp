<?php

namespace App\Models\HumanResource\HireRequisition;

use App\Models\HumanResource\HireRequisition\Traits\Attribute\HrHireRequisitionJobApplicantAttribute;
use App\Models\HumanResource\HireRequisition\Traits\Relationship\HrHireRequisitionJobApplicantRelationship;
use Illuminate\Database\Eloquent\Model;

class HrHireRequisitionJobApplicant extends Model
{
    use HrHireRequisitionJobApplicantAttribute, HrHireRequisitionJobApplicantRelationship;
    protected $guarded = [];
}
