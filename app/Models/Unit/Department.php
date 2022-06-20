<?php

namespace App\Models\Unit;

use App\Models\Unit\Traits\Attribute\DepartmentAttribute;
use App\Models\Unit\Traits\Relationship\DepartmentRelationship;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use DepartmentAttribute, DepartmentRelationship;
}
