<?php

namespace App\Models\System;

use App\Models\System\Attribute\HolidayAttribute;
use App\Models\System\Relationship\HolidayRelationship;
use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    use HolidayAttribute, HolidayRelationship;
    protected $guarded = [];
}
