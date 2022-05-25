<?php

use Illuminate\Database\Seeder;
use Database\TruncateTable;
use Database\DisableForeignKeys;

class PrCompetenceKeysTableSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys("pr_competence_keys");
        $this->delete('pr_competence_keys');
        \DB::table('pr_competence_keys')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'title' => 'Knowledge of the job',
                ),
            1 =>
                array (
                    'id' => 2,
                    'title' => 'Accountability and ownership',
                ),
            2 =>
                array (
                    'id' => 3,
                    'title' => 'Communication',
                ),
            3 =>
                array (
                    'id' => 4,
                    'title' => 'Punctuality and attendance',
                ),
            4 =>
                array (
                    'id' => 5,
                    'title' => 'Results orientation',
                ),
            5 =>
                array (
                    'id' => 6,
                    'title' => 'Professional conduct',
                ),
            6 =>
                array (
                    'id' => 7,
                    'title' => 'Collaboration & team work',
                ),
            7 =>
                array (
                    'id' => 8,
                    'title' => 'Initiative and creativity',
                ),
            8 =>
                array (
                    'id' => 9,
                    'title' => 'Managing work',
                ),
            9 =>
                array (
                    'id' => 10,
                    'title' => '*developing others',
                ),
            10 =>
                array (
                    'id' => 11,
                    'title' => '*strategic decision making',
                ),
            11 =>
                array (
                    'id' => 12,
                    'title' => '*valuing difference',
                ),
        ));
        $this->enableForeignKeys("pr_competence_keys");
    }
}
