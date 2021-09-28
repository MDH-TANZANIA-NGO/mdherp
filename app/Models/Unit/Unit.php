<?php

namespace App\Models\Unit;

use App\Models\Unit\Traits\Attribute\UnitAttribute;
use App\Models\Unit\Traits\Relationship\UnitRelationship;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use UnitRelationship, UnitAttribute;
    protected $guarded = [];
}
