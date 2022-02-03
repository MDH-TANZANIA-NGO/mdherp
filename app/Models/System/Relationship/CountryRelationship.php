<?php
/**
 * Created by PhpStorm.
 * User: hamis
 * Date: 8/5/19
 * Time: 10:56 AM
 */

namespace App\Models\System\Relationship;


use App\Models\System\Organisation;
use App\Models\System\Region;

trait CountryRelationship
{
    public function regions()
    {
        return $this->hasMany(Region::class);
    }

    public function organisations()
    {
        return $this->belongsToMany(Organisation::class);
    }
}
