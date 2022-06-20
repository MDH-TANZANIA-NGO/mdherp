<?php

namespace App\Models\Auth\Attribute;

/**
 * Class RoleAttribute
 * @package App\Models\Access\Attribute
 */
trait RoleAttribute
{

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucwords($value);
    }

}