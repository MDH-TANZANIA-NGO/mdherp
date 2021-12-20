<?php

namespace App\Http\Controllers\web\Safari;

use App\Http\Controllers\Controller;
use App\Models\Auth\User;
use App\Models\Requisition\Requisition;
use App\Repositories\Requisition\RequisitionRepository;
use App\Repositories\Requisition\Travelling\RequestTravellingCostRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SafariController extends Controller
{
    protected $travellingCost;


    public function __construct()
    {
        $this->travellingCost = (new RequestTravellingCostRepository());
    }

    public function index()
    {
        return view('safari.index')
           ;
    }

    public  function  create()
    {
//        dd($this->travellingCost->getPluckRequisitionNo());

        return view('safari.forms.initiate')
            ->with('travelling_costs', $this->travellingCost->getPluckRequisitionNo());
    }
    public  function  initiate()
    {
        return view('safari.forms.create');
    }
}
