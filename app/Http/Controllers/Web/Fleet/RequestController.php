<?php

namespace App\Http\Controllers\Web\Fleet;

use App\Events\NewWorkflow;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\Fleet\Traits\FleetDatatables;
use App\Models\FilesAttachment\FilesAttachment;
use App\Models\Fleet\FleetRequest;
use App\Repositories\Fleet\FleetRepository;
use App\Repositories\SafariAdvance\SafariAdvanceRepository;
use App\Repositories\System\DistrictRepository;
use App\Repositories\Workflow\WfTrackRepository;
use App\Services\Generator\Number;
use App\Services\Workflow\Workflow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\File\File;


class RequestController extends Controller
{
    use Number, FleetDatatables;
    protected $wf_tracks;
    protected $designations;
    protected $fleet_requests;

    public function __construct()
    {
        $this->fleet_requests = (new FleetRepository());
        $this->wf_tracks = (new WfTrackRepository());
    }

   


    public function index()
    {
        return  view('fleet.index')
            ->with('fleet_requests', $this->fleet_requests);
       
    }

    // public  function  initiate(FleetRepository $fleetRepository)
    // {
    //     return view('fleet.forms.initiate');
    // }

    public  function  create(FleetRequest $fleet)
    {
        return view('fleet.request')
            ->with('fleet', $fleet);
    }



    public  function  edit($uuid)
    {
        $fleet = FleetRequest::query()->where('uuid',$uuid)->first();
        
        return view('fleet.edit')
            ->with('car', $fleet);
           
    }

    public function store(Request $request)
    {
        $car = $request->all();
        $id = FleetRequest::create($car)->id;
        $fleet_request = FleetRequest::query()->where('id',$id)->first();
     
        $wf_module_group_id = 10;
        $next_user = $fleet_request->user->assignedSupervisor()->supervisor_id;

        event(new NewWorkflow(['wf_module_group_id' => $wf_module_group_id, 'resource_id' => $fleet_request->id, 'region_id' => $fleet_request->region_id, 'type' => 1], [], ['next_user_id' => $next_user]));
        return view('fleet.request', compact('car'));
        
    }

    
    public function show(FleetRequest $fleetrequest)
    {

        $wf_module_group_id = 10;
        $wf_module = $this->wf_tracks->getWfModuleAfterWorkflowStart($wf_module_group_id, $fleetrequest->id);
        $workflow = new Workflow(['wf_module_group_id' => $wf_module_group_id, "resource_id" => $fleetrequest->id, 'type' => $wf_module->type]);
        $check_workflow = $workflow->checkIfHasWorkflow();
        $current_wf_track = $workflow->currentWfTrack();
        $wf_module_id = $workflow->wf_module_id;
        $current_level = $workflow->currentLevel();
        $can_edit_resource = $this->wf_tracks->canEditResource($fleetrequest, $current_level, $workflow->wf_definition_id);

        $designation = access()->user()->designation_id;

        $fleets = $this->fleet_requests = (new FleetRepository());


        return view('fleet.show')
            ->with('current_level', $current_level)
            ->with('current_wf_track', $current_wf_track)
            ->with('can_edit_resource', $can_edit_resource)
            ->with('wfTracks', (new WfTrackRepository())->getStatusDescriptions($fleetrequest))
            ->with('fleetrequest', $fleetrequest);
            
    }


    public function flee()
    {
        return view('fleet.flee');
    }
}
