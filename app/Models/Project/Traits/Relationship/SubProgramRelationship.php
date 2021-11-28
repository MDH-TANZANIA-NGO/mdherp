<?php

namespace App\Models\Project\Traits\Relationship;

use App\Models\Project\Activity;
use App\Models\Project\ProgramArea;

trait SubProgramRelationship
{
    public function activities()
    {
        return $this->hasMany(Activity::class);
    }
    public function programArea()
    {
        return $this->belongsTo(ProgramArea::class);
    }
}
