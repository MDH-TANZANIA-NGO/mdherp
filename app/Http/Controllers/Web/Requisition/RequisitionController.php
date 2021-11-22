<?php

namespace App\Http\Controllers\Web\Requisition;

use App\Events\NewWorkflow;
use App\Http\Controllers\Controller;
use App\Models\Requisition\Requisition;
use App\Repositories\Project\ProjectRepository;
use App\Repositories\Requisition\Equipment\EquipmentRepository;
use App\Repositories\Requisition\RequisitionRepository;
use App\Repositories\Requisition\RequisitionType\RequisitionTypeRepository;
use App\Repositories\System\DistrictRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RequisitionController extends Controller
{
    protected $requisitions;
    protected $requisition_types;
    protected $projects;
    protected $equipments;
    protected $districts;

    public function __construct()
    {
        $this->requisitions = (new RequisitionRepository());
        $this->requisition_types = (new RequisitionTypeRepository());
        $this->projects = (new ProjectRepository());
        $this->equipments = (new EquipmentRepository());
        $this->districts = (new DistrictRepository());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('requisition._parent.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('requisition._parent.form.create')
            ->with('requisition_types', $this->requisition_types->getAll()->pluck('title','id'))
            ->with('projects', $this->projects->getAccessUserProjectsPluck());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $requisition = $this->requisitions->store($request->all());
        return redirect()->route('requisition.initiate',[$requisition]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function initiate(Requisition $requisition)
    {
        return view('requisition._parent.form.initiate')
            ->with('requisition', $requisition)
            ->with('items', $requisition->items)
            ->with('equipments', $this->equipments->getQuery()->get()->pluck('title','id'))
            ->with('districts', $this->districts->getForPluck());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Requisition $requisition)
    {
//        $purchase_requisition = $this->purchase_requisitions->findByUuid($uuid);
//        /* Check workflow */
//        $wf_module_group_id = 7;
//        $wf_module = $this->wf_tracks->getWfModuleAfterWorkflowStart($wf_module_group_id, $purchase_requisition->id);
//        $workflow = new Workflow(['wf_module_group_id' => $wf_module_group_id, "resource_id" => $purchase_requisition->id, 'type' => $wf_module->type]);
//        $check_workflow = $workflow->checkIfHasWorkflow();
//        $current_wf_track = $workflow->currentWfTrack();
//        $wf_module_id = $workflow->wf_module_id;
//        $current_level = $workflow->currentLevel();
//        $can_edit_resource = $this->wf_tracks->canEditResource($purchase_requisition, $current_level, $workflow->wf_definition_id);
//        return view('procurement.purchase_requisition.display.view')
//            ->with('purchase_requisition', $purchase_requisition)
//            ->with('current_level', $current_level)
//            ->with('current_wf_track', $current_wf_track)
//            ->with('can_edit_resource', $can_edit_resource)
//            ->with('wfTracks', (new WfTrackRepository())->getStatusDescriptions($purchase_requisition))
//            ->with('components', $this->components->getActive()->pluck('name', 'id'))
//            ->with('purchase_requisition_types', $this->purchase_requisition_types->getActivePluck());
//            ->with('users', $this->users->getAllPluck())

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submit(Requisition $requisition)
    {
        DB::transaction(function () use ($requisition){
            $this->requisitions->updateDoneAssignNextUserIdAndGenerateNumber($requisition);
            $wf_module_group_id = 1;
            $type = 1;
            event(new NewWorkflow(['wf_module_group_id' => $wf_module_group_id, 'resource_id' => $requisition->id,'region_id' => $requisition->region_id, 'type' => $type],[],['next_user_id' => []]));
        });
        alert()->success(__('Submitted Successfully'), __('Purchase Requisition'));
        return redirect()->route('procurement.purchase_requisition.show', $requisition->uuid);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $requisition_type_id
     * @param $project_id
     * @param $activity_id
     * @param $region_id
     * @param $fiscal_year
     * @return \Illuminate\Http\JsonResponse
     */
    public function getResultsJson(Request $request)
    {
        $requisition_type_id = $request->only('requisition_type_id');
        $project_id = $request->only('project_id');
        $activity_id = $request->only('activity_id');
        $region_id = $request->only('region_id');
        $fiscal_year = $request->only('fiscal_year');
        return response()->json($this->requisitions->getResults($requisition_type_id, $project_id, $activity_id, $region_id, $fiscal_year));
    }
}
