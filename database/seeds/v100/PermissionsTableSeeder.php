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
                    'description' => 'User can create v104',
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
                    'name' => 'workflow_participant',
                    'display_name' => 'Workflow participant',
                    'description' => 'User can participate in the workflow',
                    'ischecker' => 1,
                ),
            4 =>
                array (
                    'id' => 5,
                    'name' => 'deactivate_user',
                    'display_name' => 'User de-activator',
                    'description' => 'User can de-activate other user',
                    'ischecker' => 1,
                ),
            5 =>
                array (
                    'id' => 6,
                    'name' => 'apply_safari',
                    'display_name' => 'Apply Safari',
                    'description' => 'User can apply Safari Advance',
                    'ischecker' => 1,
                ),
            6 =>
                array (
                    'id' => 7,
                    'name' => 'edit_safari',
                    'display_name' => 'Edit Safari',
                    'description' => 'User can edit Safari Advance',
                    'ischecker' => 1,
                ),
            7 =>
                array (
                    'id' => 8,
                    'name' => 'apply_retirement',
                    'display_name' => 'Apply Retirement',
                    'description' => 'User can apply Retirement',
                    'ischecker' => 1,
                ),
            8 =>
                array (
                    'id' => 9,
                    'name' => 'edit_retirement',
                    'display_name' => 'Edit Retirement',
                    'description' => 'User can edit Retirement',
                    'ischecker' => 1,
                ),
            9 =>
                array (
                    'id' => 10,
                    'name' => 'user_management',
                    'display_name' => 'User Management',
                    'description' => 'User can manage other users in the system',
                    'ischecker' => 1,
                ),
            10 =>
                array (
                    'id' => 11,
                    'name' => 'project_settings',
                    'display_name' => 'Project Settings',
                    'description' => 'User can participate in the workflow',
                    'ischecker' => 1,
                ),
            11 =>
                array (
                    'id' => 12,
                    'name' => 'general_settings',
                    'display_name' => 'General Settings',
                    'description' => 'User can access general setting',
                    'ischecker' => 1,
                ),
            12 =>
                array (
                    'id' => 13,
                    'name' => 'budget_settings',
                    'display_name' => 'Budget Settings',
                    'description' => 'User can access budget settings',
                    'ischecker' => 1,
                ),
            13 =>
                array(
                    'id' => 14,
                    'name' => 'online_checkin',
                    'display_name' => 'Online Checkin',
                    'description' => 'User can checkin in the system online',
                    'ischecker' => 1,
                ),
            14 =>
                array(
                    'id' => 15,
                    'name' => 'apply_business_requisition',
                    'display_name' => 'Apply Business Requisition',
                    'description' => 'User can apply business requisition',
                    'ischecker' => 1,
                ),
            15 =>
                array(
                    'id' => 16,
                    'name' => 'apply_program_activity',
                    'display_name' => 'Apply Program Activity',
                    'description' => 'User can apply program activity',
                    'ischecker' => 1,
                ),
            16 =>
                array(
                    'id' => 17,
                    'name' => 'supply_chain',
                    'display_name' => 'Supply Chain',
                    'description' => 'User can access supply chain',
                    'ischecker' => 1,
                ),
            17 =>
                array(
                    'id' => 18,
                    'name' => 'fleet',
                    'display_name' => 'Fleet',
                    'description' => 'User can access fleet',
                    'ischecker' => 1,
                ),
            18 =>
                array(
                    'id' => 19,
                    'name' => 'finance_activity',
                    'display_name' => 'Finance Activity',
                    'description' => 'User can access finance activity',
                    'ischecker' => 1,
                ),
            19 =>
                array(
                    'id' => 20,
                    'name' => 'audit_trail',
                    'display_name' => 'Audit Trail',
                    'description' => 'User can access audit trail',
                    'ischecker' => 1,
                ),
            20 =>
                array(
                    'id' => 21,
                    'name' => 'financial_report',
                    'display_name' => 'Financial Report',
                    'description' => 'User can access Financial Reports',
                    'ischecker' => 1,
                ),
            21 =>
                array(
                    'id' => 22,
                    'name' => 'cqi_dashboard',
                    'display_name' => 'CQI Dashboard',
                    'description' => 'User can access CQI Dashboard',
                    'ischecker' => 1,
                ),
            22 =>
                array(
                    'id' => 23,
                    'name' => 'hr_dashboard',
                    'display_name' => 'HR Dashboard',
                    'description' => 'User can access HR Dashboard',
                    'ischecker' => 1,
                ),
            23 =>
                array(
                    'id' => 24,
                    'name' => 'hr_timesheet',
                    'display_name' => 'Timesheet Dashboard',
                    'description' => 'User can access HR Dashboard',
                    'ischecker' => 1,
                ),
            24 =>
                array(
                    'id' => 25,
                    'name' => 'hr_leave',
                    'display_name' => 'Leave Dashboard',
                    'description' => 'User can access HR Dashboard',
                    'ischecker' => 1,
                ),
            25 =>
                array(
                    'id' => 26,
                    'name' => 'cqi_dashboard_admin',
                    'display_name' => 'CQI Dashboard Admin',
                    'description' => 'User can access CQI Dashboard Admin',
                    'ischecker' => 1,
                ),

        ));
        $this->enableForeignKeys("permissions");

    }
}
