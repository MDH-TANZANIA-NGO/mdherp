<?php
/**
 * Created by PhpStorm.
 * User: hamis
 * Date: 1/30/19
 * Time: 10:46 AM
 */

namespace App\Models\Unit\Traits\Relationship;

use App\Models\Auth\User;
use App\Models\Unit\Department;
use App\Models\Unit\Unit;

trait DesignationRelationship
{
    /**
     * @return mixed
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * @return mixed
     */
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    /**
     * @return mixed
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

}
