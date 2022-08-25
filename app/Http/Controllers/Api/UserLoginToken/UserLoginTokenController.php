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

    public function verifyToken(Request  $request)
    {
        $this->login_token->update(\request()->input('token'));
        $user_token = $this->login_token->getUserDetailsByToken($request->get('token'));
        $results['details'] = $user_token->get()->first();

        if ($user_token)
        {

             return $this->sendResponse($results,'Token is valid');
        }
        else{
            return $this->sendResponse($results,'Token does not exist');
        }

    }
}
