<?php

namespace App\Models\Project\Traits\Relationship;

use App\Models\Project\Budget;
use App\Models\Project\ProjectRegion;
use App\Models\System\Region;

trait ProjectRelationship
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function budgets()
    {
        return $this->morphMany(Budget::class, 'budgetable');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function regions()
    {
        return $this->hasManyThrough(Region::class,ProjectRegion::class,'project_id','region_id','id','id');
    }
}
