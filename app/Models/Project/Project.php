<?php

namespace App\Models\Project;

use App\Models\BaseModel;
use App\Models\Project\Traits\Attribute\ProjectAttribute;
use App\Models\Project\Traits\Relationship\ProjectRelationship;
use Illuminate\Database\Eloquent\Model;

class Project extends BaseModel
{
    use ProjectAttribute, ProjectRelationship;
}
