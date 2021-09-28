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
                'name' => 'Travel Authorized Form Approval',
                'table_name' => 'tafs',
                'created_at' => '2020-07-08 20:41:15',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            1 => array (
                'id' => 2,
                'name' => 'Travel & Business Expense Report',
                'table_name' => 'tbers',
                'created_at' => '2020-09-22 11:35:56',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            2 => array (
                'id' => 3,
                'name' => 'Travel Authorized Form Extension Approval',
                'table_name' => 'taf_extensions',
                'created_at' => '2020-11-19 11:20:42',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            3 => array (
                'id' => 4,
                'name' => 'Cov And Cec Payment Approval',
                'table_name' => 'cov_cec_monthly_payments',
                'created_at' => '2021-03-17 11:49:11',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            4 => array (
                'id' => 5,
                'name' => 'Leave Application Form Approval',
                'table_name' => 'leaves',
                'created_at' => '2021-06-15 12:34:00',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
        ));

        $this->enableForeignKeys('wf_module_groups');
    }
}
