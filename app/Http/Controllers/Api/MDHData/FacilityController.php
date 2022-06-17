<?php

namespace App\Http\Controllers\Api\MDHData;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\FacilityCategoryResource;
use App\Http\Resources\OwnershipCategoryResource;
use App\Models\Facility\Facility;
use App\Models\Facility\FacilityCategory;
use App\Models\Facility\OwnershipCategory;
use Illuminate\Http\Request;

class FacilityController extends BaseController
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function create()
    {
        $facility_categories = FacilityCategory::all();
        $success['facility_categories'] = FacilityCategoryResource::collection($facility_categories);

        $ownership_categories = OwnershipCategory::all();
        $success['ownership_categories'] = OwnershipCategoryResource::collection($ownership_categories);

        return $this->sendResponse($success, "Facility Details");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required',
            'ward_id' => 'required'
        ]);

        $facility = Facility::create([
            'name' => $fields['name'],
            'common_name' => $request['common_name'],
            'number' => $request['number'],
            'ward_id' => $fields['ward_id'],
            'facility_type_id' => $request['facility_type_id'],
            'ownership_id' => $request['ownership_id'],
            'latitude' => $request['latitude'],
            'longitude' => $request['longitude'],
            'location' => $request['location'],
        ]);

        $success['facility'] = $facility;

        return $this->sendResponse($success, 'Facility added successfully');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
