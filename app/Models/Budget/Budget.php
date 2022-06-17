<?php

namespace App\Models\Budget;

use App\Models\BaseModel;
use App\Models\Budget\Traits\Attribute\BudgetAttribute;
use App\Models\Budget\Traits\Relationship\BudgetRelationship;
use Illuminate\Database\Eloquent\Model;

class Budget extends BaseModel
{
    use BudgetAttribute, BudgetRelationship;
}
