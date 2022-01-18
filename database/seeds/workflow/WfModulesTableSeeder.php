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
                    'description' => 'All Safari Advances',
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
                    'description' => 'All Program Activities',
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
                    'created_at' => '2021-12-13 12:36:03',
                    'updated_at' => \Carbon\Carbon::now(),
                    'deleted_at' => NULL,
                    'isactive' => '1',
                    'type' => '1',
                    'description' => 'Leave Requisition',
                    'allow_repeat' => 0,
                    'allow_decline' => 0,
                ),
        ));

        $this->enableForeignKeys('wf_modules');
    }
}
