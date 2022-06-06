<?php

namespace App\Http\Controllers\Api\UserLoginToken;

use App\Http\Controllers\Controller;
use App\Repositories\LoginTokenRepository\UserLoginTokenRepository;
use Illuminate\Http\Request;

class UserLoginTokenController extends Controller
{
    //
    protected $login_token;
    public function __construct()
    {
        $this->login_token = (new UserLoginTokenRepository());
    }

    public function verifyToken()
    {
       return $this->login_token->query()->where('token', \request()->verifyToken)->first();
    }
}
