<?php

use Illuminate\Database\Seeder;
use Database\TruncateTable;
use Database\DisableForeignKeys;

class PrRateScaleTableSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys("pr_rate_scales");
        $this->delete('pr_rate_scales');
        \DB::table('pr_rate_scales')->insert(array(
            0 =>
                array(
                    'id' => 1,
                    'description' => 'Performance that is consistently below Expectations',
                    'rate' => 1,
                ),
            1 =>
                array(
                    'id' => 2,
                    'description' => 'Performance that Partially Meets Expectations',
                    'rate' => 2,
                ),
            2 =>
                array(
                    'id' => 3,
                    'description' => 'Performance that Successfully Meets Expectations',
                    'rate' => 3,
                ),
            3 =>
                array(
                    'id' => 4,
                    'description' => 'Performance that Exceeds Expectations',
                    'rate' => 4,
                ),
        ));
        $this->enableForeignKeys("pr_rate_scales");

    }
}
