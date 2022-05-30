<?php

namespace App\Http\Controllers\Api\MDHData;


use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController;
use App\Models\GOfficer\GOfficer;

class FacilityGOfficerController extends BaseController
{
    public function assignUserToFacility(Request $request)
    {
        $content = json_encode($request->all());
        $data = json_decode($content, true);
        
        $g_officer = GOfficer::find($data['g_officer_id']);

        $result = $g_officer->facilities()->sync($data['facilities']);

        $success['facility_g_officer'] = $result;
        return $this->sendResponse($success, "Facility Successfully Assigned To User");
    }
}
