<?php

namespace App\Models\Project\Traits\Attribute;

trait ProjectAttribute
{
    public function getIsAboveSiteAttribute()
    {
        return $this->attributes['project_type_cv_id'] == 14 ? true : false;
    }
}
