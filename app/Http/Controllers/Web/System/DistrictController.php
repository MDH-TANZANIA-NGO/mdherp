<?php

namespace App\Http\Controllers\System;

use App\Models\System\District;
use App\Repositories\System\DistrictRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class DistrictController extends Controller
{
    protected $district;

    /**
     * DistrictController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->district = (new DistrictRepository());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function search()
    {
        $input = request()->all();
        return $this->district->getForSelect($input['q'], $input['page']);
    }

    public function searchByRegion($region)
    {
        return $this->district->getForPluckFilterByRegion($region);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param District $district
     * @return void
     */
    public function updateSeparate(Request $request, District $district)
    {
        $this->district->updateSeparate($district, $request->all());
        alert()->success(__('notifications.district.updated'), __('notifications.district.title'));
        return redirect()->back();
    }
}
