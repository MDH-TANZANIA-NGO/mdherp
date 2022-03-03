<?php

namespace App\Models\ProgramActivity;

use App\Models\BaseModel;
use App\Models\ProgramActivity\Traits\ProgramActivityRelationship;
use App\Models\ProgramActivity\Traits\ProgramActivityAttribute;
use Illuminate\Database\Eloquent\Model;

class ProgramActivity extends BaseModel
{
    //
    use ProgramActivityRelationship, ProgramActivityAttribute;

    public function programActivityReport(){

        return $this->hasMany(ProgramActivityReport::class);
    }
}
