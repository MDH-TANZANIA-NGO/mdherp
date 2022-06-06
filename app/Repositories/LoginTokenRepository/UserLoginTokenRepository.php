<?php

namespace App\Repositories\LoginTokenRepository;

use App\Models\Token\UserLoginToken;
use App\Repositories\BaseRepository;

class UserLoginTokenRepository extends  BaseRepository
{
    const MODEL = UserLoginToken::class;
    public function __construct()
    {
        //
    }

    public function verifyToken($token)
    {
        $this->query()->where('token', $token)->first();
    }
}
