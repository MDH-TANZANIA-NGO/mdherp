<?php

use Illuminate\Database\Seeder;

class payment_typesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('payment_types')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'name' => 'Safari Advances',
                    'description' => NULL,
                    'updated_at' => \Illuminate\Support\Carbon::now(),

                ),
            1 =>
                array (
                    'id' => 2,
                    'name' => 'Program Activity',
                    'description' => NULL,
                    'updated_at' => \Illuminate\Support\Carbon::now(),

                )

        ));
    }
}
