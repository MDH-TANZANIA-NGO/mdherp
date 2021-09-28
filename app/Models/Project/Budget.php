<?php

namespace App\Models\Project;

use App\Models\BaseModel;
use App\Models\Project\Traits\Attribute\BudgetAttribute;
use App\Models\Project\Traits\Relationship\BudgetRelationship;
use Illuminate\Database\Eloquent\Model;

class Budget extends BaseModel
{
    use BudgetAttribute, BudgetRelationship;
}
