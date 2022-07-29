<?php

use Illuminate\Database\Seeder;
use Database\TruncateTable;
use Database\DisableForeignKeys;

class RetirementTypeSeeder extends Seeder
{

    use DisableForeignKeys, TruncateTable;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->disableForeignKeys("retirement_types");
        $this->delete('retirement_types');

        \DB::table('retirement_types')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'type' => 'Safari Advance Retirement',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            1 =>
                array (
                    'id' => 2,
                    'type' => 'Program Activity Retirement',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),

        ));

    }


}
