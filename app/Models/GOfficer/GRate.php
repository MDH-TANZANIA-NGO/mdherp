<?php

namespace App\Models\GOfficer;

use App\Models\BaseModel;
use App\Models\GOfficer\Traits\Attribute\GRateAttribute;
use App\Models\GOfficer\Traits\Relationship\GRateRelationship;

class GRate extends BaseModel
{
    use GRateAttribute, GRateRelationship;
}
