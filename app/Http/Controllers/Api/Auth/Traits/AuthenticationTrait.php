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
use App\Models\ProgramActivity\ProgramActivityAttendance;
use App\Models\Requisition\Training\requisition_training;
use App\Models\Requisition\Training\requisition_training_cost;
use App\Repositories\ProgramActivity\ProgramActivityAttendanceRepository;
use App\Repositories\ProgramActivity\ProgramActivityRepository;
use App\Repositories\Requisition\Training\RequisitionTrainingRepository;


trait AuthenticationTrait
{
    protected $g_officers;
    protected $program_activity_repo;
    protected $requisition_training_repo;

    public function __construct()
    {
        $this->g_officers = (new GOfficerRepository());
        $this->program_activity_repo =  (new ProgramActivityRepository());
        $this->requisition_training_repo =  (new  RequisitionTrainingRepository());
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
            $return = $this->g_officerReturnEntities($g_officer);
        }else{
            $return = $this->sendError('Invalid Credentials', NULL);
        }

        return $return;
    }

    public function LoginWithId($inputs)
    {
        $return = NULL;

        if(Auth::guard('g_officer')->loginUsingId($inputs['g_officer_id'],NULL)){
            $g_officer = $this->g_officers->getGOfficerAuth(auth()->guard('g_officer')->user()->id);
            $return = $this->g_officerReturnEntities($g_officer);
        }
        else{
            $return = $this->sendError('Invalid credentials', NULL);
        }

        return $return;
    }

    public function g_officerReturnEntities(GOfficer $gOfficer){

        $success['g_officer'] =  $gOfficer;
        $access_token =  $gOfficer->createToken('access_token')->accessToken;

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
            ->where('wards.district_id', '=', $gOfficer->district_id)
            ->get();
        $success['wards'] = $wards;

        $facilities = DB::table("facilities")
            ->selectRaw('facilities.id as facility_id')
            ->selectRaw('facilities.name as facility_name')
            ->selectRaw('facilities.number as facility_number')
            ->selectRaw('facilities.isactive as isactive')
//            ->selectRaw('g_officers.id as g_officer_id')
            ->selectRaw('facilities.facility_type_id as facility_type_id')
            ->selectRaw('facility_types.name as facility_type')
            ->leftJoin('wards', 'wards.id', '=', 'facilities.ward_id')
//            ->leftJoin('facility_g_officer', 'facility_g_officer.facility_id', 'facilities.id')
//            ->leftJoin('g_officers', 'g_officers.id', 'facility_g_officer.g_officer_id')
            ->leftJoin('facility_types', 'facility_types.id', '=', 'facilities.facility_type_id')
            ->leftJoin('ownerships', 'ownerships.id', '=', 'facilities.ownership_id')
            ->where('wards.district_id', '=', $gOfficer->district_id)
            ->get();
        $success['facilities'] = $facilities;

        $facility_g_officer = DB::table("facility_g_officer")
            ->selectRaw('facility_g_officer.id as facility_g_officer_id')
            ->selectRaw('facility_g_officer.facility_id as facility_id')
            ->selectRaw('facility_g_officer.g_officer_id as g_officer_id')
            ->selectRaw('facilities.name as facility_name')
            ->selectRaw('facilities.number as facility_number')
            ->selectRaw('facilities.isactive as isactive')
            ->selectRaw('facility_types.name as facility_type')
            ->selectRaw('ownerships.name as ownership')
            ->leftJoin('g_officers', 'g_officers.id', '=', 'facility_g_officer.g_officer_id')
            ->leftJoin('facilities', 'facilities.id', '=', 'facility_g_officer.facility_id')
            ->leftJoin('wards', 'wards.id', '=', 'facilities.ward_id')
            ->leftJoin('facility_types', 'facility_types.id', '=', 'facilities.facility_type_id')
            ->leftJoin('ownerships', 'ownerships.id', '=', 'facilities.ownership_id')
            ->where('wards.district_id', '=', $gOfficer->district_id)
            ->get();

        $success['facility_g_officer'] = $facility_g_officer;

        $g_officer_hts = DB::table("hts")
            ->where('hts.data_clerk_id', $gOfficer->id)->count();
        $success['g_officer_hts_sent'] = $g_officer_hts;

        $g_officer_covids = DB::table("covids")
            ->where('covids.data_clerk_id', $gOfficer->id)->count();
        $success['g_officer_covids_sent'] = $g_officer_covids;


        $valid_program_activities = $this->requisition_training_repo->getValidProgramActivity()->whereDate('end_date', '>',Carbon::today())->pluck('program_activity_number', 'id');

        $success['program_activities'] = $valid_program_activities;

        return  $this->sendResponse($success, 'GOfficer Log in successfully');

    }

    public function refreshDashboard($inputs)
    {
        $return = NULL;

        if(Auth::guard('g_officer')->loginUsingId($inputs['g_officer_id'],NULL)){
            $g_officer = $this->g_officers->getGOfficerAuth(auth()->guard('g_officer')->user()->id);
            $return = $this->g_officerReturnEntities($g_officer);
        }
        else{
            $return = $this->sendError('Invalid credentials', NULL);
        }

        return $return;
    }


}
