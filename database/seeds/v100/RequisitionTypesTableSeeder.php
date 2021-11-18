<?php

use Illuminate\Database\Seeder;
use Database\TruncateTable;
use Database\DisableForeignKeys;

class RequisitionTypesTableSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys('requisition_types');
        $this->delete('requisition_types');

        \DB::table('requisition_types')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'title' => 'Procurement Requisition',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
        ));

        $this->enableForeignKeys('requisition_types');
    }
}
