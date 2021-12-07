<?php

use Illuminate\Database\Seeder;
use Database\TruncateTable;
use Database\DisableForeignKeys;

class RequisitionTypeCategoriesTableSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys('requisition_type_categories');
        $this->delete('requisition_type_categories');

        \DB::table('requisition_type_categories')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'requisition_type_id' => 2,
                    'name' => 'Traveling',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            1 =>
            array (
                    'id' => 2,
                    'requisition_type_id' => 2,
                    'name' => 'Training and others',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),

        ));

        $this->enableForeignKeys('requisition_type_categories');
    }
}
