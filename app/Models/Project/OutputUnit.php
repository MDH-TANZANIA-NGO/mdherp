<?php

namespace App\Models\Project;

use App\Models\BaseModel;
use App\Models\Project\Traits\Attribute\OutputUnitAttribute;
use App\Models\Project\Traits\Relationship\OutputUnitRelationship;

class OutputUnit extends BaseModel
{
    use OutputUnitAttribute, OutputUnitRelationship;
}
