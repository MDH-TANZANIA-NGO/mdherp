<?php

namespace App\Http\Controllers\web\Safari;

use App\Events\NewWorkflow;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\Safari\Datatables\SafariDatatables;
use App\Models\Auth\User;
use App\Models\Requisition\Requisition;
use App\Models\SafariAdvance\SafariAdvance;
use App\Repositories\Requisition\RequisitionRepository;
use App\Repositories\Requisition\Travelling\RequestTravellingCostRepository;
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

    public function __construct()
    {
        $this->travellingCost = (new RequestTravellingCostRepository());
        $this->safariAdvance =  (new SafariAdvanceRepository());
        $this->districts = (new  DistrictRepository());
        $this->wf_tracks = (new WfTrackRepository());
        $this->designations = (new DesignationRepository());
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
            ->with('district', $this->districts->getForPluck())
            ->with('safari_advance', $safariAdvance);
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
        $wf_module_group_id = 2;
        $next_user = $safari->user->assignedSupervisor()->supervisor_id;
        event(new NewWorkflow(['wf_module_group_id' => $wf_module_group_id, 'resource_id' => $safari->id,'region_id' => $safari->region_id, 'type' => 1],[],['next_user_id' => $next_user]));
    }
    public function update(Request $request, $uuid)
    {
        $this->safariAdvance->update($request->all(),$uuid);
        $safari = $this->safariAdvance->findByUuid($uuid);
        $wf_module_group_id = 2;
        $next_user = $safari->user->assignedSupervisor()->supervisor_id;
        event(new NewWorkflow(['wf_module_group_id' => $wf_module_group_id, 'resource_id' => $safari->id,'region_id' => $safari->region_id, 'type' => 1],[],['next_user_id' => $next_user]));
        return redirect()->route('safari.show',$uuid);
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
