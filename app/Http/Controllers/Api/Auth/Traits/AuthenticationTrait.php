<?php

namespace App\Http\Controllers\Api\Auth\Traits;

use App\Models\Auth\User;
use App\Repositories\Access\UserRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\GOfficer\GOfficer;
use App\Repositories\GOfficer\GOfficerRepository;

trait AuthenticationTrait
{
    protected $g_officers;

    public function __construct()
    {
        $this->g_officers = (new GOfficerRepository());
    }

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

    public function gOfficerLoginValidator(){
        $validator = Validator::make(request()->all(), [
            'phone' => 'required',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error', $validator->errors());
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

        if(access()->user()->active == false){
            access()->logout();
            $return = $this->sendError('Account De-activated', NULL);
        }else{

            $access_token =  $user->createToken('access_token')->accessToken;
            $success['user'] = $user->api_auth;
            $success['permissions'] = $user->permissions;
            $success['token'] =[
                'token_type' => 'Bearer',
                'access_token' => $access_token
            ];
            $return = $this->sendResponse($success, 'User Log in successfully');
        }

        return $return;
    }

    public function loginWithPhoneAndPassword()
    {
        $this->gOfficerLoginValidator();

        $return = NULL;
//
//        if(Auth::attempt(['phone' => request('phone'), 'password' => request('password')])){
//            $return = $this->returnEntities(access()->user());
//        }else{
//            $return = $this->sendError('Invalid Credentials', NULL);
//        }
//
//        return $return;


        if(auth()->guard('g_officer')->attempt(['phone' => request('phone'), 'password' => request('password')])){

//            config(['auth.guards.api.provider' => 'g_officer']);

            $g_officer = $this->g_officers->getGOfficerAuth(auth()->guard('g_officer')->user()->id);

            $success['g_officer'] =  $g_officer;
            $access_token =  $g_officer->createToken('access_token')->accessToken;

            $success['token'] =[
                'token_type' => 'Bearer',
                'access_token' => $access_token,
            ];

            $success['g_officers'] = $this->g_officers->getQuery()->get();

            $wards = DB::table("wards")
                ->selectRaw('wards.id as id')
                ->selectRaw('wards.name as name')
                ->selectRaw('wards.district_id as district_id')
                ->selectRaw('wards.postcode as postcode')
                ->selectRaw('wards.isactive as isactive')
                ->where('wards.district_id', '=', $g_officer->district_id)
                ->get();
            $success['wards'] = $wards;

            $facilities = DB::table("facilities")
                ->selectRaw('facilities.id as facility_id')
                ->selectRaw('facilities.name as facility_name')
                ->selectRaw('facilities.number as facility_number')
                ->selectRaw('facilities.isactive as isactive')
                ->selectRaw('g_officers.id as g_officer_id')
                ->selectRaw('facilities.facility_type_id as facility_type_id')
                ->selectRaw('facility_types.name as facility_type')
                ->leftJoin('wards', 'wards.id', '=', 'facilities.ward_id')
                ->leftJoin('facility_g_officer', 'facility_g_officer.facility_id', 'facilities.id')
                ->leftJoin('g_officers', 'g_officers.id', 'facility_g_officer.g_officer_id')
                ->leftJoin('facility_types', 'facility_types.id', '=', 'facilities.facility_type_id')
                ->leftJoin('ownerships', 'ownerships.id', '=', 'facilities.ownership_id')
                ->where('wards.district_id', '=', $g_officer->district_id)
                ->get();
            $success['facilities'] = $facilities;

            $return = $this->sendResponse($success, 'GOfficer Log in successfully');
        }else{
            $return = $this->sendError('Invalid Credentials', NULL);
        }

        return $return;
    }

}
