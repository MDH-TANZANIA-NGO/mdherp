<?php

use Illuminate\Database\Seeder;

class mdh_ratesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('mdh_rates')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'amount' => '0',
                    'created_at' => '2021-09-29 18:21:50',
                    'updated_at' => \Illuminate\Support\Carbon::now(),
                    'deleted_at' => NULL,
                ),
            1 =>
                array (
                    'id' => 2,
                    'amount' => '60000',
                    'created_at' => '2021-09-29 18:21:50',
                    'updated_at' => \Illuminate\Support\Carbon::now(),
                    'deleted_at' => NULL,
                ),
            2 =>
                array (
                    'id' => 3,
                    'amount' => '75000',
                    'created_at' => '2021-09-29 18:21:50',
                    'updated_at' => \Illuminate\Support\Carbon::now(),
                    'deleted_at' => NULL,
                ),
            3 =>
                array (
                    'id' => 4,
                    'amount' => '90000',
                    'created_at' => '2021-09-29 18:21:50',
                    'updated_at' => \Illuminate\Support\Carbon::now(),
                    'deleted_at' => NULL,
                ),
            4 =>
                array (
                    'id' => 5,
                    'amount' => '100000',
                    'created_at' => '2021-09-29 18:21:50',
                    'updated_at' => \Illuminate\Support\Carbon::now(),
                    'deleted_at' => NULL,
                ),
            5 =>
                array (
                    'id' => 6,
                    'amount' => '120 000',
                    'created_at' => '2021-09-29 18:21:50',
                    'updated_at' => \Illuminate\Support\Carbon::now(),
                    'deleted_at' => NULL,
                ),

        ));
    }
}
