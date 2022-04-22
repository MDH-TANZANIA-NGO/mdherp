<?php

use Illuminate\Database\Seeder;
use Database\TruncateTable;
use Database\DisableForeignKeys;

class DepartmentsTableSeeder extends Seeder
{
    use TruncateTable, DisableForeignKeys;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys("departments");
        $this->delete('departments');

        \DB::table('departments')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'title' => 'Senior Management Team',
                    'initial' => 'SMT',
                ),
            1 =>
                array (
                    'id' => 2,
                    'title' => 'Human Resource and Administration',
                    'initial' => 'HR',
                ),
            2 =>
                array (
                    'id' => 3,
                    'title' => 'Finance',
                    'initial' => 'FN',
                ),
            3 =>
                array (
                    'id' => 4,
                    'title' => 'Program',
                    'initial' => 'PR',
                ),
            4 =>
                array (
                    'id' => 5,
                    'title' => 'Strategic Information',
                    'initial' => 'SI',
                ),
            5 =>
                array (
                    'id' => 6,
                    'title' => 'Grants',
                    'initial' => 'GR',
                ),
            6 =>
                array (
                    'id' => 7,
                    'title' => 'Laboratory Department',
                    'initial' => 'LD',
                ),

        ));
        $this->enableForeignKeys("departments");
    }
}
