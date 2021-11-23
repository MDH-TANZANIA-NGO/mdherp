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
                'description' => 'Requisition Approval Processess',
                'allow_repeat' => 0,
                'allow_decline' => 0,
            ),
        ));

        $this->enableForeignKeys('wf_modules');
    }
}
