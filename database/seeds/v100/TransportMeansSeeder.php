<?php
namespace Database\seeds\v100;
use Illuminate\Database\Seeder;

class TransportMeansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('transport_means')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'type' => 'Public Transport',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            1 =>
                array (
                    'id' => 2,
                    'type' => 'Flight',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            2 =>
                array (
                    'id' => 3,
                    'type' => 'Boat',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            3 =>
                array (
                    'id' => 4,
                    'type' => 'MDH Vehicle',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),

            4 =>
                array (
                    'id' => 5,
                    'type' => 'Others',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),

        ));
    }
}
