<?php

namespace App\Http\Controllers\Api\MDHData;

use Illuminate\Http\Request;
use App\Models\MDHData\Covid;
use App\Http\Controllers\Api\BaseController;
use Illuminate\Support\Facades\DB;

class CovidController extends BaseController
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

    public function getGOfficerCovid($g_officer, $facility){
        $g_officer_covids = DB::table("covids")
            ->selectRaw('*')
            ->where('covids.data_clerk_id', '=', $g_officer)
            ->where('covids.facility_id', '=', $facility)
            ->paginate(10);

        $success['paginated_covid_reports'] =  $g_officer_covids;
        return $this->sendResponse($success, "all G-officer uploaded Covid-19 Reports");
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
        $fields = $request->validate([
            'form_date' => 'required',
            'data_clerk_id' => 'required',
            'facility_id' => 'required',
            'attended' => 'required',
            'already_vaccinated' => 'required',
            'vaccine_eligible' => 'required',
            'vaccinated' => 'required',
            'vaccinated_community_art' => 'required',
            'vaccinated_konga' => 'required',
            'vaccinated_home_based' => 'required',
            'vaccinated_routine_fcd' => 'required',
            'vaccinated_cbs' => 'required',
            'vaccinated_others' => 'required',
            'JJ_used' => 'required',
            'MD_used' => 'required',
            'PF_used' => 'required',
            'SN_used' => 'required',
            'JJ_expired' => 'required',
            'MD_expired' => 'required',
            'PF_expired' => 'required',
            'SN_expired' => 'required',
            'JJ_available' => 'required',
            'MD_available' => 'required',
            'PF_available' => 'required',
            'SN_available' => 'required',
        ]);

        $covid = Covid::create([
            'form_date' => $request['form_date'],
            'data_clerk_id' => $fields['data_clerk_id'],
            'facility_id' => $fields['facility_id'],
            'attended' => $fields['attended'],
            'already_vaccinated' => $fields['already_vaccinated'],
            'vaccine_eligible' => $fields['vaccine_eligible'],
            'vaccinated' => $fields['vaccinated'],
            'vaccinated_community_art' => $fields['vaccinated_community_art'],
            'vaccinated_konga' => $fields['vaccinated_konga'],
            'vaccinated_home_based' => $fields['vaccinated_home_based'],
            'vaccinated_routine_fcd' => $fields['vaccinated_routine_fcd'],
            'vaccinated_cbs' => $fields['vaccinated_cbs'],
            'vaccinated_others' => $fields['vaccinated_others'],
            'JJ_used' => $fields['JJ_used'],
            'MD_used' => $fields['MD_used'],
            'PF_used' => $fields['PF_used'],
            'SN_used' => $fields['SN_used'],
            'JJ_expired' => $fields['JJ_expired'],
            'MD_expired' => $fields['MD_expired'],
            'PF_expired' => $fields['PF_expired'],
            'SN_expired' => $fields['SN_expired'],
            'JJ_available' => $fields['JJ_available'],
            'MD_available' => $fields['MD_available'],
            'PF_available' => $fields['PF_available'],
            'SN_available' => $fields['SN_available'],
            'comments' => $request['comments'],
            'latitude' => $request['latitude'],
            'longitude' => $request['longitude'],
            'location' => $request['location'],
            'form_date_time' => $request['form_date_time'],
            'status' => 1,
        ]);

        $success['covid'] = $covid;

        return $this->sendResponse($success, 'Covid-19 Form submitted successfully');
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
