<?php

namespace App\Http\Controllers\Web\Safari;

use App\Events\NewWorkflow;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\Safari\Datatables\SafariDatatables;
use App\Models\Auth\User;
use App\Models\Requisition\Requisition;
use App\Models\Requisition\Travelling\requisition_travelling_cost;
use App\Models\Retirement\Retirement;
use App\Models\SafariAdvance\SafariAdvance;
use App\Repositories\Hotel\HotelRepository;
use App\Repositories\Requisition\RequisitionRepository;
use App\Repositories\Requisition\Travelling\RequestTravellingCostRepository;
use App\Repositories\Retirement\RetirementRepository;
use App\Repositories\SafariAdvance\SafariAdvanceRepository;

use App\Repositories\System\DistrictRepository;
use App\Repositories\Unit\DesignationRepository;
use App\Repositories\Workflow\WfTrackRepository;
use App\Services\Generator\Number;
use App\Services\Workflow\Workflow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SafariController extends Controller
{
    use Number, SafariDatatables;
    protected $travellingCost;
    protected $safariAdvance;
    protected $districts;
    protected $wf_tracks;
    protected $designations;
    protected $hotel;

    public function __construct()
    {
        $this->travellingCost = (new RequestTravellingCostRepository());
        $this->safariAdvance =  (new SafariAdvanceRepository());
        $this->districts = (new  DistrictRepository());
        $this->wf_tracks = (new WfTrackRepository());
        $this->designations = (new DesignationRepository());
        $this->hotel = (new HotelRepository());
    }


    public function index()
    {
        return view('safari.index')
            ->with('safariAdvance', $this->safariAdvance);
    }

    public  function  create(SafariAdvance $safariAdvance)
    {
        $district_id = $safariAdvance->travellingCost()->first()->district_id;
        return view('safari.forms.create')
            ->with('hotels', $this->hotel->getHotelByDistrict($district_id)->pluck('name', 'id'))
            ->with('travelling_cost', $safariAdvance->travellingCost)
            ->with('district', $this->districts->getForPluck())
            ->with('safari_advance', $safariAdvance);
    }
    public  function  edit(SafariAdvance $safariAdvance)
    {


        return view('safari.forms.edit')
            ->with('safari_advance_details', $safariAdvance->SafariDetails()->first())
            ->with('travelling_cost', $safariAdvance->travellingCost)
            ->with('district', $this->districts->getForPluck())
            ->with('safari_advance', $safariAdvance);
    }
    public  function  initiate()
    {
        $retirements =  Retirement::query()->where('user_id', access()->user()->id)->where('wf_done', '=', false);

//dd($this->travellingCost->getRequisition()->get());
        return view('safari.forms.initiate')
            ->with('travelling_costs', $this->travellingCost->getPluckRequisitionNo())
            ->with('safari_not_retired', $this->safariAdvance->getCompletedWithoutRetirement()->count())
            ->with('retired_not_approved', $retirements);
    }
    public function store(Request $request)
    {
         $safari = $this->safariAdvance->store($request->all());
        return redirect()->route('safari.create', $safari);
    }


    public function update(Request $request, $uuid)
    {
        $safari_advance_done = SafariAdvance::where('uuid', $uuid)->first()->done;

        $requisition_travelling_cost_details = requisition_travelling_cost::query()->where('id', SafariAdvance::query()->where('id', $request->get('safari_advance_id'))->first()->requisition_travelling_cost_id)->first();
        $from = $request->get('from');
        $to = $request->get('to');
        $datetime1 = new \DateTime($from);
        $datetime2 = new  \DateTime($to);
        $interval = $datetime1->diff($datetime2);
        $days = $interval->format('%a');
        $days_int = (int)$days;
       if ($safari_advance_done == true)
       {
           if ($days_int > $requisition_travelling_cost_details->no_days){
               alert()->error('Number of Days are over days requested');
               return redirect()->back();
           }else{
               $this->safariAdvance->update($request->all(),$uuid);
               alert()->success('Safari Advance updated Successfully','Success');
               return redirect()->route('safari.show',$uuid);
           }

       }
       else{
           if ($days_int > $requisition_travelling_cost_details->no_days){
               alert()->error('Number of Days are over days requested');
               return redirect()->back();
           }
           else{
               $this->safariAdvance->update($request->all(),$uuid);
               $safari = $this->safariAdvance->findByUuid($uuid);
               $wf_module_group_id = 2;
               $next_user = $safari->user->assignedSupervisor()->supervisor_id;
               event(new NewWorkflow(['wf_module_group_id' => $wf_module_group_id, 'resource_id' => $safari->id,'region_id' => $safari->region_id, 'type' => 1],[],['next_user_id' => $next_user]));
               alert()->success('Safari Advance Submitted Successfully','Success');
               return redirect()->route('safari.show',$uuid);
           }

       }

    }
    public function show(SafariAdvance $safariAdvance)
    {
        /* Check workflow */
        $wf_module_group_id = 2;
        $wf_module = $this->wf_tracks->getWfModuleAfterWorkflowStart($wf_module_group_id, $safariAdvance->id);
        $workflow = new Workflow(['wf_module_group_id' => $wf_module_group_id, "resource_id" => $safariAdvance->id, 'type' => $wf_module->type]);
        $check_workflow = $workflow->checkIfHasWorkflow();
        $current_wf_track = $workflow->currentWfTrack();
        $wf_module_id = $workflow->wf_module_id;
        $current_level = $workflow->currentLevel();
        $can_edit_resource = $this->wf_tracks->canEditResource($safariAdvance, $current_level, $workflow->wf_definition_id);

        $designation = access()->user()->designation_id;
//        $getUnit = $designation->unit()->id;

        return view('safari.show')
            ->with('current_level', $current_level)
            ->with('current_wf_track', $current_wf_track)
            ->with('can_edit_resource', $can_edit_resource)
            ->with('wfTracks', (new WfTrackRepository())->getStatusDescriptions($safariAdvance))
            ->with('safari', $safariAdvance)
            ->with('safari_details',$safariAdvance->SafariDetails()->getQuery()->get()->all())
            ->with('unit', $this->designations->getQueryDesignationUnit()->find($designation));
    }
    public function payment(Request $request, $uuid)
    {
        $this->safariAdvance->payment($request->all(), $uuid);
        return redirect()->back();
    }

}
