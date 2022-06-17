<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Database\DisableForeignKeys;
use Database\TruncateTable;

class OwnershipTableSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys("ownerships");
        $this->delete('ownerships');

        DB::table('ownerships')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'name' => 'MoHCDGEC',
                    'ownership_category_id' => 1,
                    'created_at' => '2022-01-08 17:08:30',
                    'updated_at' => '2022-01-08 17:08:30',
                ),
            1 =>
                array (
                    'id' => 2,
                    'name' => 'Military',
                    'ownership_category_id' => 1,
                    'created_at' => '2022-01-08 17:08:30',
                    'updated_at' => '2022-01-08 17:08:30',
                ),
            2 =>
                array (
                    'id' => 3,
                    'name' => 'Police',
                    'ownership_category_id' => 1,
                    'created_at' => '2022-01-08 17:08:30',
                    'updated_at' => '2022-01-08 17:08:30',
                ),
            3 =>
                array (
                    'id' => 4,
                    'name' => 'Prisons',
                    'ownership_category_id' => 1,
                    'created_at' => '2022-01-08 17:08:30',
                    'updated_at' => '2022-01-08 17:08:30',
                ),
            4 =>
                array (
                    'id' => 5,
                    'name' => 'LGA',
                    'ownership_category_id' => 1,
                    'created_at' => '2022-01-08 17:08:30',
                    'updated_at' => '2022-01-08 17:08:30',
                ),
            5 =>
                array (
                    'id' => 6,
                    'name' => 'Parastatal',
                    'ownership_category_id' => 1,
                    'created_at' => '2022-01-08 17:08:30',
                    'updated_at' => '2022-01-08 17:08:30',
                ),
            6 =>
                array (
                    'id' => 7,
                    'name' => 'MDAs',
                    'ownership_category_id' => 1,
                    'created_at' => '2022-01-08 17:08:30',
                    'updated_at' => '2022-01-08 17:08:30',
                ),
            7 =>
                array (
                    'id' => 8,
                    'name' => 'For Profit',
                    'ownership_category_id' => 2,
                    'created_at' => '2022-01-08 17:08:30',
                    'updated_at' => '2022-01-08 17:08:30',
                ),
            8 =>
                array (
                    'id' => 9,
                    'name' => 'Faith Based Organization (FBO)',
                    'ownership_category_id' => 2,
                    'created_at' => '2022-01-08 17:08:30',
                    'updated_at' => '2022-01-08 17:08:30',
                ),
            9 =>
                array (
                    'id' => 10,
                    'name' => 'NGOs',
                    'ownership_category_id' => 2,
                    'created_at' => '2022-01-08 17:08:30',
                    'updated_at' => '2022-01-08 17:08:30',
                ),
            10 =>
                array (
                    'id' => 11,
                    'name' => 'For Profit With Joint Venture',
                    'ownership_category_id' => 2,
                    'created_at' => '2022-01-08 17:08:30',
                    'updated_at' => '2022-01-08 17:08:30',
                ),
            11 =>
                array (
                    'id' => 12,
                    'name' => 'Investor (For Foreigners',
                    'ownership_category_id' => 2,
                    'created_at' => '2022-01-08 17:08:30',
                    'updated_at' => '2022-01-08 17:08:30',
                ),
            12 =>
                array (
                    'id' => 13,
                    'name' => 'Company',
                    'ownership_category_id' => 2,
                    'created_at' => '2022-01-08 17:08:30',
                    'updated_at' => '2022-01-08 17:08:30',
                ),
        ));

        $this->enableForeignKeys("ownerships");
    }
}
