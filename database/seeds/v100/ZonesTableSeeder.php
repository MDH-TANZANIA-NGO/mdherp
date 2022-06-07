<?php

use Illuminate\Database\Seeder;
use Database\TruncateTable;
use Database\DisableForeignKeys;

class ZonesTableSeeder extends Seeder
{
    use TruncateTable, DisableForeignKeys;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys("zones");
        $this->delete('zones');

        \DB::table('zones')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'name' => 'Central zone',
                    'initial' => 'CZ',
                ),
            1 =>
                array (
                    'id' => 2,
                    'name' => 'Eastern zone',
                    'initial' => 'EZ',
                ),
            2 =>
                array (
                    'id' => 3,
                    'name' => 'Lake Zone',
                    'initial' => 'LZ',
                ),
            3 =>
                array (
                    'id' => 4,
                    'name' => 'North zone',
                    'initial' => 'NZ',
                ),
            4 =>
                array (
                    'id' => 5,
                    'name' => 'Southern highland zone',
                    'initial' => 'SHZ',
                ),
            5 =>
                array (
                    'id' => 6,
                    'name' => 'Southern zone',
                    'initial' => 'SZ',
                )
        ));
        $this->enableForeignKeys("zones");
    }
}


