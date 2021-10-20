<?php

namespace App\Models\Project;

use App\Models\BaseModel;
use App\Models\Project\Traits\Attribute\ProgramAreaAttribute;
use App\Models\Project\Traits\Relationship\ProgramAreaRelationship;
use Illuminate\Database\Eloquent\Model;

class ProgramArea extends BaseModel
{
    use ProgramAreaAttribute, ProgramAreaRelationship;
}
