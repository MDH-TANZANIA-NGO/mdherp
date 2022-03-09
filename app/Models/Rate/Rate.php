<?php

namespace App\Models\Rate;

use App\Models\BaseModel;
use App\Models\Rate\Traits\Attribute\RateAttribute;
use App\Models\Rate\Traits\Relationship\RateRelationship;

class Rate extends BaseModel
{
    use RateAttribute, RateRelationship;
}
