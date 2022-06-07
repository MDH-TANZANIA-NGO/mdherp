<?php

namespace App\Http\Controllers\Api\ProgramActivity;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Models\ProgramActivity\ProgramActivityAttendance;
use App\Models\Requisition\Training\requisition_training;
use App\Models\Requisition\Training\requisition_training_cost;
use App\Repositories\ProgramActivity\ProgramActivityAttendanceRepository;
use App\Repositories\ProgramActivity\ProgramActivityRepository;
use App\Repositories\Requisition\Training\RequisitionTrainingRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProgramActivityController extends BaseController
{
    protected $program_activity_repo;
    protected $program_activity_attendance_repo;
    protected $requisition_training_repo;


    public function __construct(){

        $this->program_activity_repo =  (new ProgramActivityRepository());
        $this->program_activity_attendance_repo = (new ProgramActivityAttendanceRepository());
        $this->requisition_training_repo =  (new  RequisitionTrainingRepository());
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

    public function getAllValidActivities(){

        return $this->requisition_training_repo->getValidProgramActivity()->whereDate('end_date', '>',Carbon::today())->pluck('program_activity_number', 'id');
    }
    public function submitActivityNumberGetDetails(Request $request){
        $program_activity = $this->program_activity_repo->find($request['id']);

        return requisition_training_cost::query()->where('requisition_training_id', $program_activity->requisition_training_id)->get();
    }

}
