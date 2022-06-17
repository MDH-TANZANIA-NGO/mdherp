<?php
/**
 * Created by PhpStorm.
 * User: hamis
 * Date: 8/30/19
 * Time: 11:30 AM
 */

namespace App\Models\System\Relationship;


use App\Models\Separate\Separate;
use App\Models\System\Region;
use App\Models\System\Ward;

trait DistrictRelationship
{
    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function separate()
    {
        return $this->belongsTo(Separate::class);
    }
    public function wards()
    {
        return $this->hasMany(Ward::class);
    }
}
