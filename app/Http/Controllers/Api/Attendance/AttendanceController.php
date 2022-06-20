<?php

namespace App\Http\Controllers\Api\Attendance;

use App\Http\Controllers\Api\BaseController;
use App\Models\Attendance\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendanceController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'checkin_time' => 'required'
        ]);

        $fields = $request->all();

        // check if the attendance already exists
        $attendance = Attendance::where([
            ['user_id', $fields['user_id']],
            ['checkin_time', $fields['checkin_time']]
        ])->first();

        if($attendance){
            return $this->sendError('Attendance already exists', ['error' => 'Attendance already exists']);
        }

        $attendance = Attendance::create([
            'user_id' => $fields['user_id'],
            'checkin_time' => $fields['checkin_time'],
            'checkin_latitude' => $fields['checkin_latitude'],
            'checkin_longitude' => $fields['checkin_longitude'],
            'checkin_location' => $fields['checkin_location'],
            'checkout_time' => $fields['checkout_time'],
            'checkout_latitude' => $fields['checkout_latitude'],
            'checkout_longitude' => $fields['checkout_longitude'],
            'checkout_location' => $fields['checkout_location'],
            'description' => $fields['description']
        ]);

        return $this->sendResponse($attendance, "Attendance created successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user_attendances = DB::table("attendances")
            ->selectRaw('user_id, checkin_time, checkin_latitude, checkin_longitude, checkin_location
            , checkout_time, checkout_latitude, checkout_longitude, checkout_location, description')
            ->where('user_id', $id)
            ->orderBy('attendances.checkin_time', 'ASC')
            ->paginate(20);

        $success['paginated_attendances'] = $user_attendances;
        return $this->sendResponse($success, 'All user attendances');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
