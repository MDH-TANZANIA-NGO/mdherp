<?php

namespace App\Http\Controllers\Api\Recruitment\Advertisement;

use App\Http\Controllers\Api\BaseController;
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
        $data['advertisement']= $this->advertisementRepository
                        ->getQuery()
                        ->where('wf_done',1)
                        ->where('done',1)
                        ->where('rejected',0)
                        ->get();
        return $this->sendResponse($data,"Advertisement",200);

    }

    public function getJobs(){
        return $this->advertisementRepository
            ->getQuery()
            ->where('wf_done',1)
            ->where('done',1)
            ->where('rejected',0)
            ->get();
    }
}
