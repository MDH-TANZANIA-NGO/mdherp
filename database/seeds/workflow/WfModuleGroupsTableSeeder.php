<?php

use Illuminate\Database\Seeder;
use Database\TruncateTable;
use Database\DisableForeignKeys;

class WfModuleGroupsTableSeeder extends Seeder
{

    use DisableForeignKeys, TruncateTable;
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        $this->disableForeignKeys('wf_module_groups');
        $this->delete('wf_module_groups');

        \DB::table('wf_module_groups')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'Requisition',
                'table_name' => 'requisitions',
                'created_at' => '2021-11-22 10:15:25',
                'updated_at' => \Carbon\Carbon::now(),
                'deleted_at' => NULL,
            ),
            1 =>
                array (
                    'id' => 2,
                    'name' => 'Safari Advance',
                    'table_name' => 'safari_advances',
                    'created_at' => '2021-11-22 10:15:25',
                    'updated_at' => \Carbon\Carbon::now(),
                    'deleted_at' => NULL,
                ),
            2 =>
                array (
                    'id' => 3,
                    'name' => 'Program Activity',
                    'table_name' => 'program_activities',
                    'created_at' => '2021-11-22 10:15:25',
                    'updated_at' => \Carbon\Carbon::now(),
                    'deleted_at' => NULL,
                ),
            3 =>
                array (
                    'id' => 4,
                    'name' => 'Retirement',
                    'table_name' => 'retirements',
                    'created_at' => '2021-11-22 10:15:25',
                    'updated_at' => \Carbon\Carbon::now(),
                    'deleted_at' => NULL,
                ),
            4 =>
                array (
                    'id' => 5,
                    'name' => 'Leave',
                    'table_name' => 'leaves',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                    'deleted_at' => NULL,
                ),
            5 =>
                array (
                    'id' => 6,
                    'name' => 'Payment',
                    'table_name' => 'payments',
                    'created_at' => '2021-11-22 10:15:25',
                    'updated_at' => \Carbon\Carbon::now(),
                    'deleted_at' => NULL,
                ),
            6 =>
                array (
                    'id' => 7,
                    'name' => 'Timesheet',
                    'table_name' => 'timesheets',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                    'deleted_at' => NULL,
                ),
            7 =>
                array (
                    'id' => 8,
                    'name' => 'Hire Requisition',
                    'table_name' => 'hr_hire_requisitions',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                    'deleted_at' => NULL,
                ),
            8 =>
                array (
                    'id' => 9,
                    'name' => 'Program Activity Report',
                    'table_name' => 'program_activity_reports',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                    'deleted_at' => NULL,
                ),
            9 =>
                array (
                    'id' => 10,
                    'name' => 'Performance Appraisal Report',
                    'table_name' => 'pr_reports',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            10 =>
                array (
                    'id' => 11,
                    'name' => 'Job Advertisement',
                    'table_name' => 'hr_hire_advertisement_requisitions',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            11 =>
                array (
                    'id' => 12,
                    'name' => 'Job Interview Report',
                    'table_name' => 'hr_interview_workflow_reports',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            12 =>
                array (
                    'id' => 13,
                    'name' => 'Hire Requisition Shortlister(s)',
                    'table_name' => 'hr_user_hire_requisition_job_shortlister_requests',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            13 =>
                array (
                    'id' => 14,
                    'name' => 'Job Offer Module',
                    'table_name' => 'job_offers',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            14 =>
                array (
                    'id' => 15,
                    'name' => 'Shortlisted Applicant Report',
                    'table_name' => 'hr_hire_requisition_job_applicant_requests',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            15 =>
                array (
                    'id' => 16,
                    'name' => 'Activity Report',
                    'table_name' => 'activity_reports',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
        ));

        $this->enableForeignKeys('wf_module_groups');
    }
}
