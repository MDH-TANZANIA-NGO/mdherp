<?php

namespace App\Http\Controllers\Api\MDHData;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\CountryResource as CountryResource;
use App\Models\System\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CountryController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $countries = Country::all();
        $success['countries'] = CountryResource::collection($countries);
        return $this->sendResponse($success, "all countries");
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
        $regions = DB::table('regions')
            ->selectRaw('regions.id as id')
            ->selectRaw('regions.name as name')
            ->selectRaw('regions.country_id as country_id')
            ->selectRaw('countries.name as country_name')
            ->selectRaw('regions.zone_id as zone_id')
            ->selectRaw('zones.name as zone_name')
            ->selectRaw('count(districts.region_id) as total_districts')
            ->selectRaw('count(wards.district_id) as total_wards')
            ->selectRaw('count(facilities.ward_id) as total_facilities')
            ->selectRaw('regions.isactive as isactive')
            ->selectRaw('regions.created_at as created_at')
            ->selectRaw('regions.updated_at as updated_at')
            ->leftJoin('zones', 'zones.id', '=', 'regions.zone_id')
            ->leftJoin('countries', 'countries.id', '=', 'regions.country_id')
            ->leftJoin('districts', 'districts.region_id', '=', 'regions.id')
            ->leftJoin('wards', 'wards.district_id', '=', 'districts.id')
            ->leftJoin('facilities', 'facilities.ward_id', '=', 'wards.id')
            ->where('regions.country_id', $id)
            ->groupBy('regions.id', 'regions.name', 'regions.country_id', 'regions.zone_id', 'regions.isactive', 'regions.created_at',
                'regions.updated_at','countries.name', 'zones.name')
            ->orderBy('regions.name', 'ASC')
            ->get();

        $success['regions'] = $regions;
        return $this->sendResponse($success, "all country regions");
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
