<?php

namespace App\Models\HumanResource\HireRequisition;

use App\Models\BaseModel;
use App\Models\HumanResource\HireRequisition\Traits\Attribute\HrHireApplicantAttribute;
use App\Models\HumanResource\HireRequisition\Traits\Relationship\HrHireApplicantRelationship;
use Illuminate\Notifications\Notifiable;

class HrHireApplicant extends BaseModel
{
    use Notifiable;
    use HrHireApplicantAttribute, HrHireApplicantRelationship;

}
