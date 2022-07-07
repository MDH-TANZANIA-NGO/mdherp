<?php

namespace App\Http\Controllers\Web\HumanResource\HireRequisition;

use Illuminate\Http\Request;
use App\Services\Workflow\Workflow;
use App\Http\Controllers\Controller;
use App\Repositories\Access\UserRepository;
use App\Repositories\Workflow\WfTrackRepository;
use App\Repositories\HumanResource\HireRequisition\HrUserHireRequisitionJobShortlisterRequestRepository;
use App\Services\Workflow\Traits\WorkflowInitiator;

class HrUserHireRequisitionJobShortlisterRequestController extends Controller
{
    use WorkflowInitiator;
    protected $job_shortlister_requests;
    protected $users;
    protected $wf_tracks;

    public function __construct()
    {
        $this->job_shortlister_requests = (new HrUserHireRequisitionJobShortlisterRequestRepository());
        $this->users = (new UserRepository());
        $this->wf_tracks = (new WfTrackRepository());
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
    public function initiate($uuid)
    {
        $job_shortlister_request = $this->job_shortlister_requests->findByUuid($uuid);
        return view('HumanResource.HireRequisition.shortlister.initiate')
            ->with('job_shortlister_request', $job_shortlister_request)
            ->with('jobs', $job_shortlister_request->jobs)
            ->with('users', $this->users->pluckWithDesignation());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $job_shortlister_request = $this->job_shortlister_requests->store($request->all());
        alert()->success('Shortlister Added Successfully');
        return redirect()->route('job_shortlister.initiate', $job_shortlister_request);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function submit($job_shortlister_request_uuid)
    {
        $job_shortlister_request = $this->job_shortlister_requests->findByUuid($job_shortlister_request_uuid);
        $next_user_id = (new UserRepository())->getCeo()->first()->user_id;
        $this->startWorkflow($job_shortlister_request, 1, $next_user_id);
        alert()->success('Shortlisters submited to workflow Successfully');
        return redirect()->route('job_shortlister.show', $job_shortlister_request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($job_shortlister_request_uuid)
    {
        $job_shortlister_request = $this->job_shortlister_requests->findByUuid($job_shortlister_request_uuid);
        $wf_module_group_id = $this->getWfModuleGroupId($job_shortlister_request);
        $wf_module = $this->wf_tracks->getWfModuleAfterWorkflowStart($wf_module_group_id, $job_shortlister_request->id);
        $workflow = new Workflow(['wf_module_group_id' => $wf_module_group_id, "resource_id" => $job_shortlister_request->id, 'type' => $wf_module->type]);
        $current_wf_track = $workflow->currentWfTrack();
        $current_level = $workflow->currentLevel();
        $can_edit_resource = $this->wf_tracks->canEditResource($job_shortlister_request, $current_level, $workflow->wf_definition_id);
        return view('HumanResource.HireRequisition.shortlister.show')
            ->with('job_shortlister_request', $job_shortlister_request)
            ->with('jobs', $job_shortlister_request->jobs)
            ->with('users', $this->users->pluckWithDesignation())
            ->with('current_level', $current_level)
            ->with('current_wf_track', $current_wf_track)
            ->with('can_edit_resource', $can_edit_resource)
            ->with('workflows', $workflow)
            ->with('wfTracks', (new WfTrackRepository())->getStatusDescriptions($job_shortlister_request));
    }
}
