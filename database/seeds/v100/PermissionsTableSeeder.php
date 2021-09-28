<?php

use Illuminate\Database\Seeder;
use Database\TruncateTable;
use Database\DisableForeignKeys;

class PermissionsTableSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        $this->disableForeignKeys("permissions");
        $this->delete('permissions');

        \DB::table('permissions')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'name' => 'create_system_admin',
                    'display_name' => 'System admin Create',
                    'description' => 'User can create other system admins',
                    'ischecker' => 1,
                ),
            1 =>
                array (
                    'id' => 2,
                    'name' => 'create_employee',
                    'display_name' => 'Employee creator',
                    'description' => 'User can create employee',
                    'ischecker' => 1,
                ),
            2 =>
                array (
                    'id' => 3,
                    'name' => 'roles_assignment',
                    'display_name' => 'Roles Assignment',
                    'description' => 'User can assign task to other users',
                    'ischecker' => 1,
                ),
            3 =>
                array (
                    'id' => 4,
                    'name' => 'roles_assignment',
                    'display_name' => 'Roles Assignment',
                    'description' => 'User can assign task to other staff',
                    'ischecker' => 1,
                ),
            4 =>
                array (
                    'id' => 5,
                    'name' => 'diactivate_user',
                    'display_name' => 'User di-activator',
                    'description' => 'User can di-activate other user',
                    'ischecker' => 1,
                ),
            5 =>
                array (
                    'id' => 6,
                    'name' => 'apply_taf',
                    'display_name' => 'Apply TAF',
                    'description' => 'User can apply Travel Authorized Form (TAF)',
                    'ischecker' => 1,
                ),
            6 =>
                array (
                    'id' => 7,
                    'name' => 'edit_taf',
                    'display_name' => 'Edit TAF',
                    'description' => 'User can edit Travel Authorized Form (TAF)',
                    'ischecker' => 1,
                ),
            7 =>
                array (
                    'id' => 8,
                    'name' => 'apply_tber',
                    'display_name' => 'Apply TBER',
                    'description' => 'User can apply Travel Authorized Form (TBER)',
                    'ischecker' => 1,
                ),
            8 =>
                array (
                    'id' => 9,
                    'name' => 'edit_tber',
                    'display_name' => 'Edit TBER',
                    'description' => 'User can edit Travel Authorized Form (TBER)',
                    'ischecker' => 1,
                ),
            9 =>
                array (
                    'id' => 10,
                    'name' => 'view_users',
                    'display_name' => 'View Users',
                    'description' => 'User can view other users of the system',
                    'ischecker' => 1,
                ),
            10 =>
                array (
                    'id' => 11,
                    'name' => 'workflow_participant',
                    'display_name' => 'Workflow participant',
                    'description' => 'User can participate in the workflow',
                    'ischecker' => 1,
                ),
            11 =>
                array (
                    'id' => 12,
                    'name' => 'settings',
                    'display_name' => 'Settings',
                    'description' => 'User can set all system setting',
                    'ischecker' => 1,
                ),
            12 =>
                array (
                    'id' => 13,
                    'name' => 'workflow',
                    'display_name' => 'workflow',
                    'description' => 'User can set workflow',
                    'ischecker' => 1,
                ),
            13 =>
                array (
                    'id' => 14,
                    'name' => 'module_viewer',
                    'display_name' => 'Module Viewer',
                    'description' => 'User can view modules',
                    'ischecker' => 1,
                ),
            14 =>
                array (
                    'id' => 15,
                    'name' => 'edit_anything',
                    'display_name' => 'edit anything',
                    'description' => 'User can Edit anything',
                    'ischecker' => 0,
                ),
            15 =>
                array (
                    'id' => 16,
                    'name' => 'apply_external_taf',
                    'display_name' => 'Apply External TAF',
                    'description' => 'User can apply Travel Authorized Form (TAF) for external user',
                    'ischecker' => 1,
                ),
            16 =>
                array (
                    'id' => 17,
                    'name' => 'access_automated_attendance',
                    'display_name' => 'Access Automated Attendance',
                    'description' => 'User can access automated attendance system',
                    'ischecker' => 1,
                ),
            17 =>
                array (
                    'id' => 18,
                    'name' => 'generate_taf_report',
                    'display_name' => 'Generate TAF Reports',
                    'description' => 'User can access and generate taf reports in a system',
                    'ischecker' => 1,
                ),
            18 =>
                array (
                    'id' => 19,
                    'name' => 'change_supervisor',
                    'display_name' => 'Change supervisor',
                    'description' => 'User can access and change supervisor on on-process TAF',
                    'ischecker' => 1,
                ),
            19 =>
                array (
                    'id' => 20,
                    'name' => 'view_offices',
                    'display_name' => 'View Offices',
                    'description' => 'User can access and View offices',
                    'ischecker' => 1,
                ),
            20 =>
                array (
                    'id' => 21,
                    'name' => 'cov_cec_payments',
                    'display_name' => 'Cov & Cec Payment',
                    'description' => 'User can access and View cov cec payments',
                    'ischecker' => 1,
                ),
            21 =>
                array (
                    'id' => 22,
                    'name' => 'add_employee_details',
                    'display_name' => 'Add Employee Details',
                    'description' => 'User can access employee and add details concerning leave',
                    'ischecker' => 1,
                ),
            22 =>
                array(
                    'id' => 23,
                    'name' => 'view_leaves',
                    'display_name' => 'View Leaves',
                    'description' => 'User can access and view leaves',
                    'ischecker' => 1,
                ),
            23 =>
                array(
                    'id' => 24,
                    'name' => 'online_checkin',
                    'display_name' => 'Online Checkin',
                    'description' => 'User can checkin in the system',
                    'ischecker' => 1,
                ),


        ));
        $this->enableForeignKeys("permissions");

    }
}
