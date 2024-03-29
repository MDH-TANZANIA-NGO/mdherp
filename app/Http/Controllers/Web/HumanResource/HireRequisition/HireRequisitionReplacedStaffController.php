<?php

namespace App\Http\Controllers\Web\HumanResource\HireRequisition;

use App\Events\NewWorkflow;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\HumanResource\HireRequisition\Traits\HireRequisitionDatatable;
use App\Models\Auth\User;
use App\Models\System\WorkingTool;
use App\Repositories\Access\UserRepository;
use App\Repositories\HumanResource\HireRequisition\HireRequisitionRepository;
use App\Repositories\System\RegionRepository;
use App\Repositories\Unit\DepartmentRepository;
use App\Repositories\Workflow\WfTrackRepository;
use App\Services\Workflow\Workflow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class HireRequisitionReplacedStaffController extends Controller
{
    use HireRequisitionDatatable;
    protected $listing;
    protected $regions;
    protected $departments;
    protected $users;
    protected $wf_tracks;

    public  function __construct()
    {
        $this->listing = (new HireRequisitionRepository());
        $this->regions = (new RegionRepository());
        $this->departments = (new DepartmentRepository());
        $this->users = (new UserRepository());
        $this->wf_tracks = (new WfTrackRepository());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|View|\Illuminate\View\View
     */
    public function index()
    {
        return view('HumanResource/HireRequisition._parent.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $tools = WorkingTool::all();
        $users = User::where('designation_id', '!=', null)->get();
        return view('HumanResource.HireRequisition._parent.form.create')
            ->with('prospects', code_value()->query()->where('code_id', 7)->get())
            ->with('conditions', code_value()->query()->where('code_id', 8)->get())
            ->with('establishments', code_value()->query()->where('code_id', 9)->get())
            ->with('departments', $this->departments->getAll())
            ->with('tools', $tools )
            ->with('users', $users)
            ->with('regions', $this->regions->getAll());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $listing = $this->listing->store($request->all());
        $wf_module_group_id = 8;
        $next_user = $listing->user->assignedSupervisor()->supervisor_id;
        event(new NewWorkflow(['wf_module_group_id' => $wf_module_group_id, 'resource_id' => $listing->id,'region_id' => $listing->region_id, 'type' => 1],[],['next_user_id' => $next_user]));
        alert()->success('Hire Requisition Created Successfully','success');
        return redirect()->route('HireRequisition.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show(HireRequisition $listing)
    {
        /* Check workflow */
        $wf_module_group_id = 8;
        $wf_module = $this->wf_tracks->getWfModuleAfterWorkflowStart($wf_module_group_id, $listing->id);
        $workflow = new Workflow(['wf_module_group_id' => $wf_module_group_id, "resource_id" => $listing->id, 'type' => $wf_module->type]);
        $check_workflow = $workflow->checkIfHasWorkflow();
        $current_wf_track = $workflow->currentWfTrack();
        $wf_module_id = $workflow->wf_module_id;
        $current_level = $workflow->currentLevel();
        $can_edit_resource = $this->wf_tracks->canEditResource($listing, $current_level, $workflow->wf_definition_id);

        return view('HireRequisition._parent.display.show')
            ->with('listing', $listing)
            ->with('current_level', $current_level)
            ->with('current_wf_track', $current_wf_track)
            ->with('can_edit_resource', $can_edit_resource)
            ->with('wfTracks', (new WfTrackRepository())->getStatusDescriptions($listing));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit(Listing $listing)
    {
        $tools = WorkingTool::all();
        $users = User::where('designation_id', '!=', null)->get();
        //dd($listing);
        return view('listing._parent.form.edit')
            ->with('listing', $listing)
            ->with('prospects', code_value()->query()->where('code_id', 7)->get()->pluck('name','id'))
            ->with('conditions', code_value()->query()->where('code_id', 8)->get()->pluck('name','id'))
            ->with('establishments', code_value()->query()->where('code_id', 9)->get()->pluck('name','id'))
            ->with('departments', $this->departments->getAll()->pluck('title','id'))
            ->with('tools', $tools )
            ->with('working_tools', $listing->workingTools->pluck('id')->toArray())
            ->with('users', $users)
            ->with('regions', $this->regions->getAll()->pluck('name','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Listing $listing
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Listing $listing)
    {
        $this->listing->update($request->all(), $listing);
        alert()->success('Hire Requisition Updated Successfully');
        return redirect()->route('listing.show', $listing);
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

    public function getVacancies() {
        $listings = Listing::where('is_active', true)->get();
        return view('listing.vacancy.index')
            ->with('listings', $listings);
    }

    public function getVacancy(Listing $listing){
        return view('listing.vacancy.show')
            ->with('listing', $listing);
    }
}
