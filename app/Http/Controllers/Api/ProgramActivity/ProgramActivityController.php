<?php

namespace App\Http\Controllers\Api\ProgramActivity;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Models\ProgramActivity\ProgramActivity;
use App\Models\ProgramActivity\ProgramActivityAttendance;
use App\Models\Requisition\Training\requisition_training;
use App\Repositories\ProgramActivity\ProgramActivityAttendanceRepository;
use App\Repositories\ProgramActivity\ProgramActivityRepository;
use App\Repositories\Requisition\Training\RequisitionTrainingRepository;
use Illuminate\Http\Request;


class ProgramActivityController extends BaseController
{
    //
    protected $program_activity;
    protected $program_activity_attendance;
    protected $training_repo;

    public function __construct(){
        $this->program_activity =  (new ProgramActivityRepository());
        $this->program_activity_attendance =  (new ProgramActivityAttendanceRepository());
        $this->training_repo =  (new RequisitionTrainingRepository());
    }

    public function storeAttendance(Request $request){


        $date =  $request['date'];
        $user = $request['g_officer_id'];

        $attendance = ProgramActivityAttendance::query()->where('g_officer_id', $user)->where('date', now())->first();
        if ($attendance){
            return $this->sendError('Attendance already exists', ['error' => 'Attendance already exists']);

        }
        else{

            $attendance = ProgramActivityAttendance::create([
                'program_activity_id'=>$request['program_activity_id'],
                'g_officer_id' => $request['g_officer_id'],
                'checkin_time' => $request['checkin_time'],
                'checkin_latitude' => $request['checkin_latitude'],
                'checkin_longitude' => $request['checkin_longitude'],
                'checkin_location' => $request['checkin_location'],
                'checkout_time' => $request['checkout_time'],
                'checkout_latitude' => $request['checkout_latitude'],
                'checkout_longitude' => $request['checkout_longitude'],
                'checkout_location' => $request['checkout_location'],
                'description' => $request['description']
            ]);
        }
        return $this->sendResponse($attendance, "Attendance created successfully");
    }

    public function getAllValidProgramActivities(){
        return $this->training_repo->getQueryProgramActivity()->where('end_date', '>', Today()) ->pluck('number', 'program_activity_id');
    }

    public function getAllParticipants(Request $request){
        dd($this->program_activity->getParticipants()->where('program_activities.id', $request['id'])->get());
    }
}

