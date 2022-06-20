<?php


namespace App\Models\Unit\Traits\Relationship;


use App\Models\Unit\Designation;

trait DepartmentRelationship
{
    /**
     * @return mixed
     */
    public function designations()
    {
        return $this->hasMany(Designation::class);
    }
}
