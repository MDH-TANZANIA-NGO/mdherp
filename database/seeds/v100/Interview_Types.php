<?php

use Illuminate\Database\Seeder;
use Database\TruncateTable;
use Database\DisableForeignKeys;

class DesignationsTableSeeder extends Seeder
{

    use DisableForeignKeys, TruncateTable;
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        $this->delete('hr_interview_types');

        \DB::table('designations')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'name' => 'Written Interview',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL
                ),
            1 =>
                array (
                    'id' => 2,
                    'name' => 'Practical Interview',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL
                ),
            2 =>
                array (
                    'id' => 3,
                    'name' => 'Oral Interview',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                )
             
        ));
    }
}
