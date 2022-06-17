<?php
/**
 * @developer: hamis
 * @email: hamisjuma1@icloud.com, hamisjuma1@gmail.com, hamisjuma1@yahoo.com
 * @vendor: Lynrant inc
 * Date: 12/15/19
 * Time: 6:51 PM
 */

namespace App\Services\Access;

use App\Exceptions\GeneralException;
use App\Models\Auth\Permission;
use App\Repositories\Workflow\WfTrackRepository;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\DB;

class Access
{
    /**
     * Get the currently authenticated user or null.
     */
    public function user()
    {
        return auth()->user();
    }

    /**
     * Return if the current session user is a guest or not.
     *
     * @return mixed
     */
    public function guest()
    {
        return auth()->guest();
    }

    /**
     * @return mixed
     */
    public function logout()
    {
        return auth()->logout();
    }

    /**
     * Get the currently authenticated user's id.
     *
     * @return mixed
     */
    public function id()
    {
        return auth()->id();
    }

    /**
     * @param Authenticatable $user
     * @param bool            $remember
     */
    public function login(Authenticatable $user, $remember = false)
    {
        $logged_in = auth()->login($user, $remember);
        return $logged_in;
    }

    /**
     * Check whether user is authenticated or not ...
     *
     * @return bool
     */
    public function check()
    {
        return auth()->check();
    }

    public function viaRemember()
    {
        return auth()->viaRemember();
    }

    public function details ()
    {

    }

    /**
     * @return mixed
     */
    public function getWorkflowPendingCount()
    {
        return (new WfTrackRepository())->getPendingCount();
    }

    /**
     * @return mixed
     */
    public function getMyWorkflowPendingCount()
    {
        return (new WfTrackRepository())->getMyPendingCount();
    }



    /**
     * Check if user has a default workflow module defined by a workflow group
     * @param $wf_module_group_id
     * @param $level
     * @param array $param
     * @return bool
     * @throws GeneralException
     */
    public function hasWorkflowDefinition($wf_module_group_id, $level, array $param = [])
    {
        $return = false;
        if ($user = $this->user()) {
            $return = $user->hasWorkflowDefinition($wf_module_group_id, $level);
        }
        if (!$return) {
            throw new GeneralException(trans('auth.workflow_error'));
        }
        return $return;
    }

    /**
     * Check if user has a specific workflow module specified by workflow module group and type
     * @param $wf_module_group_id
     * @param $type
     * @param $level
     * @return bool
     * @throws GeneralException
     */
    public function hasWorkflowModuleDefinition($wf_module_group_id, $type, $level)
    {
        $return = false;
        if ($user = $this->user()) {
            $return = $user->hasWorkflowModuleDefinition($wf_module_group_id, $type, $level);
        }
        if (!$return) {
            throw new GeneralException(trans('auth.workflow_error'));
        }
        return $return;
    }


    /**
     * Return all users
     * @return array
     */
    public function allUsers()
    {
        $return = [];
        $user = $this->user();
//        if ($this->substitutingCount()) {
//            $return = $user->substitutingUsers()->select(['id'])->pluck("id")->toArray();
//        }
        $return[] = $this->id();
        return $return;
    }

    /**
     * Allow permission
     * @param $permission_name
     * @return bool
     */
    public function allow($permission_name)
    {
        $permission = Permission::query()->where('name',$permission_name)->first();
        $result = DB::table('permission_user')->where('user_id', $this->id())->where('permission_id', $permission->id);
        if($result->count() > 0){
            return true;
        }
        return false;
    }

    public function hasWorkflowDefinitionProvided($wf_definition_id)
    {
        $check = DB::table('user_wf_definition')
            ->where('user_id', $this->id())
            ->where('wf_definition_id', $wf_definition_id)
            ->count();
        return $check ? true : false;
    }

}
