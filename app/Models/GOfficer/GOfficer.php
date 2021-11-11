<?php

namespace App\Models\GOfficer;

use App\Models\BaseModel;
use App\Models\GOfficer\Traits\Attribute\GOfficerAttribute;
use App\Models\GOfficer\Traits\Relationship\GOfficerRelationship;

class GOfficer extends BaseModel
{
    use GOfficerAttribute, GOfficerRelationship;
}
