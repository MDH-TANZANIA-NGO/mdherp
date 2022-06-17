<?php

namespace App\Models\Education;

use App\Models\BaseModel;
use App\Models\Education\Traits\EducationAttribute;
use App\Models\Education\Traits\EducationRelationship;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Education extends BaseModel implements HasMedia
{
    use InteractsWithMedia;
    use EducationRelationship, EducationAttribute;
    protected $table="educations";
}
