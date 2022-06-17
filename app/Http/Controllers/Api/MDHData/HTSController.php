<?php

namespace App\Http\Controllers\Api\MDHData;

use App\Models\MDHData\Hts;
use Facade\IgnitionContracts\HasSolutionsForThrowable;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\HTSResource as HTSResource;
use Illuminate\Support\Facades\DB;

class HTSController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    public function getGOfficerHTS($g_officer, $facility){
        $g_officer_hts = DB::table("hts")
            ->selectRaw('*')
            ->where('hts.data_clerk_id', '=', $g_officer)
            ->where('hts.facility_id', '=', $facility)
            ->orderBy('hts.form_date', 'DESC')
            ->paginate(30);

        $success['paginated_hts_reports'] =  $g_officer_hts;
        return $this->sendResponse($success, "all G-Officer uploaded HTS Daily Reports");
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
            'tx_new_index_clients' => 'required',
            'tx_curr_index_clients' => 'required',
            'hvl_index_clients' => 'required',
            'total_index_clients' => 'required',
            'tx_new_offered_its' => 'required',
            'hvl_offered_its' => 'required',
            'tx_curr_offered_its' => 'required',
            'tx_new_accepted_its' => 'required',
            'hvl_accepted_its' => 'required',
            'tx_curr_accepted_its' => 'required',
            'tx_new_elicited_index_contacts' => 'required',
            'hvl_elicited_index_contacts' => 'required',
            'tx_curr_elicited_index_contacts' => 'required',
            'tx_new_known_positive' => 'required',
            'hvl_known_positive' => 'required',
            'tx_curr_known_positive' => 'required',
            'tx_new_index_contacts_tested' => 'required',
            'hvl_index_contacts_tested' => 'required',
            'tx_curr_index_contacts_tested' => 'required',
            'tx_new_index_positive' => 'required',
            'hvl_index_positive' => 'required',
            'tx_curr_index_positive' => 'required',
            'tx_new_index_positive_linked' => 'required',
            'hvl_index_positive_linked' => 'required',
            'tx_curr_index_positive_linked' => 'required',
        ]);

        if(Hts::where('form_date',$request['form_date'])->exists()){
            $message = "HTS Ripoti ya tarehe ".$request['form_date'].' umeshaituma tayari';
            return $this->sendError($message, NULL);
        }else{
            $hts = Hts::create([
                'form_date' => $request['form_date'],
                'data_clerk_id' => $fields['data_clerk_id'],
                'facility_id' => $fields['facility_id'],
                'tx_new_index_clients' => $fields['tx_new_index_clients'],
                'tx_curr_index_clients' => $fields['tx_curr_index_clients'],
                'hvl_index_clients' => $fields['hvl_index_clients'],
                'total_index_clients' => $fields['total_index_clients'],
                'tx_new_offered_its' => $fields['tx_new_offered_its'],
                'hvl_offered_its' => $fields['hvl_offered_its'],
                'tx_curr_offered_its' => $fields['tx_curr_offered_its'],
                'tx_new_accepted_its' => $fields['tx_new_accepted_its'],
                'hvl_accepted_its' => $fields['hvl_accepted_its'],
                'tx_curr_accepted_its' => $fields['tx_curr_accepted_its'],
                'tx_new_elicited_index_contacts' => $fields['tx_new_elicited_index_contacts'],
                'hvl_elicited_index_contacts' => $fields['hvl_elicited_index_contacts'],
                'tx_curr_elicited_index_contacts' => $fields['tx_curr_elicited_index_contacts'],
                'tx_new_known_positive' => $fields['tx_new_known_positive'],
                'hvl_known_positive' => $fields['hvl_known_positive'],
                'tx_curr_known_positive' => $fields['tx_curr_known_positive'],
                'tx_new_index_contacts_tested' => $fields['tx_new_index_contacts_tested'],
                'hvl_index_contacts_tested' => $fields['hvl_index_contacts_tested'],
                'tx_curr_index_contacts_tested' => $fields['tx_curr_index_contacts_tested'],
                'tx_new_index_positive' => $fields['tx_new_index_positive'],
                'hvl_index_positive' => $fields['hvl_index_positive'],
                'tx_curr_index_positive' => $fields['tx_curr_index_positive'],
                'tx_new_index_positive_linked' => $fields['tx_new_index_positive_linked'],
                'hvl_index_positive_linked' => $fields['hvl_index_positive_linked'],
                'tx_curr_index_positive_linked' => $fields['tx_curr_index_positive_linked'],
                'acceptance_rate' => $request['acceptance_rate'],
                'elicitation_ratio' => $request['elicitation_ratio'],
                'index_testing_rate' => $request['index_testing_rate'],
                'yield' => $request['yield'],
                'comments' => $request['comments'],
                'latitude' => $request['latitude'],
                'longitude' => $request['longitude'],
                'location' => $request['location'],
                'form_date_time' => $request['form_date_time'],
                'status' => 1,
            ]);

            $success['hts'] = $hts;

            return $this->sendResponse($success, 'HTS Form submitted successfully');
        }
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

    public function filterReportsByDate(Request $request)
    {
        $from = $request['from'];
        $to = $request['to'];
        $g_officer = $request['data_clerk_id'];
        $facility = $request['facility_id'];

        $g_officer_hts = DB::table("hts")
            ->selectRaw('*')
            ->where('hts.data_clerk_id', '=', $g_officer)
            ->where('hts.facility_id', '=', $facility)
            ->whereBetween('hts.form_date', [$from, $to])
            ->orderBy('hts.form_date', 'DESC')
            ->paginate(30);

        $success['paginated_hts_reports'] =  $g_officer_hts;
        return $this->sendResponse($success, "all G-officer uploaded hts Reports");
    }
}
