<?php

namespace App\Http\Controllers\Api\UserLoginToken;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Repositories\LoginTokenRepository\UserLoginTokenRepository;
use Illuminate\Http\Request;

class UserLoginTokenController extends BaseController
{
    //
    protected $login_token;
    public function __construct()
    {
        $this->login_token = (new UserLoginTokenRepository());
    }

    public function verifyToken()
    {
        $this->login_token->update(\request()->input('token'));
        $user_token = $this->login_token->getUserDetails()->where('user_login_tokens.token',\request()->input('token')->first());
        $results['details'] = $user_token;
        if ($user_token)
        {

             return $this->sendResponse($results,'Token is valid');
        }
        else{
            return $this->sendResponse($results,'Token does not exist');
        }

    }
}
