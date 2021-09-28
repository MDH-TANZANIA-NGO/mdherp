<?php

namespace App\Models\System;

use App\Models\System\Traits\Attribute\ZoneAttribute;
use App\Models\System\Traits\Relationship\ZoneRelationship;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    use ZoneAttribute, ZoneRelationship;

    protected $guarded = [];
}
