<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Api\Auth\Traits\AuthenticationTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends BaseController
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

    public function gOfficerLogin()
    {
        return $this->loginWithPhoneAndPassword();
    }



    // this method  logout users by removing tokens
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        $success['state'] = 'Logout';
        return $this->sendResponse($success,'User Logout Successfully');
    }

    public function gOfficerLogout(Request $request){

//        auth()->guard('g_officer')->user()->token()->revoke();
//        return $this->sendResponse($success, );
    }

    public function refresh(Request $request){
        return $this->LoginWithId($request->all());
    }
}
