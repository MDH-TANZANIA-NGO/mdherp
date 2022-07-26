<?php

namespace App\Http\Controllers\Api\Attendance;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Attendance\Hotspot;
use App\Repositories\Attendance\ActivityAttendanceRepository;
use Illuminate\Http\Request;

class ActivityAttendanceController extends BaseController
{
    //

    protected $attendances;

    public function __construct()
    {
        $this->attendances = (new ActivityAttendanceRepository());
    }
    public function store(Request $request)
    {
        $attendance = $this->attendances->returnStore($request->all());
        return $this->sendResponse($attendance->data,$attendance->message,$attendance->code);
    }
    public function allByHotspot(Hotspot $hotspot)
    {
        $attendances = $this->attendances->allByHotspot($hotspot)->get();
        $data['attendance_list'] = $attendances;
        return $this->sendResponse($data,'Attendances retrieved Successfully');
    }

}
