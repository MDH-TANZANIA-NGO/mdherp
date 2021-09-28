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
                'name' => 'Travel Authorization Form',
                'wf_module_group_id' => '1',
                'created_at' => '2020-07-08 20:44:30',
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'isactive' => '1',
                'type' => '1',
                'description' => 'Travel Authorization Form - TAF Payment Approval',
                'allow_repeat' => 0,
                'allow_decline' => 0,
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'Travel & Business Expense Report',
                'wf_module_group_id' => '2',
                'created_at' => '2020-09-22 11:35:56',
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'isactive' => '1',
                'type' => '1',
                'description' => 'Travel & Business Expense Report - TBER Approval',
                'allow_repeat' => 0,
                'allow_decline' => 0,
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'TAF Extension',
                'wf_module_group_id' => '3',
                'created_at' => '2020-11-19 11:22:12',
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'isactive' => '1',
                'type' => '1',
                'description' => 'Travel Authorization Form Extension - TAF Extension Payment Approval',
                'allow_repeat' => 0,
                'allow_decline' => 0,
            ),
            3 =>
            array (
                'id' => 4,
                'name' => 'Cov And Cec Monthly Payment',
                'wf_module_group_id' => '4',
                'created_at' => '2021-03-17 11:49:11',
                'description' => 'Cov And Cec Monthly Payment',
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'isactive' => '1',
                'type' => '1',
                'allow_repeat' => 0,
                'allow_decline' => 0,
            ),
            4 =>
            array (
                'id' => 5,
                'name' => 'Leave Application Form',
                'wf_module_group_id' => '5',
                'created_at' => '2021-06-15 13:01:45',
                'description' => 'Leave Application Form - Leave Application Form Approval',
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'isactive' => '1',
                'type' => '1',
                'allow_repeat' => 0,
                'allow_decline' => 0,
            ),
        ));

        $this->enableForeignKeys('wf_modules');
    }
}
