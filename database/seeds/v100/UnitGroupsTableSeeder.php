<?php

use Illuminate\Database\Seeder;
use Database\TruncateTable;
use Database\DisableForeignKeys;

class UnitGroupsTableSeeder extends Seeder
{

    use DisableForeignKeys, TruncateTable;
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        $this->disableForeignKeys('unit_groups');
        $this->delete('unit_groups');

        \DB::table('unit_groups')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'Internal Unit',
                'created_at' => '2021-09-29 18:21:50',
                'updated_at' => \Illuminate\Support\Carbon::now(),
                'deleted_at' => NULL,
            ),
            1 =>
                array (
                    'id' => 2,
                    'name' => 'External Unit',
                    'created_at' => '2021-09-29 18:21:50',
                    'updated_at' => \Illuminate\Support\Carbon::now(),
                    'deleted_at' => NULL,
                )
        ));

        $this->enableForeignKeys('unit_groups');
    }
}
