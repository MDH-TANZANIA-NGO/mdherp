<?php

namespace App\Models\Project;

use App\Models\BaseModel;
use App\Models\Project\Traits\Attribute\ActivityAttribute;
use App\Models\Project\Traits\Relationship\ActivityRelationship;
use Illuminate\Database\Eloquent\Model;

class Activities extends BaseModel
{
    use ActivityAttribute, ActivityRelationship;
}
