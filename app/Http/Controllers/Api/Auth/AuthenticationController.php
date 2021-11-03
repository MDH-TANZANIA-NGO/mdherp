<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Api\Auth\Traits\AuthenticationTrait;

class AuthenticationController extends BaseController
{
    use AuthenticationTrait;
//    use ApiResponser;
    //use this method to login users
    public function login()
    {
//        $attr = $request->validate([
//            'email' => 'required|string|email|',
//            'password' => 'required|string|min:6'
//        ]);
//
//        if (!Auth::attempt($attr)) {
//            return $this->error('Credentials not match', 401);
//        }
//
//        return $this->success([
//            'token' => auth()->user()->createToken('API Token')->plainTextToken
//        ]);

        return $this->loginWithEmailAndPassword();
    }



    // this method  logout users by removing tokens
    public function logout()
    {
        auth()->user()->tokens()->delete();

        $success['state'] = 'Logout';
        return $this->sendResponse($success,'User Logout Successfully');
    }
}
