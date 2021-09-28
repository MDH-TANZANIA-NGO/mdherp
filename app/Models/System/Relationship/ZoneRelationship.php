<?php
/**
 * Created by PhpStorm.
 * User: hamis
 * Date: 8/5/19
 * Time: 10:02 AM
 */

namespace App\Models\System\Traits\Relationship;


use App\Models\System\Region;

trait ZoneRelationship
{
    public function regions()
    {
        return $this->hasMany(Region::class);
    }
}