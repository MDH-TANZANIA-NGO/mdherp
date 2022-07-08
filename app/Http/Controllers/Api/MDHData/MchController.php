<?php

namespace App\Http\Controllers\Api\MDHData;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\MchRepository\MchRepository;
use App\Models\MDHData\Mch;

class MchController extends BaseController
{
    protected $mchs;

    public function __construct()
    {
        $this->mchs = (new MchRepository()); 
    }

    public function store(Request $request)
    {
        $fields = $request->validate([
            'form_date' => 'required',
            'data_clerk_id' => 'required',
            'facility_id' => 'required',
            'total_first_attendance_2ab' => 'required',
            'preg_known_pos_5a' => 'required',
            'preg_1st_test_5c' => 'required',
            'preg_1st_test_pos_5d' => 'required',
            'preg_2nd_test_5h' => 'required',
            'preg_2nd_test_pos_5i' => 'required',
            'hei_registered' => 'required',
            'dbs_taken_at_12_mo' => 'required',
            'dbs_taken_below_2_mo' => 'required',
            'mtuha12_facility_delivery_2a' => 'required',
            'mtuha12_non_facility_delivery_2b' => 'required',
            'mtuha12_traditional_delivery_2c' => 'required',
            'mtuha12_home_delivery_2d' => 'required',
            'mtuha12_total_deliveries_2abcd' => 'required',
        ]);

        if(Mch::where('form_date',$request['form_date'])
            ->where('data_clerk_id', $request['data_clerk_id'])
            ->where('facility_id', $request['facility_id'])->exists()){
            $message = "MCH Ripoti ya tarehe ".$request['form_date'].' umeshaituma tayari';
            return $this->sendError($message, NULL);
        }else{
            $mch = $this->mchs->store($request->all());
            $success['mch'] = $mch;
            return $this->sendResponse($success, "Fomu ya MCH imetumwa vizuri");
        }
    }

    public function getGOfficerMchs($g_officer, $facility){
        $g_officer_mchs = $this->mchs->getGOfficerMchs($g_officer, $facility)
            ->paginate(30);

        $success['paginated_mch_reports'] =  $g_officer_mchs;
        return $this->sendResponse($success, "all G-Officer uploaded MCH Daily Reports");
    }

    public function filterReportsByDate(Request $request)
    {
        $g_officer_mchs = $this->mchs->filterReportsByDate($request->all())
            ->paginate(30);

        $success['paginated_mch_reports'] =  $g_officer_mchs;
        return $this->sendResponse($success, "all G-officer uploaded MCH Reports");
    }
}
