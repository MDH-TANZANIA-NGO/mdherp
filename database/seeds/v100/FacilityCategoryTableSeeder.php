<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Database\DisableForeignKeys;
use Database\TruncateTable;

class FacilityCategoryTableSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys("facility_categories");
        $this->delete('facility_categories');

        DB::table('facility_categories')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'name' => 'Dispensary',
                    'created_at' => '2022-01-08 17:08:30',
                    'updated_at' => '2022-01-08 17:08:30',
                ),
            1 =>
                array (
                    'id' => 2,
                    'name' => 'Health Center',
                    'created_at' => '2022-01-08 17:08:30',
                    'updated_at' => '2022-01-08 17:08:30',
                ),
            2 =>
                array (
                    'id' => 3,
                    'name' => 'Maternity and Nursing Home',
                    'created_at' => '2022-01-08 17:08:30',
                    'updated_at' => '2022-01-08 17:08:30',
                ),
            3 =>
                array (
                    'id' => 4,
                    'name' => 'Maternity Home',
                    'created_at' => '2022-01-08 17:08:30',
                    'updated_at' => '2022-01-08 17:08:30',
                ),
            4 =>
                array (
                    'id' => 5,
                    'name' => 'Physiotherapy Clinic',
                    'created_at' => '2022-01-08 17:08:30',
                    'updated_at' => '2022-01-08 17:08:30',
                ),
            5 =>
                array (
                    'id' => 6,
                    'name' => 'Nursing Home',
                    'created_at' => '2022-01-08 17:08:30',
                    'updated_at' => '2022-01-08 17:08:30',
                ),
            6 =>
                array (
                    'id' => 7,
                    'name' => 'Clinic',
                    'created_at' => '2022-01-08 17:08:30',
                    'updated_at' => '2022-01-08 17:08:30',
                ),
            7 =>
                array (
                    'id' => 8,
                    'name' => 'Hospital',
                    'created_at' => '2022-01-08 17:08:30',
                    'updated_at' => '2022-01-08 17:08:30',
                ),
            8 =>
                array (
                    'id' => 9,
                    'name' => 'Health Labs',
                    'created_at' => '2022-01-08 17:08:30',
                    'updated_at' => '2022-01-08 17:08:30',
                ),
        ));

        $this->enableForeignKeys("facility_categories");
    }
}
