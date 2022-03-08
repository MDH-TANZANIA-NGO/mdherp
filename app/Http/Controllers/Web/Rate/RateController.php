<?php

namespace App\Http\Controllers\Web\Rate;

use App\Http\Controllers\Controller;
use App\Http\Requests\Rate\RateRequest;
use App\Repositories\Rate\RateRepository;
use Illuminate\Support\Facades\DB;
use App\Services\Workflow\Workflow;
use App\Repositories\Workflow\WfTrackRepository;

class RateController extends Controller
{

    protected $rates;
    protected $wf_tracks;

    public function __construct()
    {
        $this->rates = (new RateRepository());
        $this->wf_tracks = (new WfTrackRepository());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('rate.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('rate.form.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RateRequest $request)
    {
        $this->rates->store($request->all());
        alert()->success(__('Stored Successfully'), __('Rate'));
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function submit(Rate $rate)
    {
        DB::transaction(function () use ($rate){
            $this->rate->updateDoneAssignNextUserIdAndGenerateNumber($rate);
            $wf_module_group_id = 1;
            $type=1;
            $next_user = null;
            event(new NewWorkflow(['wf_module_group_id' => $wf_module_group_id, 'resource_id' => $rate->id,'region_id' => null, 'type' => $type],[],['next_user_id' => $next_user]));
        });
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Rate $rate)
    {
        /* Check workflow */
        $wf_module_group_id = 1;
        $wf_module = $this->wf_tracks->getWfModuleAfterWorkflowStart($wf_module_group_id, $rate->id);
        $workflow = new Workflow(['wf_module_group_id' => $wf_module_group_id, "resource_id" => $rate->id, 'type' => $wf_module->type]);
        $check_workflow = $workflow->checkIfHasWorkflow();
        $current_wf_track = $workflow->currentWfTrack();
        $wf_module_id = $workflow->wf_module_id;
        $current_level = $workflow->currentLevel();
        $can_edit_resource = $this->wf_tracks->canEditResource($rate, $current_level, $workflow->wf_definition_id);
        return view('rate.display.show')
            ->with('rate', $rate)
            ->with('current_level', $current_level)
            ->with('current_wf_track', $current_wf_track)
            ->with('can_edit_resource', $can_edit_resource)
            ->with('wfTracks', (new WfTrackRepository())->getStatusDescriptions($rate));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param RateRequest $request
     * @param Rate $rate
     * @return \Illuminate\Http\Response
     */
    public function update(RateRequest $request, Rate $rate)
    {
        $this->rates->update($rate, $request->all());
        alert()->success(__('Updated Successfully'), __('Rate'));
        return redirect()->back();
    }

}
