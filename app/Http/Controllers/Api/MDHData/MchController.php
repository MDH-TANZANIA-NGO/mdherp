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
        
        if(Mch::where('form_date',$request['form_date'])->exists()){
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
