<?php

namespace App\Models\Project\Traits\Relationship;

use App\Models\Project\Activity;

trait OutputUnitRelationship
{
    public function activities()
    {
        return $this->hasMany(Activity::class);
    }
}
