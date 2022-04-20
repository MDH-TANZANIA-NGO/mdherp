<?php

namespace App\Models\Unit;

use App\Models\Unit\Traits\Attribute\DesignationAttribute;
use App\Models\Unit\Traits\Relationship\DesignationRelationship;
use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    use DesignationRelationship, DesignationAttribute;
    //
    protected $guarded=[];
}
