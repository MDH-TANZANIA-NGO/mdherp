<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Repositories\System\SystemAttendanceRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SystemAttendanceController extends Controller
{

    protected $attendances;

    public function __construct()
    {
        $this->attendances = (new SystemAttendanceRepository());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function attend(Request $request)
    {
        $this->attendances->attend(Carbon::now()->format('Y-m-d H:i:s'));
        alert()->success(__('Collected Successfully'), __('Attendance'));
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

}
