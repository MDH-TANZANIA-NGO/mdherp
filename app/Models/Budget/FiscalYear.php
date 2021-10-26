<?php

namespace App\Models\Budget;

use App\Models\BaseModel;
use App\Models\Budget\Traits\Attribute\FiscalYearAttribute;
use App\Models\Budget\Traits\Relationship\FiscalYearRelationship;
use Illuminate\Database\Eloquent\Model;

class FiscalYear extends BaseModel
{
    use FiscalYearAttribute, FiscalYearRelationship;
}
