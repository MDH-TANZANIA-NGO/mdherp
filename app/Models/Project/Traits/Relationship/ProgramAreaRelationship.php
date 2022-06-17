<?php

namespace App\Models\Project\Traits\Relationship;

use App\Models\Project\Project;
use App\Models\Project\SubProgram;

trait ProgramAreaRelationship
{
    public function projects()
    {
        return $this->belongsToMany(Project::class,'program_area_project');
    }
    public function subprograms()
    {
        return $this->hasMany(SubProgram::class);
    }
}
