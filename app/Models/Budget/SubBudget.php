<?php

namespace App\Models\Budget;

use App\Models\BaseModel;
use App\Models\Budget\Traits\Attribute\SubBudgetAttribute;
use App\Models\Budget\Traits\Relationship\SubBudgetRelationship;

class SubBudget extends BaseModel
{
    use SubBudgetRelationship, SubBudgetAttribute;
}
