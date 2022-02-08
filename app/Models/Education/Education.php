<?php

namespace App\Models\Education;

use App\Models\BaseModel;
use App\Models\Education\Traits\EducationAttribute;
use App\Models\Education\Traits\EducationRelationship;

class Education extends BaseModel
{
    use EducationRelationship, EducationAttribute;
    protected $table="educations";
}
