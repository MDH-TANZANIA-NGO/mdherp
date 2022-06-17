<?php

namespace App\Http\Controllers\Api\MDHData;

use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegionController extends BaseController
{
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $districts = DB::table('districts')
            ->selectRaw('districts.id as id')
            ->selectRaw('districts.name as name')
            ->selectRaw('districts.region_id as region_id')
            ->selectRaw('count(wards.district_id) as total_wards')
            ->selectRaw('count(facilities.ward_id) as total_facilities')
            ->selectRaw('districts.isactive as isactive')
            ->selectRaw('districts.created_at as created_at')
            ->selectRaw('districts.updated_at as updated_at')
            ->leftJoin('wards', 'wards.district_id', '=', 'districts.id')
            ->leftJoin('facilities', 'facilities.ward_id', '=', 'wards.id')
            ->where('districts.region_id', $id)
            ->groupBy('districts.id', 'districts.name', 'districts.region_id', 'districts.isactive', 'districts.created_at',
                'districts.updated_at')
            ->get();





//        $success['districts'] = DistrictResource::collection($districts);
        $success['districts'] = $districts;
        return $this->sendResponse($success, "districts");
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
