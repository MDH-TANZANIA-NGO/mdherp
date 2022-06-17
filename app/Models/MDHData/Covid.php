<?php

namespace App\Models\MDHData;

use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;
use App\Models\MDHData\Covid;

class Covid extends BaseModel
{
    protected $table = 'covids';
}
