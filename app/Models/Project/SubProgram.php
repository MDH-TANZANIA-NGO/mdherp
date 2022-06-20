<?php

namespace App\Models\Project;

use App\Models\BaseModel;
use App\Models\Project\Traits\Attribute\SubProgramActivity;
use App\Models\Project\Traits\Relationship\SubProgramRelationship;
use Illuminate\Database\Eloquent\Model;

class SubProgram extends BaseModel
{
    use SubProgramActivity, SubProgramRelationship;
}
