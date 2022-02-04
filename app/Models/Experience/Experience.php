<?php

namespace App\Models\Experience;

use App\Models\BaseModel;
use App\Models\Experience\Traits\ExperienceAttribute;
use App\Models\Experience\Traits\ExperienceRelationship;

class Experience extends BaseModel
{
    use ExperienceRelationship, ExperienceAttribute;
}
