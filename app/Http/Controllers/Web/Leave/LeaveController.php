<?php

namespace App\Http\Controllers\Web\Leave;


use App\Events\NewWorkflow;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\Leave\Datatables\LeaveDatatables;
use App\Models\Auth\User;
use App\Models\Leave\Leave;
use App\Models\Leave\LeaveBalance;
use App\Models\Leave\LeaveType;
use App\Models\Timesheet\EffortLevel;
use App\Models\Unit\Designation;
use App\Repositories\Access\UserRepository;
use App\Repositories\Leave\LeaveRepository;
use App\Repositories\Workflow\WfTrackRepository;
use App\Services\Workflow\Workflow;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use UxWeb\SweetAlert\SweetAlert;

class LeaveController extends Controller
{

    use LeaveDatatables;

    protected $leaves;
    protected $wf_tracks;
    protected $user;

    public function __construct()
    {
        $this->leaves = (new LeaveRepository());
        $this->wf_tracks = (new WfTrackRepository());
        $this->user = (new UserRepository());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        return view('leave._parent.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $leaveTypes = LeaveType::all()->pluck('name', 'id');

        $users = $this->user->forSelect();
        $leaveBalances = LeaveBalance::all()->where('user_id', access()->user()->id);

        return view('leave._parent.form.create')
            ->with('leaveTypes', $leaveTypes)
            ->with('users', $users)
            ->with('leave_balances', $leaveBalances);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        //departmentment director
        $is_assigned = Leave::all()->where('employee_id', access()->user()->id)->where('end_date', '>=', $request['end_date']);
        $leave_balance = LeaveBalance::where('user_id', access()->id())->where('leave_type_id', $request['leave_type_id'])->first();
        $start = Carbon::parse($request['start_date']);
        $end = Carbon::parse($request['end_date']);
        $days = $start->diffInDays($end) + 1;

        $actual_remaining_days = $leave_balance->remaining_days - $days;
        if ($is_assigned->count() > 0 && $request['leave_type_id'] == 1){
            alert()->error('You have been delegated responsibilities', 'Failed');
            return redirect()->back();
        }
        else{

            if ($days <= $leave_balance->remaining_days && $leave_balance->remaining_days != 0) {
                $leave = $this->leaves->store($request->all());
                DB::update('update leave_balances set remaining_days =?  where id= ?', [$actual_remaining_days, $leave_balance->id]);
                $wf_module_group_id = 5;
                $next_user = $leave->user->assignedSupervisor()->supervisor_id;

                event(new NewWorkflow(['wf_module_group_id' => $wf_module_group_id, 'resource_id' => $leave->id, 'region_id' => $leave->region_id, 'type' => 1], [], ['next_user_id' => $next_user]));
                alert()->success('Your Leave Request have been submitted Successfully', 'success');

                return redirect()->route('leave.index');
            } else {
                alert()->error('You do not have any available leave balances on '.$leave_balance->leaveType->name, 'Failed');
                return redirect()->back();
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Leave $leave
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     * @throws \App\Exceptions\GeneralException
     */
    public function show(Leave $leave)
    {

        $wf_module_group_id = 5;
        $wf_module = $this->wf_tracks->getWfModuleAfterWorkflowStart($wf_module_group_id, $leave->id);
        $workflow = new Workflow(['wf_module_group_id' => $wf_module_group_id, "resource_id" => $leave->id, 'type' => $wf_module->type]);
        $check_workflow = $workflow->checkIfHasWorkflow();
        $current_wf_track = $workflow->currentWfTrack();
        $wf_module_id = $workflow->wf_module_id;
        $current_level = $workflow->currentLevel();
        $can_edit_resource = $this->wf_tracks->canEditResource($leave, $current_level, $workflow->wf_definition_id);

        $designation = access()->user()->designation_id;
        $start = Carbon::parse($leave->start_date);
        $end = Carbon::parse($leave->end_date);
        $days = $start->diffInDays($end) + 1;
        $type = LeaveType::where('id', $leave->leave_type_id)->first();
        $remaining_days = LeaveBalance::query()->where('user_id', $leave->user_id)
                                                ->where('leave_type_id', $leave->leave_type_id)->first()->remaining_days;


        return view('leave._parent.display.show')
            ->with('current_level', $current_level)
            ->with('current_wf_track', $current_wf_track)
            ->with('can_edit_resource', $can_edit_resource)
            ->with('wfTracks', (new WfTrackRepository())->getStatusDescriptions($leave))
            ->with('days', $days)
            ->with('type', $type)
            ->with('leave', $leave)
            ->with('remaining_days', $remaining_days);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit(Leave $leave)
    {
        $leaveTypes = LeaveType::all()->pluck('name', 'id');
        $users = $this->user->forSelect();

        return view('leave._parent.form.edit')
            ->with('leave', $leave)
            ->with('leaveTypes', $leaveTypes)
            ->with('users', $users);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Leave $leave)
    {
        $leave->update($request->all());
        alert()->success('Leave Request Updated Successfully');
        return redirect()->route('leave.show', $leave);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function setup(Request $request)
    {
        for ($i = 0; $i < count($request['data']); $i++) {

            $leaveBalance = new LeaveBalance;
            $leaveBalance->user_id = $request['data'][$i]['user_id'];
            $leaveBalance->leave_type_id = $request['data'][$i]['leave_id'];
            $leaveBalance->remaining_days = $request['data'][$i]['remaining_days'];
            $leaveBalance->save();
        }

        alert('Leave Balances Inserted Successfully', 'Success');
        return redirect()->back();
    }

    public function updateSetup(Request $request, $user_id)
    {
        LeaveBalance::where('user_id', $user_id)->delete();

        for ($i = 0; $i < count($request['data']); $i++) {

            $leaveBalance = new LeaveBalance;
            $leaveBalance->user_id = $request['data'][$i]['user_id'];
            $leaveBalance->leave_type_id = $request['data'][$i]['leave_id'];
            $leaveBalance->remaining_days = $request['data'][$i]['remaining_days'];
            $leaveBalance->save();
        }
        alert('Leave Balances Updated Successfully', 'Success');
        return redirect()->back();
    }
}
