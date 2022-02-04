<?php

namespace App\Http\Controllers\Web\Account;

use App\Http\Controllers\Controller;
use App\Models\Auth\User;
use App\Models\Leave\LeaveType;
use App\Repositories\Access\PermissionRepository;
use App\Repositories\Access\UserRepository;
use App\Repositories\Project\ProjectRepository;
use App\Repositories\System\RegionRepository;
use App\Repositories\Unit\DesignationRepository;
use App\Repositories\Workflow\WfModuleGroupRepository;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function __invoke(Request $request)
    {
        return view('account.index');
    }
}
