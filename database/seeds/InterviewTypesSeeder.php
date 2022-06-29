<?php

use Illuminate\Database\Seeder;
use Database\TruncateTable;
use Database\DisableForeignKeys;
class InterviewTypesSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->delete('hr_interview_types');

        \DB::table('hr_interview_types')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'name' => 'Written Interview',
                    'created_at' => '2020-07-08 20:16:49',
                ),
            1 =>
                array (
                    'id' => 2,
                    'name' => 'Practical Interview',
                    'created_at' => '2020-07-08 20:16:49',
                ),
            2 =>
                array (
                    'id' => 3,
                    'name' => 'Oral Interview',
                    'created_at' => '2020-07-08 20:16:49',
                )
             
        ));
    }
}
