<?php

namespace App\Http\Controllers\Web\Timesheet;

use App\Events\NewWorkflow;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\Timesheet\Traits\TimesheetDatatable;
use App\Models\Attendance\Attendance;
use App\Models\Leave\LeaveBalance;
use App\Models\Project\Project;
use App\Models\Timesheet\EffortLevel;
use App\Models\Timesheet\Timesheet;
use App\Repositories\Timesheet\TimesheetRepository;
use App\Repositories\Workflow\WfTrackRepository;
use App\Services\Workflow\Workflow;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TimesheetController extends Controller
{
    use TimesheetDatatable;
    protected $wf_tracks;
    protected $timesheets;

    public function __construct()
    {
        $this->wf_tracks = (new WfTrackRepository());
        $this->timesheets = (new TimesheetRepository());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $visibility = true;
        $lasttimesheet = Timesheet::where('user_id', access()->id())->latest()->first();
        if ($lasttimesheet != null && $lasttimesheet->created_at->format('m') == Carbon::now()->format('m')){
            $visibility = false;
        }

        return view('timesheet.index')
            ->with('timesheets', $this->timesheets)
            ->with('visibility', $visibility);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('timesheet.forms.initiate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $timesheet = Timesheet::create([
            'user_id' => access()->id()
        ]);
        for ($i = 0; $i < count($request['data']); $i++ ){
            Attendance::create([
                'user_id' => access()->id(),
                'timesheet_id' => $timesheet->id,
                'comments' => $request['data'][$i]['comment'],
                'hrs' => $request['data'][$i]['hours'],
                'date' => Carbon::createFromFormat('D d-F-Y', $request['data'][$i]['date'])->format('Y-m-d')
            ]);
        }
        $totalHrs = Attendance::where(['user_id' => access()->id(), 'timesheet_id' => $timesheet->id])->sum('hrs');
        $timesheet->update([
            'hrs' => $totalHrs
        ]);
        $wf_module_group_id = 7;
        $next_user = $timesheet->user->assignedSupervisor()->supervisor_id;
        event(new NewWorkflow(['wf_module_group_id' => $wf_module_group_id, 'resource_id' => $timesheet->id,'region_id' => $timesheet->user->region_id, 'type' => 1],[],['next_user_id' => $next_user]));
        alert()->success('Your timesheet have been submitted Successfully','success');

        return redirect()->route('timesheet.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show(Timesheet $timesheet)
    {
        $wf_module_group_id = 7;
        $wf_module = $this->wf_tracks->getWfModuleAfterWorkflowStart($wf_module_group_id, $timesheet->id);
        $workflow = new Workflow(['wf_module_group_id' => $wf_module_group_id, "resource_id" => $timesheet->id, 'type' => $wf_module->type]);
        $check_workflow = $workflow->checkIfHasWorkflow();
        $current_wf_track = $workflow->currentWfTrack();
        $wf_module_id = $workflow->wf_module_id;
        $current_level = $workflow->currentLevel();
        $can_edit_resource = $this->wf_tracks->canEditResource($timesheet, $current_level, $workflow->wf_definition_id);

        $designation = access()->user()->designation_id;
        $effort_levels = EffortLevel::where('user_id', $timesheet->user_id)->get();
      $time_perc = [];
        foreach ($effort_levels as  $effort_level){
              array_push($time_perc, array(
                  'project' =>  Project::where('id', $effort_level->project_id)->pluck('title')->first(),
                  'percentage' => $effort_level->percentage * 0.01 * $timesheet->hrs
              ));
        }

        return view('timesheet.show')
            ->with('current_level', $current_level)
            ->with('current_wf_track', $current_wf_track)
            ->with('can_edit_resource', $can_edit_resource)
            ->with('wfTracks', (new WfTrackRepository())->getStatusDescriptions($timesheet))
            ->with('time_percentages', $time_perc)
            ->with('timesheet', $timesheet);
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

    public function setup(Request $request){
        for ($i = 0; $i < count($request['data']); $i++ ){
            EffortLevel::create([
                'user_id' => $request['data'][$i]['user_id'],
                'project_id' => $request['data'][$i]['project_id'],
                'percentage' => $request['data'][$i]['percentage'],
            ]);
        }
        alert()->success('Level of Effort was set Successfully','success');
        return redirect()->back();
    }
}
