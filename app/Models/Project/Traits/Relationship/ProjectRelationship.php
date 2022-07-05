<?php

namespace App\Models\Project\Traits\Relationship;

use App\Models\Auth\User;
use App\Models\JobOffer\JobOffer;
use App\Models\Project\Budget;
use App\Models\Project\ProgramArea;
use App\Models\Project\ProgramAreaProject;
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function regions()
    {
        return $this->belongsToMany(Region::class)->withPivot('id','name');
    }

    public function programArea()
    {
        return $this->belongsToMany(ProgramArea::class,'program_area_project');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    public function job_offer()
    {
        return $this->belongsToMany(JobOffer::class)->withPivot('id');
    }

}
