<?php

namespace App\Repositories\LoginTokenRepository;

use App\Models\Token\UserLoginToken;

class UserLoginTokenRepository
{
    const MODEL = UserLoginToken::class;
    public function __construct()
    {
        //
    }

    public function verifyToken($token)
    {

    }
}
