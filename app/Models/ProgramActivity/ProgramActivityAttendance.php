<?php

namespace App\Models\ProgramActivity;

use App\Models\BaseModel;
use App\Models\GOfficer\GOfficer;
use Illuminate\Database\Eloquent\Model;

class ProgramActivityAttendance extends BaseModel
{
    //
    public function Gofficer()
    {
        return $this->belongsTo(GOfficer::class);
    }
    public function programActivity()
    {
        return $this->belongsTo(ProgramActivity::class);
    }
}
