<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Database\DisableForeignKeys;
use Database\TruncateTable;

class OwnershipCategoryTableSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys("ownership_categories");
        $this->delete('ownership_categories');

        DB::table('ownership_categories')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'name' => 'Public',
                    'created_at' => '2022-01-08 17:08:30',
                    'updated_at' => '2022-01-08 17:08:30',
                ),
            1 =>
                array (
                    'id' => 2,
                    'name' => 'Private',
                    'created_at' => '2022-01-08 17:08:30',
                    'updated_at' => '2022-01-08 17:08:30',
                ),
        ));

        $this->enableForeignKeys("ownership_categories");
    }
}
