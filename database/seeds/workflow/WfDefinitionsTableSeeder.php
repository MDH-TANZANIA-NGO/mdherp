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
                'unit_id' => '71',
                'designation_id' => '122',
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
                    'unit_id' => '1',
                    'designation_id' => '1',
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
                    'designation_id' => '13',
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
                    'designation_id' => 13,
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
                    'unit_id' => 5,
                    'designation_id' => 13,
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
                    'action_description' => 'Submitted',
                    'status_description' => 'Submitted',
//                'assign_next_user' => 0,
                ),
            9 =>
                array (
                    'id' => 10,
                    'level' => '2',
                    'unit_id' => 5,
                    'designation_id' => 13,
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
                    'action_description' => 'Approved',
                    'status_description' => 'Approved',
//                'assign_next_user' => 0,
                ),


        ));

        $this->enableForeignKeys('wf_definitions');

    }
}
