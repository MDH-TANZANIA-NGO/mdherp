<?php

use Illuminate\Database\Seeder;

class CountryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
