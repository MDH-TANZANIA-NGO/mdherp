<?php

namespace App\Http\Controllers\web\Safari;

use App\Events\NewWorkflow;
use App\Http\Controllers\Controller;
use App\Models\Auth\User;
use App\Models\Requisition\Requisition;
use App\Models\SafariAdvance\SafariAdvance;
use App\Repositories\Requisition\RequisitionRepository;
use App\Repositories\Requisition\Travelling\RequestTravellingCostRepository;
use App\Repositories\SafariAdvance\SafariAdvanceRepository;

use App\Repositories\System\DistrictRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SafariController extends Controller
{
    protected $travellingCost;
    protected $safariAdvance;
    protected $districts;


    public function __construct()
    {
        $this->travellingCost = (new RequestTravellingCostRepository());
        $this->safariAdvance =  (new SafariAdvanceRepository());
        $this->districts = (new  DistrictRepository());
    }

    public function index()
    {
        return view('safari.index')
           ;
    }

    public  function  create(SafariAdvance $safariAdvance)
    {

        return view('safari.forms.create')

            ->with('travelling_cost', $safariAdvance->travellingCost)
            ->with('district', $this->districts->getForPluck());
    }
    public  function  initiate()
    {

        return view('safari.forms.initiate')
            ->with('travelling_costs', $this->travellingCost->getPluckRequisitionNo());
    }
    public function store(Request $request)
    {
         $safari = $this->safariAdvance->store($request->all());
        return redirect()->route('safari.create', $safari);
    }

    public function dummySubmit()
    {
        $safari = SafariAdvance::query()->find(1);
        $wf_module_group_id = 5;
        $next_user = $safari->user->assignedSupervisor()->supervisor_id;
        event(new NewWorkflow(['wf_module_group_id' => $wf_module_group_id, 'resource_id' => $safari->id,'region_id' => $safari->region_id, 'type' => 1],[],['next_user_id' => $next_user]));
    }

}
