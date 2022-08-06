<?php

use Illuminate\Database\Seeder;
use Database\DisableForeignKeys;
use Database\TruncateTable;

class CountryTableSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys("countries");
        $this->delete('countries');


        //
        \DB::table('countries')->insert(array (
            'id' => 1,
            'name' => 'Tanzania',
            'created_at' => '2021-10-19 11:20:00',
            'code' => 'TZ',
            'uuid' => 'b344070d-f8f6-4055-9e08-50e1a6941abc'
        )
            );
    }
}
