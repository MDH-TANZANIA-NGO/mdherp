<?php

namespace App\Models\ProgramActivity;

use App\Models\Auth\User;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class ProgramActivityReport extends BaseModel
{
    //

    public function programActivity(){
        return $this->belongsTo(ProgramActivity::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
