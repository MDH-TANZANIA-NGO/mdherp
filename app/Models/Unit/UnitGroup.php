<?php

namespace App\Models\Unit;

use App\Models\Unit\Traits\Attribute\UnitGroupAttribute;
use App\Models\Unit\Traits\Relationship\UnitGroupRelationship;
use Illuminate\Database\Eloquent\Model;

class UnitGroup extends Model
{
    use UnitGroupAttribute, UnitGroupRelationship;
}
