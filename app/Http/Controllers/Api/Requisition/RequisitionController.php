<?php

namespace App\Http\Controllers\Api;

use App\Models\System\Region;
use App\Repositories\Requisition\RequisitionRepository;
use Illuminate\Http\Request;

class RequisitionController extends BaseController
{
    //
    protected $requisition;
    public function __construct()
    {
        $this->requisition = (new RequisitionRepository());
    }
    public function getRequisitionsByRegion( $region_id)
    {
        $requisitions = $this->requisition->getAllApprovedTrainingNotClosedRequisitionsByRegion($region_id)->get();
        $data['requisitions'] =  $requisitions;
        return $this->sendResponse($data,'requisitions retrieved successfully');
    }
}
