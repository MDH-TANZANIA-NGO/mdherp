<?php

namespace App\Http\Controllers\Web\Account;

use App\Http\Controllers\Controller;
use App\Models\Auth\User;
use App\Repositories\Access\PermissionRepository;
use App\Repositories\Access\UserRepository;
use App\Repositories\Project\ProjectRepository;
use App\Repositories\System\RegionRepository;
use App\Repositories\Unit\DesignationRepository;
use App\Repositories\Workflow\WfModuleGroupRepository;
use Illuminate\Http\Request;

class AccountController extends Controller
{
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

    public function index(User $user){
        return view('employee.account.index')
            ->with('user', $user)
            ->with('gender', code_value()->query()->where('code_id',2)->pluck('name','id'))
            ->with('marital', code_value()->query()->where('code_id',3)->pluck('name','id'))
            ->with('designations', $this->designations->getActiveForSelect())
            ->with('regions', $this->regions->forSelect())
            ->with('wf_module_groups', $this->wf_module_groups->getAll())
            ->with('projects', $this->projects->getActiveForPluck())
            ->with('users', $this->users->getAllUsersWithNoSupervisorPluck($user->id))
            ->with('user_with_supervisor', $this->users->getAllUsersWithThisSupervisorGet($user->id))
            ->with('permissions', $this->permissions->getAll());;
    }
}
