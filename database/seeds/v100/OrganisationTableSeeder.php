<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Database\DisableForeignKeys;
use Database\TruncateTable;

class OrganisationTableSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys("organisations");
        $this->delete('organisations');
        \DB::table('organisations')->insert(array (
            0 =>
                array(
                    'id' => 1,
                    'name' => 'MDH',
                    'uuid' => '43c9aa60-7884-438a-8c6c-c3a0a5f119ef',
                    'created_at' => '2021-12-13 18:47:27',
                    'updated_at' => '2021-12-13 18:47:27',
                )
        ));
        $this->enableForeignKeys("organisations");
    }
}
