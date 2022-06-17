<?php

namespace App\Models\GOfficer;

use App\Models\BaseModel;
use App\Models\GOfficer\Traits\Attribute\GScaleAttribute;
use App\Models\GOfficer\Traits\Relationship\GScaleRelationship;

class GScale extends BaseModel
{
    use GScaleAttribute, GScaleRelationship;
}
