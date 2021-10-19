<?php

namespace App\Models\Project\Traits\Relationship;

use App\Models\Project\Project;

trait ProgramAreaRelationship
{
    public function projects()
    {
        return $this->belongsToMany(Project::class,'program_area_project');
    }
}
