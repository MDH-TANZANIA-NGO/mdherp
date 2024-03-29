<?php

use Database\DisableForeignKeys;
use Database\TruncateTable;
use Illuminate\Database\Seeder;

class ServicesSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys("services");
        $this->delete('services');

        \DB::table('services')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'name' => 'Accommodation',
                    'uuid' => 'hidsjkhdsiuh89093',
                ),
            1 =>
                array (
                    'id' => 2,
                    'name' => 'Meeting Package',
                    'uuid' => 'hidsjkhdsiuh89093',
                ),

        ));
    }
}
