<?php

namespace App\Http\Controllers\Api\MDHData;


use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController;
use App\Models\GOfficer\GOfficer;

class FacilityGOfficerController extends BaseController
{
    public function assignUserToFacility(Request  $request)
    {
        $input = $request->all();
        $input['Facility_GOfficer'] = $request->input("Facility_GOfficer");

        $g_officer = GOfficer::find($input['g_officer_id']);

        $result = $g_officer->facilities()->sync($input['facilities']);

        $success['facility_g_officer'] = $result;
        return $this->sendResponse($success, "Facility Successfully Assigned To User");
    }
}
