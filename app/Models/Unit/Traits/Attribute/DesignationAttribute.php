<?php
/**
 * Created by PhpStorm.
 * User: hamis
 * Date: 1/30/19
 * Time: 10:46 AM
 */

namespace App\Models\Unit\Traits\Attribute;


trait DesignationAttribute
{
    public function getFullTitleAttribute()
    {
        return $this->unit->name." ".$this->name;
    }
}
