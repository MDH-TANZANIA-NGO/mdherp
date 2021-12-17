<?php
/**
 * Created by PhpStorm.
 * User: hamis
 * Date: 8/5/19
 * Time: 10:43 AM
 */

namespace App\Models\System\Relationship;

use App\Models\None\None;
use App\Models\Project\Project;
use App\Models\System\Region;
use App\Models\System\Zone;
use App\Models\Taf\Taf;

trait RegionRelationship
{
    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }

    public function fromTaf()
    {
        return $this->hasMany(Taf::class, 'from_region_id', 'id');
    }

    public function toTaf()
    {
        return $this->hasMany(Taf::class, 'to_region_id', 'id');
    }

    public function taf()
    {
        return $this->hasMany(Region::class);
    }

    public function none()
    {
        return $this->hasMany(None::class);
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class)->withPivot('id','title','description','start_year','end_year');
    }

}
