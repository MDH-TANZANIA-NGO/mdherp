<?php

namespace App\Model\Userbio;

use App\Models\Auth\User;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class Userbio extends BaseModel
{
    public  function user()
    {
        return $this->belongsTo(User::class);
    }

}
