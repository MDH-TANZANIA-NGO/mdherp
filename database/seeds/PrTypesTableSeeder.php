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
        \DB::table('codes')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'title' => 'KNOWLEDGE OF THE JOB',
                ),
            1 =>
                array (
                    'id' => 2,
                    'title' => 'ACCOUNTABILITY & OWNERSHIP',
                ),
            2 =>
                array (
                    'id' => 3,
                    'title' => 'COMMUNICATION',
                ),
            3 =>
                array (
                    'id' => 4,
                    'title' => 'PUNCTUALITY AND ATTENDANCE',
                ),
            4 =>
                array (
                    'id' => 5,
                    'title' => 'RESULTS ORIENTATION',
                ),
            5 =>
                array (
                    'id' => 6,
                    'title' => 'PROFESSIONAL CONDUCT',
                ),
            6 =>
                array (
                    'id' => 7,
                    'title' => 'COLLABORATION & TEAM WORK',
                ),
            7 =>
                array (
                    'id' => 8,
                    'title' => 'INITIATIVE AND CREATIVITY',
                ),
            8 =>
                array (
                    'id' => 9,
                    'title' => 'MANAGING WORK',
                ),
            9 =>
                array (
                    'id' => 10,
                    'title' => '*DEVELOPING OTHERS',
                ),
            10 =>
                array (
                    'id' => 11,
                    'title' => '*STRATEGIC DECISION MAKING',
                ),
            11 =>
                array (
                    'id' => 12,
                    'title' => '*VALUING DIFFERENCE',
                ),
        ));
        $this->enableForeignKeys("pr_types");
    }
}
