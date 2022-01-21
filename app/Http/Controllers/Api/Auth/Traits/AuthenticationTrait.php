<?php

namespace App\Http\Controllers\Api\Auth\Traits;

use App\Models\Auth\User;
use App\Repositories\Access\UserRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

trait AuthenticationTrait
{
    public function loginValidator()
    {
        $validator = Validator::make(request()->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validator Error.', $validator->errors());
        }
    }

    public function loginWithEmailAndPassword(){
        $this->loginValidator();

        $return = NULL;

        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $return = $this->returnEntities(access()->user());
        }else{
            $return = $this->sendError('Invalid Credentials', NULL);
        }

        return $return;
    }

    public function returnEntities(User $user)
    {
        $return = NULL;

        if(access()->user()->isactive == false){
            access()->logout();
            $return = $this->sendError('Account De-activated', NULL);
        }else{

            $access_token =  $user->createToken('access_token')->accessToken;
            $success['user'] = $user->api_auth;
            $success['token'] =[
                'token_type' => 'Bearer',
                'access_token' => $access_token
            ];
            $return = $this->sendResponse($success, 'User Log in successfully');
        }

        return $return;
    }

}
