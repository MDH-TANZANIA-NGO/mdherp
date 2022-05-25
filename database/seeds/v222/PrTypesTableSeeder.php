<?php

use Illuminate\Database\Seeder;
use Database\TruncateTable;
use Database\DisableForeignKeys;

class PrTypesTableSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys("pr_types");
        $this->delete('pr_types');
        \DB::table('pr_types')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'title' => 'Probationary Appraisal',
                ),
            1 =>
                array (
                    'id' => 2,
                    'title' => 'Performance Evaluation – Mid Year Review',
                ),
            2 =>
                array (
                    'id' => 3,
                    'title' => 'Performance Evaluation: Final Review at the End of the Year:',
                ),
        ));
        $this->enableForeignKeys("pr_types");
    }
}
