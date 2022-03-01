<?php

namespace App\Models\ProgramActivity;

use App\Models\BaseModel;
use App\Models\ProgramActivity\ProgramActivity;
use Illuminate\Database\Eloquent\Model;

class ProgramActivityAttendance extends BaseModel
{
    //
    public function programActivity(){

        return $this->belongsTo(ProgramActivity::class);
    }
}
