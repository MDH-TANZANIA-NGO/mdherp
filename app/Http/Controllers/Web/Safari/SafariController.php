<?php

namespace App\Http\Controllers\web\Safari;

use App\Http\Controllers\Controller;
use App\Models\Auth\User;
use App\Models\Requisition\Requisition;
use App\Repositories\Requisition\RequisitionRepository;
use App\Repositories\Requisition\Travelling\RequestTravellingCostRepository;
use App\Repositories\SafariAdvance\SafariAdvanceRepository;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SafariController extends Controller
{
    protected $travellingCost;
    protected $safariAdvance;


    public function __construct()
    {
        $this->travellingCost = (new RequestTravellingCostRepository());
        $this->safariAdvance =  (new SafariAdvanceRepository());
    }

    public function index()
    {
        return view('safari.index')
           ;
    }

    public  function  create()
    {
        return view('safari.forms.create')

            ->with('details', $this->travellingCost->getRequisition());


    }
    public  function  initiate()
    {

        return view('safari.forms.initiate')
            ->with('travelling_costs', $this->travellingCost->getPluckRequisitionNo());
    }
    public function store(Request $request)
    {
         $safari = $this->safariAdvance->store($request->all());
        return redirect()->route('safari.create', [$safari]);
    }
}
