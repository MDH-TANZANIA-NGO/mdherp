<?php

namespace App\Models\Token;

use App\Models\Auth\User;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class UserLoginToken extends BaseModel
{
    //

    public function loginToken()
    {
        return $this->belongsTo( User::class);
    }
}
