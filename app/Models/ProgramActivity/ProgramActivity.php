<?php

namespace App\Models\ProgramActivity;

use App\Models\BaseModel;
use App\Models\ProgramActivity\Traits\ProgramActivityRelationship;
use Illuminate\Database\Eloquent\Model;

class ProgramActivity extends BaseModel
{
    //
    use ProgramActivityRelationship;
}
