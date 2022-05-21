<?php
namespace Database\seeds\v100;
use Illuminate\Database\Seeder;

class AttachmentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('attachment_types')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'type' => 'Accomodation - Hotel Receipt',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            1 =>
                array (
                    'id' => 2,
                    'type' => 'OnTransit - Taxi Receipt',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            2 =>
                array (
                    'id' => 3,
                    'type' => 'OnTransit - Air Ticket/Board pass',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            3 =>
                array (
                    'id' => 4,
                    'type' => 'OnTransit - Fuel receipt',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            4 =>
                array (
                    'id' => 5,
                    'type' => 'OnTransit - Bus Ticket/Boat Ticket',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            5 =>
                array (
                    'id' => 6,
                    'type' => 'Others',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),

        ));
    }
}
