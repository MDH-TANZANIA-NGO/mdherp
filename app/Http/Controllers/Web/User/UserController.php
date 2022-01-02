<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\User\Datatables\UserDatatables;
use App\Models\Auth\SupervisorUser;
use App\Models\Auth\User;
use App\Repositories\Access\UserRepository;
use App\Repositories\Project\ProjectRepository;
use App\Repositories\System\RegionRepository;
use App\Repositories\Unit\DesignationRepository;
use App\Repositories\Workflow\WfModuleGroupRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use UxWeb\SweetAlert\SweetAlert;

class UserController extends Controller
{
    use UserDatatables;
    protected $designations;
    protected $regions;
    protected $users;
    protected $projects;
    protected $wf_module_groups;

    public function __construct()
    {
        $this->designations = (new DesignationRepository());
        $this->regions = (new RegionRepository());
        $this->users = (new UserRepository());
        $this->projects = (new ProjectRepository());
        $this->wf_module_groups = (new WfModuleGroupRepository());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.index');
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
        $this->users->store($request->all());
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

//        dd($this->users->getAllUsersWithThisSupervisorPluck($user->id));
        return view('user.profile.view_profile')
            ->with('user', $user)
            ->with('gender', code_value()->query()->where('code_id',2)->pluck('name','id'))
            ->with('marital', code_value()->query()->where('code_id',3)->pluck('name','id'))
            ->with('designations', $this->designations->getActiveForSelect())
            ->with('regions', $this->regions->forSelect())
            ->with('wf_module_groups', $this->wf_module_groups->getAll())
            ->with('projects', $this->projects->getActiveForPluck())
            ->with('users', $this->users->getAllUsersWithNoSupervisorPluck($user->id))
            ->with('user_with_supervisor', $this->users->getAllUsersWithThisSupervisorPluck($user->id));
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
}
