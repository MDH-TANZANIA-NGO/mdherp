<?php

namespace App\Repositories\Workflow;

use App\Repositories\Backend\Operation\Claim\NotificationReportRepository;
use App\Repositories\BaseRepository;
use App\Models\Workflow\WfModule;
use App\Exceptions\GeneralException;
use Illuminate\Support\Facades\Log;

/**
 * Class WfModuleRepository
 * @package App\Repositories\Backend\Workflow
 * @author Erick M. Chrysostom <e.chrysostom@nextbyte.co.tz|gwanchi@gmail.com>
 */
class WfModuleRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = WfModule::class;

    public function getAllActive()
    {
        return $this->query()->where("isactive", 1)->orderby("id", "asc")->get();
    }

    /**
     * @param array $input
     * @return mixed
     * @throws GeneralException
     */
    public function getModuleInstance(array $input)
    {
        /** sample 1 $input : ['wf_module_group_id' => 4, 'resource_id' => 1] **/
        /** sample 2 $input : ['wf_module_group_id' => 3, 'resource_id' => 1, 'type' => 4] **/
        /** sample 3 $input : ['wf_module_group_id' => 3] **/
        /** sample 4 $input : ['wf_module_group_id' => 3, 'type' => 4] **/
        $module_group = $input['wf_module_group_id'];
        $selectArray = ['id', 'name'];
        $type = 0;
        switch ($module_group) {
            //All specified in case blocks has varieties, module group with more than one modules
            case 1:
                // Application Approval
                $type = 1;
                if (isset($input['type']) And !is_null($input['type']) And $input['type'] > 0) {
                    $type = $input['type'];
                } else {
                    if (isset($input['resource_id'])) {
                        $resource_id = $input['resource_id'];

                    }
                }
                $wf_module = $this->query()->where(['wf_module_group_id' => $module_group, 'type' => $type, 'isactive' => 1])->select($selectArray)->orderBy("id", "asc")->first();
                break;

            case 2:
                // Physical Inspection Agreements
                $type = 1;
                if (isset($input['type']) And !is_null($input['type']) And $input['type'] > 0) {
                    $type = $input['type'];
                } else {
                    if (isset($input['resource_id'])) {
                        $resource_id = $input['resource_id'];

                    }
                }
                $wf_module = $this->query()->where(['wf_module_group_id' => $module_group, 'type' => $type, 'isactive' => 1])->select($selectArray)->orderBy("id", "asc")->first();
                break;

            case 3:
                // Conditional Release
                $type = 1;
                if (isset($input['type']) And !is_null($input['type']) And $input['type'] > 0) {
                    $type = $input['type'];
                } else {
                    if (isset($input['resource_id'])) {
                        $resource_id = $input['resource_id'];

                    }
                }
                $wf_module = $this->query()->where(['wf_module_group_id' => $module_group, 'type' => $type, 'isactive' => 1])->select($selectArray)->orderBy("id", "asc")->first();
                break;

            case 5:
                // Premise Registration
                $type = 1;
                if (isset($input['type']) And !is_null($input['type']) And $input['type'] > 0) {
                    $type = $input['type'];
                } else {
                    if (isset($input['resource_id'])) {
                        $resource_id = $input['resource_id'];

                    }
                }
                $wf_module = $this->query()->where(['wf_module_group_id' => $module_group, 'type' => $type, 'isactive' => 1])->select($selectArray)->orderBy("id", "asc")->first();
                break;

            default:
                $wf_module = $this->query()->where(['wf_module_group_id' => $module_group, 'isactive' => 1])->select($selectArray)->orderBy("id", "asc")->first();
                break;
        }
        if (is_null($wf_module)) {
            throw new GeneralException(trans('exceptions.backend.workflow.module_not_found'));
        }

         return $wf_module;
    }

    /**
     * @param array $input
     * @return mixed
     * @throws GeneralException
     */
    public function getModule(array $input)
    {
        return $this->getModuleInstance($input)->id;
    }

    public function getActiveClaimWfModule()
    {
        return 10;
    }

    public function getDefaultClaimType($resource_id)
    {
        //To be based on incident type id based on a specific notification report
        return 1;
    }

    public function getDefaultNotificationRejectionType($resource_id)
    {
        return 2;
    }

    public function getActiveNotificationType($resource_id)
    {
        $return = 2;
        if (!is_null($resource_id)) {
            //To be based on incident type id based on a specific notification report
            $notificationRepo = new NotificationReportRepository();
            $notification = $notificationRepo->query()->select(['incident_type_id'])->where("id", $resource_id)->first();

            switch($notification->incident_type_id) {
                case 2:
                    $return = 2;
                    break;
                default:
                    $return = 2;
            }
        }
        return $return;
    }

    /**
     * @description Query the active workflow modules which are pending for user's action or to be assigned
     * @return mixed
     */
    public function queryActiveUser()
    {
        $modules = $this->query()->select(['id', 'name', 'description', 'wf_module_group_id'])->whereIn("id", function ($query) {
            $query->select("wf_module_id")->from("wf_definitions")->whereIn("id", function($query) {
                $query->select("wf_definition_id")->from("wf_tracks")->where(['status' => 0])->whereIn("wf_definition_id", function($query) {
                    $query->select("wf_definition_id")->from("user_wf_definition")->whereIn("user_id", access()->allUsers());
                });
            });
        })->get();
        return $modules;
    }

    /**
     * @description Query the attended workflow modules for the logged in user
     * @return mixed
     */
    public function queryAttendedUser()
    {
        $modules = $this->query()->select(['id', 'name', 'description', 'wf_module_group_id'])->whereIn("id", function ($query) {
            $query->select("wf_module_id")->from("wf_definitions")->whereIn("id", function($query) {
                $query->select("wf_definition_id")->from("wf_tracks")->where(['status' => 1])->whereIn("user_id", access()->allUsers());
            });
        })->get();
        return $modules;
    }

    /**
     * @description Query the ended workflow modules for the logged in user
     * @return mixed
     */
    public function queryEndedUser()
    {
        $modules = $this->query()->select(['id', 'name', 'description', 'wf_module_group_id'])->whereIn("id", function ($query) {
            $query->select("wf_module_id")->from("wf_definitions")->whereIn("id", function($query) {
                $query->select("wf_definition_id")->from("wf_tracks")->where(['status' => 4])->whereIn("user_id",
                    access()->allUsers());
            });
        })->get();
        return $modules;
    }

    /**
     * @description Query the holded workflow modules for the logged in user
     * @return mixed
     */
    public function queryHoldedUser()
    {
        $modules = $this->query()->select(['id', 'name', 'description', 'wf_module_group_id'])->whereIn("id", function ($query) {
            $query->select("wf_module_id")->from("wf_definitions")->whereIn("id", function($query) {
                $query->select("wf_definition_id")->from("wf_tracks")->where(['status' => 3])->whereIn("user_id",
                    access()->allUsers());
            });
        })->get();
        return $modules;
    }

    /**
     * @description Query the new workflow modules for the logged in user
     * @return mixed
     */
    public function queryNewUser()
    {
        $modules = $this->query()->select(['id', 'name', 'description', 'wf_module_group_id'])->whereIn("id", function ($query) {
            $query->select("wf_module_id")->from("wf_definitions")->whereIn("id", function($query) {
                $query->select("wf_definition_id")->from("wf_tracks")->where(['status' => 0])->whereIn("wf_definition_id", function($query) {
                    $query->select("wf_definition_id")->from("user_wf_definition")->whereIn("user_id", access()->allUsers());
                });
            });
        })->get();
        return $modules;
    }

    /**
     * @description get the group summary of workflow modules which are pending for users's action or to be assigned
     * @return array
     */
    public function getActiveUser()
    {
        $modules = $this->queryActiveUser();
        $wfTracks = new WfTrackRepository();
        $groupSummary = [];
        foreach ($modules as $module) {
            $count = $wfTracks->getPendingModuleCount($module->id);
            $app_category_summary[] = $wfTracks->getNewModuleCountByAppCategoryType($module->id);
            $groupSummary[] = ['id' => $module->id, 'name' => $module->name, 'group' => $module->wfModuleGroup->name, 'description' => $module->description, 'count' => number_format($count , 0 , '.' , ',' ),'app_category_summary' => $app_category_summary];
        }
        return $groupSummary;
    }

    /**
     * @description get the group summary of workflow modules which are pending for users's action or to be assigned
     * @return array
     */
    public function getPermitApprovalUser()
    {
        $modules = $this->queryActiveUser();
        $wfTracks = new WfTrackRepository();
        $groupSummary = [];
        foreach ($modules as $module) {
            $count = $wfTracks->getPermitApprovalModuleCount($module->id);
            $app_category_summary[] = $wfTracks->getNewModuleCountByAppCategoryType($module->id);
            $groupSummary[] = ['id' => $module->id, 'name' => $module->name, 'group' => $module->wfModuleGroup->name, 'description' => $module->description, 'count' => number_format($count , 0 , '.' , ',' ),'app_category_summary' => $app_category_summary];
        }
        return $groupSummary;
    }





    /**
     * @description get the group summary of workflow modules which has been attended by a logged in user.
     * @return array
     */

    public function getNewActiveUser()
    {
        $modules = $this->queryNewUser();
        $wfTracks = new WfTrackRepository();
        $groupSummary = [];
        foreach ($modules as $module) {
            $count = $wfTracks->getNewModuleCount($module->id);
            $app_category_summary[] = $wfTracks->getNewModuleCountByAppCategoryType($module->id);
            $groupSummary[] = ['id' => $module->id, 'name' => $module->name, 'group' => $module->wfModuleGroup->name, 'description' => $module->description, 'count' => number_format($count , 0 , '.' , ',' ), 'app_category_summary' => $app_category_summary];
        }
        return $groupSummary;
    }

##################################################
    /**
     * @description get the group summary of workflow modules which has been attended by a logged in user.
     * @return array
     */

    public function getRespondedActiveUser()
    {
        $modules = $this->queryNewUser();
        $wfTracks = new WfTrackRepository();
        $groupSummary = [];
        foreach ($modules as $module) {
            $count = $wfTracks->getRespondedModuleCount($module->id);
            $app_category_summary[] = $wfTracks->getRespondedModuleCountByAppCategoryType($module->id);
            $groupSummary[] = ['id' => $module->id, 'name' => $module->name, 'group' => $module->wfModuleGroup->name, 'description' => $module->description, 'count' => number_format($count , 0 , '.' , ',' ), 'app_category_summary' => $app_category_summary];
        }
        return $groupSummary;
    }

    #############################################

    /**
     * @description get the group summary of workflow modules which has been attended by a logged in user.
     * @return array
     */
    public function getMyAttendedActiveUser()
    {
        $modules = $this->queryAttendedUser();
        $wfTracks = new WfTrackRepository();
        $groupSummary = [];
        foreach ($modules as $module) {
            $count = $wfTracks->getMyAttendedModuleCount($module->id);
            $groupSummary[] = ['id' => $module->id, 'name' => $module->name, 'group' => $module->wfModuleGroup->name, 'description' => $module->description, 'count' => number_format($count , 0 , '.' , ',' )];
        }
        return $groupSummary;
    }

    /**
     * @description get the group summary of workflow modules which has been Ended by a logged in user.
     * @return array
     */
    public function getMyEndedActiveUser()
    {
        $modules = $this->queryEndedUser();
        $wfTracks = new WfTrackRepository();
        $groupSummary = [];
        foreach ($modules as $module) {
            $count = $wfTracks->getMyEndedModuleCount($module->id);
            $groupSummary[] = ['id' => $module->id, 'name' => $module->name, 'group' => $module->wfModuleGroup->name, 'description' => $module->description, 'count' => number_format($count , 0 , '.' , ',' )];
        }
        return $groupSummary;
    }

    /**
     * @description get the group summary of workflow modules which has been holded by a logged in user.
     * @return array
     */
    public function getMyHoldedActiveUser()
    {
        $modules = $this->queryHoldedUser();
        $wfTracks = new WfTrackRepository();
        $groupSummary = [];
        foreach ($modules as $module) {
            $count = $wfTracks->getMyHoldedModuleCount($module->id);
            $groupSummary[] = ['id' => $module->id, 'name' => $module->name, 'group' => $module->wfModuleGroup->name, 'description' => $module->description, 'count' => number_format($count , 0 , '.' , ',' )];
        }
        return $groupSummary;
    }

    /**
     * @description get the group summary of workflow modules which has been assigned to the logged in user.
     * @return array
     */
    public function getAssignedActiveUser()
    {
        $modules = $this->queryActiveUser();
        $wfTracks = new WfTrackRepository();
        $groupSummary = [];
        foreach ($modules as $module) {
            $count = $wfTracks->getMyPendingModuleCount($module->id);
            $groupSummary[] = ['id' => $module->id, 'name' => $module->name, 'group' => $module->wfModuleGroup->name, 'description' => $module->description, 'count' => number_format($count , 0 , '.' , ',' )];
        }
        return $groupSummary;
    }

    ///start: current workflow modules values
    public function notificationIncidentApproval()
    {
        return ['type' => 4];
    }

    public function accidentMaeSpecialApprovalType()
    {
        return ['type' => 5];
    }

    public function diseaseMaeSpecialApprovalType()
    {
        return ['type' => 6];
    }

    public function maeApprovalHcpType()
    {
        return ['type' => 7];
    }

    public function maeRefundHcpType()
    {
        return ['type' => 8];
    }

    public function maeRefundMemberType()
    {
        return ['type' => 9];
    }

    public function claimBenefitType()
    {
        return ['type' => 10];
    }

    public function systemRejectedNotificationType()
    {
        return ['type' => 4];
    }

    public function unregisteredMemberNotificationType()
    {
        return ['type' => 11];
    }

    public function missingContributionNotificationType()
    {
        return ['type' => 12];
    }

    public function incorrectContributionNotificationType()
    {
        return ['type' => 13];
    }

    public function incorrectEmployeeInfoNotificationType()
    {
        return ['type' => 14];
    }

    public function rejectionNotificationApprovalType()
    {
        return ['type' => 5];
    }




    ///end: current workflow modules values

    /**
     * @description list of workflow module ids for unregistered member notification incident. The system will be looking for the modeule id from this function.
     * @return array
     */
    public function unregisteredMemberNotificationIds()
    {
        return [20];
    }


    /**
     * Get Definitions of a given modules
     * @param $module_id
     * @return mixed
     */
    public function getDefinitions($module_id)
    {
        $module = $this->find($module_id);
        $definitions = $module->definitions();
        return $definitions;
    }

    /**
     * @param $module_id
     * @return mixed
     * Get module group
     */
    public function getModuleGroupId($module_id)
    {
        $module = $this->find($module_id);
        $module_group_id = $module->wf_module_group_id;
        return $module_group_id;
    }


    /*Get module by wf track*/
    public function getModuleByWftrack($wf_track)
    {
        $module = $wf_track->wfDefinition->wfModule;
        return $module;
    }

}
