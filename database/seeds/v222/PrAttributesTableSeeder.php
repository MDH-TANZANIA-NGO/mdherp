<?php

use Illuminate\Database\Seeder;
use Database\TruncateTable;
use Database\DisableForeignKeys;

class PrAttributesTableSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys("pr_attributes");
        $this->delete('pr_attributes');
        \DB::table('pr_attributes')->insert(array(
            0 =>
                array(
                    'id' => 1,
                    'title' => 'Punctuality',
                ),
            1 =>
                array(
                    'id' => 2,
                    'title' => 'Appearance',
                ),
            2 =>
                array(
                    'id' => 3,
                    'title' => 'Reliability',
                ),
            3 =>
                array(
                    'id' => 4,
                    'title' => 'Team Work',
                ),
            4 =>
                array(
                    'id' => 5,
                    'title' => 'Willingness to Learn',
                ),
            5 =>
                array(
                    'id' => 6,
                    'title' => 'Customer Focus',
                ),
            6 =>
                array(
                    'id' => 7,
                    'title' => 'Initiative',
                ),
            7 =>
                array(
                    'id' => 8,
                    'title' => 'Job Knowledge',
                ),
            8 =>
                array(
                    'id' => 9,
                    'title' => 'Ability to Learn',
                ),
            9 =>
                array(
                    'id' => 10,
                    'title' => 'Communication',
                ),
        ));
        $this->enableForeignKeys("pr_attributes");

    }
}
