<?php

namespace App\Http\Controllers\Api\ProgramActivity;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Models\ProgramActivity\ProgramActivityAttendance;
use App\Repositories\ProgramActivity\ProgramActivityRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProgramActivityController extends BaseController
{
    protected $program_activity_repo;
    protected $program_activity_attendance_repo;


    public function __construct(){

        $this->program_activity_repo =  (new ProgramActivityRepository());
    }


    public function storeAttendance(Request $request){

        $attendance = ProgramActivityAttendance::query()->whereDate('created_at',Carbon::now())->where('g_officer_id', $request['g_officer_id'])->first();

        if ($attendance){
            return $this->sendError('Attendance already exists', ['error' => 'Attendance already exists']);
        }
        else{

            $attendance = ProgramActivityAttendance::create([
                'g_officer_id' => $request['g_officer_id'],
                'program_activity_id' => $request['program_activity_id'],
                'checkin_time' => $request['checkin_time'],
                'checkin_latitude' => $request['checkin_latitude'],
                'checkin_longitude' => $request['checkin_longitude'],
                'checkin_location' => $request['checkin_location'],
                'checkout_time' => $request['checkout_time'],
                'checkout_latitude' => $request['checkout_latitude'],
                'checkout_longitude' => $request['checkout_longitude'],
                'checkout_location' => $request['checkout_location']
            ]);

            return $this->sendResponse($attendance, "Attendance created successfully");
        }

    }


}
