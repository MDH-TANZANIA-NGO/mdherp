<?php

namespace App\Http\Controllers\Web\HumanResource\HireRequisition;

use Illuminate\Http\Request;
use App\Services\Workflow\Workflow;
use App\Http\Controllers\Controller;
use App\Repositories\Access\UserRepository;
use App\Repositories\Workflow\WfTrackRepository;
use App\Services\Workflow\Traits\WorkflowInitiator;
use App\Repositories\HumanResource\HireRequisition\HrHireRequisitionJobApplicantRequestRepository;

class HrHireRequisitionJobApplicantRequestController extends Controller
{
    use WorkflowInitiator;
    protected $hr_hire_job_app_requests;
    protected $users;

    public function __construct()
    {
        $this->hr_hire_job_app_requests = (new HrHireRequisitionJobApplicantRequestRepository());
        $this->users = (new UserRepository());
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $hr_hire_job_app_request=$this->hr_hire_job_app_requests->store($request->all());
        $this->startWorkflow($hr_hire_job_app_request,1,$this->users->getCeo()->first()->user_id);
        alert()->success('');
        return redirect()->route('');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        $hr_hire_job_app_request=$this->hr_hire_job_app_requests->findByUuid($uuid);
        $wf_module_group_id = $this->getWfModuleGroupId($hr_hire_job_app_request);
        $wf_module = $this->wf_tracks->getWfModuleAfterWorkflowStart($wf_module_group_id, $hr_hire_job_app_request->id);
        $workflow = new Workflow(['wf_module_group_id' => $wf_module_group_id, "resource_id" => $hr_hire_job_app_request->id, 'type' => $wf_module->type]);
        $current_wf_track = $workflow->currentWfTrack();
        $current_level = $workflow->currentLevel();
        $can_edit_resource = $this->wf_tracks->canEditResource($hr_hire_job_app_request, $current_level, $workflow->wf_definition_id);
        return view()
        ->with('hr_hire_job_app_request', $hr_hire_job_app_request)
        ->with('current_level', $current_level)
            ->with('current_wf_track', $current_wf_track)
            ->with('can_edit_resource', $can_edit_resource)
            ->with('workflows', $workflow)
            ->with('wfTracks', (new WfTrackRepository())->getStatusDescriptions($hr_hire_job_app_request));
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
