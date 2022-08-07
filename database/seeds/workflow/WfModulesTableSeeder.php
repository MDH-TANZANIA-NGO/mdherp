<?php

use Illuminate\Database\Seeder;
use Database\TruncateTable;
use Database\DisableForeignKeys;

class WfModulesTableSeeder extends Seeder
{

    use DisableForeignKeys, TruncateTable;
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        $this->disableForeignKeys('wf_modules');
        $this->delete('wf_modules');

        \DB::table('wf_modules')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'Requisition Form',
                'wf_module_group_id' => '1',
                'created_at' => '2021-11-22 10:15:25',
                'updated_at' => \Carbon\Carbon::now(),
                'deleted_at' => NULL,
                'isactive' => '1',
                'type' => '1',
                'description' => 'Requisition Approval Process',
                'allow_repeat' => 0,
                'allow_decline' => 0,
            ),
            1 =>
                array (
                    'id' => 2,
                    'name' => 'Requisition Form For CEO ',
                    'wf_module_group_id' => '1',
                    'created_at' => '2021-12-13 12:36:03',
                    'updated_at' => \Carbon\Carbon::now(),
                    'deleted_at' => NULL,
                    'isactive' => '1',
                    'type' => '2',
                    'description' => 'Requisition Approval Process for CEO',
                    'allow_repeat' => 0,
                    'allow_decline' => 0,
                ),
            2 =>
                array (
                    'id' => 3,
                    'name' => 'Safari Advance Form ',
                    'wf_module_group_id' => '2',
                    'created_at' => '2021-12-13 12:36:03',
                    'updated_at' => \Carbon\Carbon::now(),
                    'deleted_at' => NULL,
                    'isactive' => '1',
                    'type' => '1',
                    'description' => 'Safari Advance requested by user',
                    'allow_repeat' => 0,
                    'allow_decline' => 0,
                ),
            3 =>
                array (
                    'id' => 4,
                    'name' => 'Program Activities Initiated ',
                    'wf_module_group_id' => '3',
                    'created_at' => '2021-12-13 12:36:03',
                    'updated_at' => \Carbon\Carbon::now(),
                    'deleted_at' => NULL,
                    'isactive' => '1',
                    'type' => '1',
                    'description' => 'All Program Activities Inititated',
                    'allow_repeat' => 0,
                    'allow_decline' => 0,
                ),
            4 =>
                array (
                    'id' => 5,
                    'name' => 'Retirement',
                    'wf_module_group_id' => '4',
                    'created_at' => '2021-12-13 12:36:03',
                    'updated_at' => \Carbon\Carbon::now(),
                    'deleted_at' => NULL,
                    'isactive' => '1',
                    'type' => '1',
                    'description' => 'All Retirements',
                    'allow_repeat' => 0,
                    'allow_decline' => 0,
                ),
            5 =>
                array (
                    'id' => 6,
                    'name' => 'Leave',
                    'wf_module_group_id' => '5',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                    'deleted_at' => NULL,
                    'isactive' => '1',
                    'type' => '1',
                    'description' => 'Leave',
                    'allow_repeat' => 0,
                    'allow_decline' => 0,
                ),
            6 =>
                array (
                    'id' => 7,
                    'name' => 'Payment',
                    'wf_module_group_id' => '6',
                    'created_at' => '2021-12-13 12:36:03',
                    'updated_at' => \Carbon\Carbon::now(),
                    'deleted_at' => NULL,
                    'isactive' => '1',
                    'type' => '1',
                    'description' => 'Payments',
                    'allow_repeat' => 0,
                    'allow_decline' => 0,
                ),
            7 =>
                array (
                    'id' => 8,
                    'name' => 'Timesheet',
                    'wf_module_group_id' => '7',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                    'deleted_at' => NULL,
                    'isactive' => '1',
                    'type' => '1',
                    'description' => 'Timesheets',
                    'allow_repeat' => 0,
                    'allow_decline' => 0,
                ),
            8 =>
                array (
                    'id' => 9,
                    'name' => 'Hire Requisition',
                    'wf_module_group_id' => '8',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                    'deleted_at' => NULL,
                    'isactive' => '1',
                    'type' => '1',
                    'description' => 'Hire Requisition, Approval Process for Hiring',
                    'allow_repeat' => 0,
                    'allow_decline' => 0,
                ),
            9 =>
                array (
                    'id' => 10,
                    'name' => 'Program Activity Report',
                    'wf_module_group_id' => '9',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                    'deleted_at' => NULL,
                    'isactive' => '1',
                    'type' => '1',
                    'description' => 'Program Activity Report',
                    'allow_repeat' => 0,
                    'allow_decline' => 0,
                ),
            10 =>
                array (
                    'id' => 11,
                    'name' => 'Performance Appraisal Goals/Objectives Evaluation[ Regional Normal Staff ]',
                    'wf_module_group_id' => '10',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => '1',
                    'type' => 2,
                    'description' => 'Performance Review for Probatioinary Appraisal Goals/Objectives Evaluation',
                    'allow_repeat' => 0,
                    'allow_decline' => 0,
                ),
                11 =>
                array (
                    'id' => 12,
                    'name' => 'Job Advertisement',
                    'wf_module_group_id' => '11',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => '1',
                    'type' => '1',
                    'description' => 'Workflow for Job Advertisement',
                    'allow_repeat' => 0,
                    'allow_decline' => 0,
                ),
            12 =>
                array (
                    'id' => 13,
                    'name' => 'Performance Appraisal Goals/Objectives Agreement [ For Directors, Managers, RMP ]',
                    'wf_module_group_id' => '10',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => '1',
                    'type' => 1,
                    'description' => 'Performance Review for Probatioinary Appraisal Goals/Objectives Agreement',
                    'allow_repeat' => 0,
                    'allow_decline' => 0,
                ),
            13 =>
                array (
                    'id' => 14,
                    'name' => 'Performance Appraisal Goals/Objectives Agreement [ For HQ ]',
                    'wf_module_group_id' => '10',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => '1',
                    'type' => 3,
                    'description' => 'Performance Review for Probatioinary Appraisal Goals/Objectives Agreement',
                    'allow_repeat' => 0,
                    'allow_decline' => 0,
                ),
                14 =>
                    array (
                        'id' => 15,
                        'name' => 'Performance Appraisal Goals/Objectives Agreement [ For Other Regions ]',
                        'wf_module_group_id' => '10',
                        'created_at' => NULL,
                        'updated_at' => NULL,
                        'deleted_at' => NULL,
                        'isactive' => '1',
                        'type' => 3,
                        'description' => 'Performance Review for Probatioinary Appraisal Goals/Objectives Agreement',
                        'allow_repeat' => 0,
                        'allow_decline' => 0,
                    ),
                    15 =>
                    array (
                        'id' => 16,
                        'name' => 'Job Interview Report',
                        'wf_module_group_id' => '12',
                        'created_at' => NULL,
                        'updated_at' => NULL,
                        'deleted_at' => NULL,
                        'isactive' => '1',
                        'type' => '1',
                        'description' => 'Workflow for Job Advertisement',
                        'allow_repeat' => 0,
                        'allow_decline' => 0,
                    ),
            16 =>
                array(
                'id' => 17,
                'name' => 'Hire Requisition Shortlister(s) Module',
                'wf_module_group_id' => 13,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'isactive' => '1',
                'type' => '1',
                'description' => 'Workflow for Hire Requisition Shortlister(s)',
                'allow_repeat' => 0,
                'allow_decline' => 0,
            ),
            17 =>
                array(
                    'id' => 18,
                    'name' => 'Job Offer Module',
                    'wf_module_group_id' => 14,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => '1',
                    'type' => '1',
                    'description' => 'Workflow for Job Offers',
                    'allow_repeat' => 0,
                    'allow_decline' => 0,
                ),
            18 =>
                array(
                    'id' => 19,
                    'name' => 'Shortlisted Applicant Report',
                    'wf_module_group_id' => 15,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                    'type' => 1,
                    'description' => 'Shortlisted Applicant Report',
                    'allow_repeat' => 0,
                    'allow_decline' => 0,
                ),
            19 =>
                array (
                    'id' => 20,
                    'name' => 'Performance Appraisal Goals/Objectives Agreement [ Managers for Regions ]',
                    'wf_module_group_id' => '10',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => '1',
                    'type' => 1,
                    'description' => 'Performance Review for Probatioinary Appraisal Goals/Objectives Agreement',
                    'allow_repeat' => 0,
                    'allow_decline' => 0,
                ),
            20 =>
                array (
                    'id' => 21,
                    'name' => 'Performance Appraisal Goals/Objectives Evaluation[ Normal HQ Staff ]',
                    'wf_module_group_id' => '10',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => '1',
                    'type' => 2,
                    'description' => 'Performance Review for Probatioinary Appraisal Goals/Objectives Evaluation',
                    'allow_repeat' => 0,
                    'allow_decline' => 0,
                ),
            21 =>
                array (
                    'id' => 22,
                    'name' => 'Performance Appraisal Goals/Objectives Evaluation[ HQ Managers ]',
                    'wf_module_group_id' => '10',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => '1',
                    'type' => 2,
                    'description' => 'Performance Review for Probatioinary Appraisal Goals/Objectives Evaluation',
                    'allow_repeat' => 0,
                    'allow_decline' => 0,
                ),
            22 =>
                array (
                    'id' => 23,
                    'name' => 'Performance Appraisal Goals/Objectives Evaluation[ Directors ]',
                    'wf_module_group_id' => '10',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => '1',
                    'type' => 2,
                    'description' => 'Performance Review for Probatioinary Appraisal Goals/Objectives Evaluation',
                    'allow_repeat' => 0,
                    'allow_decline' => 0,
                ),
            23 =>
                array (
                    'id' => 24,
                    'name' => 'Performance Appraisal Goals/Objectives Evaluation[ SMT ]',
                    'wf_module_group_id' => '10',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => '1',
                    'type' => 2,
                    'description' => 'Performance Review for Probatioinary Appraisal Goals/Objectives Evaluation',
                    'allow_repeat' => 0,
                    'allow_decline' => 0,
                ),

        ));

        $this->enableForeignKeys('wf_modules');
    }
}
