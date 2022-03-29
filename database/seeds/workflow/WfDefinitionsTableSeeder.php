<?php

use Illuminate\Database\Seeder;
use Database\TruncateTable;
use Database\DisableForeignKeys;

class WfDefinitionsTableSeeder extends Seeder
{

    use DisableForeignKeys, TruncateTable;
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        $this->disableForeignKeys('wf_definitions');
        $this->delete('wf_definitions');

        \DB::table('wf_definitions')->insert(array (
            /*START REQUISITION*/
            0 =>
                array (
                    'id' => 1,
                    'level' => '1',
                    'unit_id' => 69,
                    'designation_id' => 121,
                    'description' => 'Request Requisition',
                    'msg_next' => 'Request for review',
                    'wf_module_id' => '1',
                    'active' => '1',
                    'allow_rejection' => 1,
                    'allow_repeat_participate' => 0,
                    'created_at' => '2021-11-22 10:15:25',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'is_approval' => 0,
                    'has_next_start_optional' => 0,
                    'is_optional' => 0,
                    'can_close' => 0,
                    'action_description' => 'Request',
                    'status_description' => 'Requested',
//                'assign_next_user' => 0,
                ),
            1 =>
                array (
                    'id' => 2,
                    'level' => '2',
                    'unit_id' => 70,
                    'designation_id' => 122,
                    'description' => 'Review Requisition',
                    'msg_next' => 'Request for authorisation',
                    'wf_module_id' => '1',
                    'active' => '1',
                    'allow_rejection' => 1,
                    'allow_repeat_participate' => 0,
                    'created_at' => '2021-11-22 10:15:25',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'is_approval' => 0,
                    'has_next_start_optional' => 0,
                    'is_optional' => 0,
                    'can_close' => 0,
                    'action_description' => 'Review',
                    'status_description' => 'Reviewed',
//                'assign_next_user' => 0,
                ),
            2 =>
                array (
                    'id' => 3,
                    'level' => '3',
                    'unit_id' => 41,
                    'designation_id' => 82,
                    'description' => 'Authorize Requisition',
                    'msg_next' => 'Request for verification',
                    'wf_module_id' => '1',
                    'active' => '1',
                    'allow_rejection' => 1,
                    'allow_repeat_participate' => 0,
                    'created_at' => '2021-11-22 10:15:25',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'is_approval' => 0,
                    'has_next_start_optional' => 0,
                    'is_optional' => 0,
                    'can_close' => 0,
                    'action_description' => 'Authorize',
                    'status_description' => 'Authorized',
//                'assign_next_user' => 0,
                ),
            3 =>
                array (
                    'id' => 4,
                    'level' => '4',
                    'unit_id' => '74',
                    'designation_id' => '127',
                    'description' => 'Verify Requisition',
                    'msg_next' => 'Request for Endorsement',
                    'wf_module_id' => '1',
                    'active' => '1',
                    'allow_rejection' => 1,
                    'allow_repeat_participate' => 0,
                    'created_at' => '2021-11-22 10:15:25',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'is_approval' => 1,
                    'has_next_start_optional' => 0,
                    'is_optional' => 0,
                    'can_close' => 0,
                    'action_description' => 'Verify',
                    'status_description' => 'Verified',
//                'assign_next_user' => 0,
                ),
            4 =>
                array (
                    'id' => 5,
                    'level' => '5',
                    'unit_id' => '71',
                    'designation_id' => '123',
                    'description' => 'Endorse Requisition',
                    'msg_next' => 'Request Approval',
                    'wf_module_id' => '1',
                    'active' => '1',
                    'allow_rejection' => 1,
                    'allow_repeat_participate' => 0,
                    'created_at' => '2021-11-22 10:15:25',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'is_approval' => 1,
                    'has_next_start_optional' => 0,
                    'is_optional' => 0,
                    'can_close' => 0,
                    'action_description' => 'Endorse',
                    'status_description' => 'Endorsed',
//                'assign_next_user' => 0,
                ),
            5 =>
                array (
                    'id' => 6,
                    'level' => '6',
                    'unit_id' => '5',
                    'designation_id' => '128',
                    'description' => 'Approve Requisition',
                    'msg_next' => 'End Requisition',
                    'wf_module_id' => '1',
                    'active' => '1',
                    'allow_rejection' => 1,
                    'allow_repeat_participate' => 0,
                    'created_at' => '2021-11-22 10:15:25',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'is_approval' => 0,
                    'has_next_start_optional' => 0,
                    'is_optional' => 0,
                    'can_close' => 1,
                    'action_description' => 'Approve',
                    'status_description' => 'Approved',
//                'assign_next_user' => 0,
                ),

            //Senior
            6 =>
                array (
                    'id' => 7,
                    'level' => '1',
                    'unit_id' => 69,
                    'designation_id' => 121,
                    'description' => 'Request Requisition',
                    'msg_next' => 'Request for review',
                    'wf_module_id' => '2',
                    'active' => '1',
                    'allow_rejection' => 1,
                    'allow_repeat_participate' => 0,
                    'created_at' => '2021-11-22 10:15:25',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'is_approval' => 0,
                    'has_next_start_optional' => 0,
                    'is_optional' => 0,
                    'can_close' => 0,
                    'action_description' => 'Request',
                    'status_description' => 'Requested',
//                'assign_next_user' => 0,
                ),
            7 =>
                array (
                    'id' => 8,
                    'level' => '2',
                    'unit_id' => 5,
                    'designation_id' => 121,
                    'description' => 'Approve Requisition',
                    'msg_next' => 'End Requisition',
                    'wf_module_id' => '2',
                    'active' => '1',
                    'allow_rejection' => 1,
                    'allow_repeat_participate' => 0,
                    'created_at' => '2021-11-22 10:15:25',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'is_approval' => 0,
                    'has_next_start_optional' => 0,
                    'is_optional' => 0,
                    'can_close' => 1,
                    'action_description' => 'Approve',
                    'status_description' => 'Approved',
//                'assign_next_user' => 0,
                ),

            8 =>
                array (
                    'id' => 9,
                    'level' => '1',
                    'unit_id' => 69,
                    'designation_id' => 124,
                    'description' => 'Submit Safari Advance',
                    'msg_next' => 'Submit Safari Advance',
                    'wf_module_id' => '3',
                    'active' => '1',
                    'allow_rejection' => 1,
                    'allow_repeat_participate' => 0,
                    'created_at' => '2021-11-22 10:15:25',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'is_approval' => 0,
                    'has_next_start_optional' => 0,
                    'is_optional' => 0,
                    'can_close' => 0,
                    'action_description' => 'Submit',
                    'status_description' => 'Submitted',
//                'assign_next_user' => 0,
                ),
            9 =>
                array (
                    'id' => 10,
                    'level' => '2',
                    'unit_id' => 72,
                    'designation_id' => 125,
                    'description' => 'Approve Safari Advance',
                    'msg_next' => 'Approve Safari Advance',
                    'wf_module_id' => '3',
                    'active' => '1',
                    'allow_rejection' => 1,
                    'allow_repeat_participate' => 0,
                    'created_at' => '2021-11-22 10:15:25',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'is_approval' => 0,
                    'has_next_start_optional' => 0,
                    'is_optional' => 0,
                    'can_close' => 1,
                    'action_description' => 'Approve',
                    'status_description' => 'Approved',
//                'assign_next_user' => 0,
                ),
            10 =>
                array (
                    'id' => 11,
                    'level' => '1',
                    'unit_id' => 69,
                    'designation_id' => 124,
                    'description' => 'Submit Program Activity',
                    'msg_next' => 'Submit Program Activity',
                    'wf_module_id' => '4',
                    'active' => '1',
                    'allow_rejection' => 1,
                    'allow_repeat_participate' => 0,
                    'created_at' => '2021-11-22 10:15:25',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'is_approval' => 0,
                    'has_next_start_optional' => 0,
                    'is_optional' => 0,
                    'can_close' => 1,
                    'action_description' => 'Submit',
                    'status_description' => 'Submitted',
//                'assign_next_user' => 0,
                ),
            11 =>
                array (
                    'id' => 12,
                    'level' => '2',
                    'unit_id' => 72,
                    'designation_id' => 125,
                    'description' => 'Approve Program Activity',
                    'msg_next' => 'Approve Program Activity',
                    'wf_module_id' => '4',
                    'active' => '1',
                    'allow_rejection' => 1,
                    'allow_repeat_participate' => 0,
                    'created_at' => '2021-11-22 10:15:25',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'is_approval' => 0,
                    'has_next_start_optional' => 0,
                    'is_optional' => 0,
                    'can_close' => 1,
                    'action_description' => 'Approve',
                    'status_description' => 'Approved',
//                'assign_next_user' => 0,
                ),
            12 =>
                array (
                    'id' => 13,
                    'level' => '1',
                    'unit_id' => 69,
                    'designation_id' => 124,
                    'description' => 'Submit Retirement',
                    'msg_next' => 'Request for Approval',
                    'wf_module_id' => '5',
                    'active' => '1',
                    'allow_rejection' => 1,
                    'allow_repeat_participate' => 0,
                    'created_at' => '2021-11-22 10:15:25',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'is_approval' => 0,
                    'has_next_start_optional' => 0,
                    'is_optional' => 0,
                    'can_close' => 0,
                    'action_description' => 'Submit',
                    'status_description' => 'Submitted',

                ),
            13 =>
                array (
                    'id' => 14,
                    'level' => '2',
                    'unit_id' => 72,
                    'designation_id' => 125,
                    'description' => 'Approve Retirement',
                    'msg_next' => 'Request for Endorsement',
                    'wf_module_id' => '5',
                    'active' => '1',
                    'allow_rejection' => 1,
                    'allow_repeat_participate' => 0,
                    'created_at' => '2021-11-22 10:15:25',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'is_approval' => 0,
                    'has_next_start_optional' => 0,
                    'is_optional' => 0,
                    'can_close' => 0,
                    'action_description' => 'Approve',
                    'status_description' => 'Approved',

                ),
            14 =>
                array (
                    'id' => 15,
                    'level' => '3',
                    'unit_id' => 73,
                    'designation_id' => 126,
                    'description' => 'Complete Retirement',
                    'msg_next' => 'End Retirement',
                    'wf_module_id' => '5',
                    'active' => '1',
                    'allow_rejection' => 1,
                    'allow_repeat_participate' => 0,
                    'created_at' => '2021-11-22 10:15:25',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'is_approval' => 0,
                    'has_next_start_optional' => 0,
                    'is_optional' => 0,
                    'can_close' => 1,
                    'action_description' => 'Complete',
                    'status_description' => 'Completed',
//                'assign_next_user' => 0,
                ),
            15 =>
                array (
                    'id' => 16,
                    'level' => '1',
                    'unit_id' => 69,
                    'designation_id' => 124,
                    'description' => 'Initiate Payment',
                    'msg_next' => 'Initiate Payment',
                    'wf_module_id' => '7',
                    'active' => '1',
                    'allow_rejection' => 1,
                    'allow_repeat_participate' => 0,
                    'created_at' => '2021-11-22 10:15:25',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'is_approval' => 0,
                    'has_next_start_optional' => 0,
                    'is_optional' => 0,
                    'can_close' => 0,
                    'action_description' => 'Initiate',
                    'status_description' => 'Initiated',
//                'assign_next_user' => 0,
                ),
            16 =>
                array (
                    'id' => 17,
                    'level' => '2',
                    'unit_id' => 73,
                    'designation_id' => 126,
                    'description' => 'Endorse Payment',
                    'msg_next' => 'Endorse Payment',
                    'wf_module_id' => '7',
                    'active' => '1',
                    'allow_rejection' => 1,
                    'allow_repeat_participate' => 0,
                    'created_at' => '2021-11-22 10:15:25',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'is_approval' => 0,
                    'has_next_start_optional' => 0,
                    'is_optional' => 0,
                    'can_close' => 0,
                    'action_description' => 'Endorse',
                    'status_description' => 'Endorsed',
//                'assign_next_user' => 0,
                ),

            17 =>
                array (
                    'id' => 18,
                    'level' => '3',
                    'unit_id' => 72,
                    'designation_id' => 125,
                    'description' => 'Approve Payment',
                    'msg_next' => 'Approve Payment',
                    'wf_module_id' => '7',
                    'active' => '1',
                    'allow_rejection' => 1,
                    'allow_repeat_participate' => 0,
                    'created_at' => '2021-11-22 10:15:25',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'is_approval' => 0,
                    'has_next_start_optional' => 0,
                    'is_optional' => 0,
                    'can_close' => 1,
                    'action_description' => 'Approve',
                    'status_description' => 'Approved',
//                'assign_next_user' => 0,
                ),
            18 =>
                array (
                    'id' => 19,
                    'level' => '1',
                    'unit_id' => 69,
                    'designation_id' => 124,
                    'description' => 'Submit Leave',
                    'msg_next' => 'Submit Leave',
                    'wf_module_id' => '6',
                    'active' => '1',
                    'allow_rejection' => 1,
                    'allow_repeat_participate' => 1,
                    'created_at' => '2021-11-22 10:15:25',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'is_approval' => 0,
                    'has_next_start_optional' => 0,
                    'is_optional' => 0,
                    'can_close' => 0,
                    'action_description' => 'Complete',
                    'status_description' => 'Completed',
//                'assign_next_user' => 0,
                ),
            19 =>
                array (
                    'id' => 20,
                    'level' => '2',
                    'unit_id' => 74,
                    'designation_id' => 124,
                    'description' => 'Review Leave Request',
                    'msg_next' => 'Review Leave Request',
                    'wf_module_id' => '6',
                    'active' => '1',
                    'allow_rejection' => 1,
                    'allow_repeat_participate' => 1,
                    'created_at' => '2021-11-22 10:15:25',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'is_approval' => 0,
                    'has_next_start_optional' => 0,
                    'is_optional' => 0,
                    'can_close' => 0,
                    'action_description' => 'Review',
                    'status_description' => 'Reviewed',
//                'assign_next_user' => 0,
                ),

            20 =>
                array (
                    'id' => 21,
                    'level' => '3',
                    'unit_id' => 71,
                    'designation_id' => 123,
                    'description' => 'Authorize Leave Request',
                    'msg_next' => 'Authorize Leave Request',
                    'wf_module_id' => '6',
                    'active' => '1',
                    'allow_rejection' => 1,
                    'allow_repeat_participate' => 1,
                    'created_at' => '2021-11-22 10:15:25',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'is_approval' => 0,
                    'has_next_start_optional' => 0,
                    'is_optional' => 0,
                    'can_close' => 1,
                    'action_description' => 'Authorize',
                    'status_description' => 'Authorized',
//                'assign_next_user' => 0,
                ),

            21 =>
                array (
                    'id' => 22,
                    'level' => '4',
                    'unit_id' => 2,
                    'designation_id' => 4,
                    'description' => 'Endorse Leave Request',
                    'msg_next' => 'Endorse Leave Request',
                    'wf_module_id' => '6',
                    'active' => '1',
                    'allow_rejection' => 1,
                    'allow_repeat_participate' => 1,
                    'created_at' => '2021-11-22 10:15:25',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'is_approval' => 0,
                    'has_next_start_optional' => 0,
                    'is_optional' => 0,
                    'can_close' => 0,
                    'action_description' => 'Endorse',
                    'status_description' => 'Endorsed',
//                'assign_next_user' => 0,
                ),
            22 =>
                array (
                    'id' => 23,
                    'level' => '5',
                    'unit_id' => 5,
                    'designation_id' => 121,
                    'description' => 'Approve Leave Request',
                    'msg_next' => 'Approve Leave Request',
                    'wf_module_id' => '6',
                    'active' => '1',
                    'allow_rejection' => 1,
                    'allow_repeat_participate' => 1,
                    'created_at' => '2021-11-22 10:15:25',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'is_approval' => 0,
                    'has_next_start_optional' => 0,
                    'is_optional' => 0,
                    'can_close' => 1,
                    'action_description' => 'Approve',
                    'status_description' => 'Approved',
//                'assign_next_user' => 0,
                ),
            23 =>
                array (
                    'id' => 24,
                    'level' => '1',
                    'unit_id' => 69,
                    'designation_id' => 124,
                    'description' => 'Submit Timesheet',
                    'msg_next' => 'Submit Timesheet',
                    'wf_module_id' => '8',
                    'active' => '1',
                    'allow_rejection' => 1,
                    'allow_repeat_participate' => 0,
                    'created_at' => '2021-11-22 10:15:25',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'is_approval' => 0,
                    'has_next_start_optional' => 0,
                    'is_optional' => 0,
                    'can_close' => 0,
                    'action_description' => 'Complete',
                    'status_description' => 'Completed',
//                'assign_next_user' => 0,
                ),
            24 =>
                array (
                    'id' => 25,
                    'level' => '2',
                    'unit_id' => 72,
                    'designation_id' => 125,
                    'description' => 'Approve Timesheet',
                    'msg_next' => 'Approve Timesheet',
                    'wf_module_id' => '8',
                    'active' => '1',
                    'allow_rejection' => 1,
                    'allow_repeat_participate' => 0,
                    'created_at' => '2021-11-22 10:15:25',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'is_approval' => 0,
                    'has_next_start_optional' => 0,
                    'is_optional' => 0,
                    'can_close' => 1,
                    'action_description' => 'Approved',
                    'status_description' => 'Approved',
//                'assign_next_user' => 0,
                ),
            25 =>
                array (
                    'id' => 26,
                    'level' => '1',
                    'unit_id' => 1,
                    'designation_id' => 12,
                    'description' => 'Submit Hire Requisition',
                    'msg_next' => 'Submit Hire Requisition',
                    'wf_module_id' => '9',
                    'active' => '1',
                    'allow_rejection' => 0,
                    'allow_repeat_participate' => 0,
                    'created_at' => '2021-11-22 10:15:25',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'is_approval' => 0,
                    'has_next_start_optional' => 0,
                    'is_optional' => 0,
                    'can_close' => 0,
                    'action_description' => 'Submitted',
                    'status_description' => 'Submitted',
//                'assign_next_user' => 0,
                ),
            26 =>
                array (
                    'id' => 27,
                    'level' => '2',
                    'unit_id' => 1,
                    'designation_id' => 12,
                    'description' => 'Approve Hire Requisition',
                    'msg_next' => 'Approve Hire Requisition',
                    'wf_module_id' => '9',
                    'active' => '1',
                    'allow_rejection' => 0,
                    'allow_repeat_participate' => 0,
                    'created_at' => '2021-11-22 10:15:25',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'is_approval' => 0,
                    'has_next_start_optional' => 0,
                    'is_optional' => 0,
                    'can_close' => 0,
                    'action_description' => 'Approved',
                    'status_description' => 'Approved',
//                'assign_next_user' => 0,
                ),
            27 =>
                array (
                    'id' => 28,
                    'level' => '3',
                    'unit_id' => 1,
                    'designation_id' => 12,
                    'description' => 'Confirm Hire Requisition',
                    'msg_next' => 'Confirm Hire Requisition',
                    'wf_module_id' => '9',
                    'active' => '1',
                    'allow_rejection' => 0,
                    'allow_repeat_participate' => 0,
                    'created_at' => '2021-11-22 10:15:25',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'is_approval' => 0,
                    'has_next_start_optional' => 0,
                    'is_optional' => 0,
                    'can_close' => 0,
                    'action_description' => 'Confirmed',
                    'status_description' => 'Confirmed',
//                'assign_next_user' => 0,
                ),
            28 =>
                array (
                    'id' => 29,
                    'level' => '4',
                    'unit_id' => 1,
                    'designation_id' => 12,
                    'description' => 'Authorize Hire Requisition',
                    'msg_next' => 'Authorize Hire Requisition',
                    'wf_module_id' => '9',
                    'active' => '1',
                    'allow_rejection' => 0,
                    'allow_repeat_participate' => 0,
                    'created_at' => '2021-11-22 10:15:25',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'is_approval' => 1,
                    'has_next_start_optional' => 0,
                    'is_optional' => 0,
                    'can_close' => 0,
                    'action_description' => 'Authorized',
                    'status_description' => 'Authorized',
//                'assign_next_user' => 0,
                ),
            29 =>
                array (
                    'id' => 30,
                    'level' => '1',
                    'unit_id' => 69,
                    'designation_id' => 124,
                    'description' => 'Submit Program Activity Report',
                    'msg_next' => 'Submit Program Activity Report',
                    'wf_module_id' => '10',
                    'active' => '1',
                    'allow_rejection' => 0,
                    'allow_repeat_participate' => 0,
                    'created_at' => '2021-11-22 10:15:25',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'is_approval' => 0,
                    'has_next_start_optional' => 0,
                    'is_optional' => 1,
                    'can_close' => 0,
                    'action_description' => 'Submitted',
                    'status_description' => 'Submitted',
//                'assign_next_user' => 0,
                ),
            30 =>
                array (
                    'id' => 32,
                    'level' => '2',
                    'unit_id' => 72,
                    'designation_id' => 125,
                    'description' => 'Approve Program Activity Report',
                    'msg_next' => 'Approve Program Activity Report',
                    'wf_module_id' => '10',
                    'active' => '1',
                    'allow_rejection' => 1,
                    'allow_repeat_participate' => 0,
                    'created_at' => '2021-11-22 10:15:25',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'is_approval' => 1,
                    'has_next_start_optional' => 0,
                    'is_optional' => 0,
                    'can_close' => 1,
                    'action_description' => 'Approved',
                    'status_description' => 'Approved',
//                'assign_next_user' => 0,
                ),

        ));

        $this->enableForeignKeys('wf_definitions');

    }
}
