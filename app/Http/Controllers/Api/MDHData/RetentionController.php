<?php

namespace App\Http\Controllers\Api\MDHData;

use App\Http\Controllers\Api\BaseController;
use App\Repositories\RetentionRepository\RetentionRepository;
use App\Models\MDHData\Retention;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RetentionController extends BaseController
{
    protected $retentions;

    public function __construct()
    {
        $this->retentions = (new RetentionRepository()); 
    }
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
        
        if(Retention::where('form_date',$request['form_date'])->exists()){
            $message = "Retention Ripoti ya tarehe ".$request['form_date'].' umeshaituma tayari';
            return $this->sendError($message, NULL);
        }else{
            $retention = $this->retentions->store($request->all());
            $success['retention'] = $retention;
            return $this->sendResponse($success, "Fomu ya Retention imetumwa vizuri");
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

    public function getGOfficerRetentions($g_officer, $facility){
        $g_officer_retentions = $this->retentions->getGOfficerRetentions($g_officer, $facility)
            ->paginate(30);

        $success['paginated_retention_reports'] =  $g_officer_retentions;
        return $this->sendResponse($success, "all G-Officer uploaded Retentions Daily Reports");
    }

    public function filterReportsByDate(Request $request)
    {
        $g_officer_retentions = $this->retentions->filterReportsByDate($request->all())
            ->paginate(30);

        $success['paginated_retention_reports'] =  $g_officer_retentions;
        return $this->sendResponse($success, "all G-officer uploaded retention Reports");
    }
    
}
