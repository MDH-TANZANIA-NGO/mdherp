<?php

namespace App\Http\Controllers\Api\Recruitment\Advertisement;

use App\Http\Controllers\Api\BaseController;
use App\Models\HumanResource\Advertisement\HireAdvertisementRequisition;
use App\Repositories\HumanResource\Advertisement\AdvertisementRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdvertisementController extends BaseController
{
    public $advertisementRepository;
    public function __construct(AdvertisementRepository $advertisementRepository)
    {
        $this->advertisementRepository = $advertisementRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->advertisementRepository
                        ->getQuery()
                        ->where('wf_done',1)
                        ->where('done',1)
                        ->where('rejected',0)
                        ->get();
        $data->map(function($item){
            $item['skills'] = DB::table('skill_user')->where('hr_requisition_job_id',$item['hire_requisition_id'])->get();
            $item['jobs'] = DB::table('hr_hire_requisitions_jobs')->where('id',$item['hire_requisition_job_id'])->get();
        });
        $response['advertisements'] = $data;
        return $this->sendResponse($response,"Advertisement",200);

    }

    public function getJobs()
    {
        return $this->advertisementRepository
            ->getQuery()
            ->where('wf_done', 1)
            ->where('done', 1)
            ->where('rejected', 0)
            ->get();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(HireAdvertisementRequisition $advertisement)
    {
        $response['advertisement'] =  $advertisement;
        return $this->sendResponse($response,"Advertisement",200);

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
