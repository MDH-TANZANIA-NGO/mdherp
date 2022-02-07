<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Repositories\System\HolidayRepository;
use Illuminate\Http\Request;

class HolidayController extends Controller
{
    protected $holidays;

    /**
     * HolidayController constructor.
     */
    public function __construct()
    {
        $this->holidays = (new HolidayRepository());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function setting()
    {
        $current_holidays = $this->holidays->getCurrent();
        return view('system.holiday.setting.index')
            ->with('holidays', $current_holidays);
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $this->holidays->update($request->all(), $id);
        alert()->success(__('notifications.holiday.updated'), __('notifications.holiday.title'));
        return redirect()->back();
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
