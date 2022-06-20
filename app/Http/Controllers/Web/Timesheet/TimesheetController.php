<?php

namespace App\Http\Controllers\Web\Timesheet;

use App\Events\NewWorkflow;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\Timesheet\Traits\TimesheetDatatable;
use App\Mail\TimesheetNotification;
use App\Models\Attendance\Attendance;
use App\Models\Leave\LeaveBalance;
use App\Models\Project\Project;
use App\Models\Project\ProjectUser;
use App\Models\Timesheet\EffortLevel;
use App\Models\Timesheet\StartedTimesheet;
use App\Models\Timesheet\Timesheet;
use App\Repositories\Timesheet\TimesheetRepository;
use App\Repositories\Workflow\WfTrackRepository;
use App\Services\Workflow\Workflow;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $effortLevels = EffortLevel::where('user_id', access()->id())->get();
        return view('timesheet.forms.initiate')
            ->with('effortLevels', $effortLevels);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        dd(access()->user()->assignedSupervisor());
        $next_user = access()->user()->assignedSupervisor()->supervisor_id;
        $submissionStatus = Timesheet::where('user_id', access()->user()->id )->whereMonth('created_at', Carbon::now()->month)->get();

        if ($submissionStatus->count() == 0){
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
            $totalHrs = Attendance::where(['user_id' => access()->user()->id, 'timesheet_id' => $timesheet->id])->sum('hrs');
            $timesheet->update([
                'hrs' => $totalHrs
            ]);
            $wf_module_group_id = 7;

            if ($next_user){
                event(new NewWorkflow(['wf_module_group_id' => $wf_module_group_id, 'resource_id' => $timesheet->id,'region_id' => $timesheet->user->region_id, 'type' => 1],[],['next_user_id' => $next_user]));
                alert()->success('Your timesheet have been submitted Successfully','success');
                return redirect()->route('timesheet.index');
            }

//        try {
//                $next_user = access()->user()->assignedSupervisor()->supervisor_id;
//               $submissionStatus = Timesheet::where('user_id', access()->user()->id )->whereMonth('created_at', Carbon::now()->month)->get();
//
//               if ($submissionStatus->count() == 0){
//                   $timesheet = Timesheet::create([
//                       'user_id' => access()->id()
//                   ]);
//
//                   for ($i = 0; $i < count($request['data']); $i++ ){
//                       Attendance::create([
//                           'user_id' => access()->id(),
//                           'timesheet_id' => $timesheet->id,
//                           'comments' => $request['data'][$i]['comment'],
//                           'hrs' => $request['data'][$i]['hours'],
//                           'date' => Carbon::createFromFormat('D d-F-Y', $request['data'][$i]['date'])->format('Y-m-d')
//                       ]);
//                   }
//                   $totalHrs = Attendance::where(['user_id' => access()->user()->id, 'timesheet_id' => $timesheet->id])->sum('hrs');
//                   $timesheet->update([
//                       'hrs' => $totalHrs
//                   ]);
//                   $wf_module_group_id = 7;
//
//                   if ($next_user){
//                       event(new NewWorkflow(['wf_module_group_id' => $wf_module_group_id, 'resource_id' => $timesheet->id,'region_id' => $timesheet->user->region_id, 'type' => 1],[],['next_user_id' => $next_user]));
//                       alert()->success('Your timesheet have been submitted Successfully','success');
//                       return redirect()->route('timesheet.index');
//                   }
//               }
//            return redirect()->route('timesheet.index');
//        }catch (\Exception $exception) {
//            alert()->error('You have already submitted timesheet','Failed');
//            $exception->getMessage();
//            return redirect()->back();
//        }

    }}

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
        $effort_levels = ProjectUser::where('user_id', $timesheet->user_id)->get();
      $time_perc = [];
        foreach ($effort_levels as  $effort_level){
              array_push($time_perc, array(
                  'project' =>  Project::where('id', $effort_level->project_id)->pluck('title')->first(),
                  'percentage' => $effort_level->percentage * 0.01 * $timesheet->hrs,
                  'percent' => $effort_level->percentage
              ));
        }

        $attendances = Attendance::where('timesheet_id', $timesheet->id)->orderBy('date')->get();

        $attendance_track = [];
        foreach ($attendances as $attendance){
            $percent = [];
            foreach ($effort_levels as $effort_level){
                array_push($percent, array(
                    'daily_percent' => $effort_level->percentage * 0.01 * $attendance->hrs,
                ));
            }
            array_push($attendance_track, array(
                'percentage' => $percent,
                'hours' => $attendance->hrs,
                'date' => $attendance->date,
                'comments' => $attendance->comments,
            ));
        }

        return view('timesheet.show')
            ->with('current_level', $current_level)
            ->with('current_wf_track', $current_wf_track)
            ->with('can_edit_resource', $can_edit_resource)
            ->with('wfTracks', (new WfTrackRepository())->getStatusDescriptions($timesheet))
            ->with('time_percentages', $time_perc)
            ->with('attendances', $attendance_track)
            ->with('timesheet', $timesheet);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit(Timesheet $timesheet)
    {

        return view('timesheet.forms.edit')
            ->with('timesheet', $timesheet);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Timesheet $timesheet)
    {
        foreach ($timesheet->attendances as $attendance){
            for ($i = 0; $i < count($request['data']); $i++ ){
                if ($attendance->date == $request['data'][$i]['date']){
                    $attendance->update([
                        'comments' => $request['data'][$i]['comment'],
                        'hrs' => $request['data'][$i]['hrs'],
                    ]);
                }
            }
        }

        $totalHrs = Attendance::where(['user_id' => access()->id(), 'timesheet_id' => $timesheet->id])->sum('hrs');
        $timesheet->update([
            'hrs' => $totalHrs
        ]);

        return redirect()->route('timesheet.show', $timesheet);

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
            EffortLevel::updateOrCreate(
                [
                'user_id' => $request['data'][$i]['user_id'],
                'project_id' => $request['data'][$i]['project_id'],
                'percentage' => $request['data'][$i]['percentage']
                ]
            );
        }
        alert()->success('Level of Effort was set Successfully','success');
        return redirect()->back();
    }

    public function effortUpdate(Request $request){
        $effort_levels = ProjectUser::where('user_id', $request['data'][0]['user_id'])->get();
            foreach ($effort_levels as $effort_level){
                for ($i = 0; $i < count($request['data']); $i++ ){
                    if ($request['data'][$i]['project_id'] == $effort_level->project_id){
                        $effort_level->update([
                            'percentage' => $request['data'][$i]['percentage']
                        ]);
                    }
                }
            }
        alert()->success('Level of Effort was set Successfully','success');
        return redirect()->back();
    }

    public function startTimesheet(){
        $details = [
            'subject' => 'Timesheet Submission',
        ];

        try {
            $date = Carbon::now()->format('F');
            StartedTimesheet::create([
                'user_id' => access()->id(),
                'month' => $date
            ]);
            Mail::to('MdhStaff@mdh.or.tz')->send(new TimesheetNotification($details));
            alert()->success('Timesheet Notification have been sent Successfully','success');
            return redirect()->back();
        } catch (\Exception $exception){
            alert()->error('Timesheet Notification has already been sent','Failed');
            return redirect()->back();
        }
    }
}
