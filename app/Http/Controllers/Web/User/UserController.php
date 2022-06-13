<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\User\Datatables\UserDatatables;
use App\Models\Auth\Relationship\UserRelationship;
use App\Models\Auth\SupervisorUser;
use App\Models\Auth\User;
use App\Models\Leave\LeaveBalance;
use App\Models\Leave\LeaveType;
use App\Models\Project\ProjectUser;
use App\Models\Timesheet\EffortLevel;
use App\Repositories\Access\PermissionRepository;
use App\Repositories\Access\UserRepository;
use App\Repositories\Project\ProjectRepository;
use App\Repositories\System\RegionRepository;
use App\Repositories\Unit\DesignationRepository;
use App\Repositories\Workflow\WfModuleGroupRepository;
use Doctrine\DBAL\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use UxWeb\SweetAlert\SweetAlert;
use function PHPUnit\Framework\isEmpty;

class UserController extends Controller
{
    use UserDatatables, UserRelationship;
    protected $designations;
    protected $regions;
    protected $users;
    protected $projects;
    protected $wf_module_groups;
    protected $permissions;



    public function __construct()
    {
        $this->designations = (new DesignationRepository());
        $this->regions = (new RegionRepository());
        $this->users = (new UserRepository());
        $this->projects = (new ProjectRepository());
        $this->wf_module_groups = (new WfModuleGroupRepository());
        $this->permissions = (new PermissionRepository());

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
   
        return view('user.index')
            ->with('active_user_count', $this->users->getActive()->get()->count())
            ->with('inactive_user_count', $this->users->getInactive()->get()->count());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('user.form.create')
            ->with('gender', code_value()->query()->where('code_id',2)->pluck('name','id'))
            ->with('marital', code_value()->query()->where('code_id',3)->pluck('name','id'))
            ->with('designations', $this->designations->getActiveForSelect())
            ->with('projects', $this->projects->getActiveForPluck())
            ->with('regions', $this->regions->forSelect());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        try {
            $user = $this->users->store($request->all());
            alert()->success($user->full_name_formatted. ' Registered Successfully');
            return redirect()->back();
        }catch (\Exception $exception){
            alert()->error('User already Exist', 'Failed');
            return redirect()->back();
        }

    }
    public function resetPassword(User $user)
    {
        $this->users->resetPassword($user);
        alert()->success('Password Reset link sent to'.$user->full_name. 'Succeeded');
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function profile(User $user)
    {
            $leave_types = LeaveType::all();

            if ($user->assignedSupervisor())
            {
                $supervisor = $this->users->find($user->assignedSupervisor()->supervisor_id)->full_name;
            }
            else{
                $supervisor= ' Not assigned';
            }

            $effort_levels = EffortLevel::where('user_id', $user->id)->get();
//            if(count($effort_levels) ){
//                return $effort_levels;
//            }else{
//                return "No effort levels";
//            }
//            //dd($effort_levels);


            $leaveBalances = LeaveBalance::where('user_id', $user->id)->get();
            $female_leave_balances = LeaveType::query()->where('id','!=', 5)->get();
            $male_leave_balances = LeaveType::query()->where('id','!=', 4)->get();



        return view('user.profile.index')
            ->with('user', $user)
            ->with('gender', code_value()->query()->where('code_id',2)->pluck('name','id'))
            ->with('marital', code_value()->query()->where('code_id',3)->pluck('name','id'))
            ->with('designations', $this->designations->getActiveForSelect())
            ->with('regions', $this->regions->forSelect())
            ->with('wf_module_groups', $this->wf_module_groups->getAll())
            ->with('projects', $this->projects->getActiveForPluck())
            ->with('users', $this->users->getAllUsersWithNoSupervisorPluck($user->id))
            ->with('user_with_supervisor', $this->users->getAllUsersWithThisSupervisorGet($user->id))
            ->with('permissions', $this->permissions->getAll())
            ->with('leave_types', $leave_types)
            ->with('user_projects', $this->projects->getUserProjects($user->id))
            ->with('effort_levels', $effort_levels)
            ->with('leave_balances', $leaveBalances?? "This user does not have leave balances")
            ->with('supervisor', $supervisor)
            ->with('male_leave', $male_leave_balances)
            ->with('female_leave', $female_leave_balances)
            ->with('supervisors', $this->users->allSupervisors()->where('user_id', '!=',$user->id)->get()->pluck('name', 'user_id'));
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $user)
    {

        $this->users->update($user, $request->all());
        alert()->success('Updated Successfully', $user->full_name_formatted);
        return redirect()->back();
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param User $user
     * @return void
     */
    public function updateWfDefinition(Request $request, User $user)
    {
        if(isset($request['definitions'])){
            $user->wfDefinitions()->sync($request['definitions']);
        }else{
            $user->wfDefinitions()->detach();
        }
        alert()->success(__('notifications.user.workflow'), __('notifications.user.title'));
        return redirect()->back();
    }

    public function assignSubProgramArea(Request $request, $uuid)
    {
        $this->users->assignSubProgramArea($uuid, $request->all());
        alert()->success(__('notifications.user.workflow'), __('notifications.user.title'));
        return redirect()->back();
    }

    public function assignSupervisor(Request $request, $user_id)
    {
        $this->users->assignSupervisor($user_id, $request->all());
        return redirect()->back();
    }
    public function deleteSupervisor($users, User $user)
    {
//           DB::table('supervisor_users')->where('user_id', $users)->delete();
            DB::table('supervisor_users')->where('user_id', $users)->delete();
            return redirect()->back();

    }

    public function updatePermissions(Request $request, User $user)
    {
        $this->users->updatePermissions($user, $request->all());
        alert()->success(__('notifications.permission_assigned'), __('notifications.user.title'));
        return redirect()->back();
    }

    public function assignSupervisorIndividual(Request $request)
    {
        SupervisorUser::query()->create([
            'supervisor_id'=>$request['supervisor'],
            'user_id'=>$request['user_id']
        ]);
        alert()->success('Supervisor assigned successfully', 'Success');
        return redirect()->back();
    }

}
