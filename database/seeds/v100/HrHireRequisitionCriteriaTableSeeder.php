<?php
use Illuminate\Database\Seeder;
use Database\TruncateTable;
use Database\DisableForeignKeys;

class HrHireRequisitionCriteriaTableSeeder extends Seeder
{

    use DisableForeignKeys, TruncateTable;
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        $this->disableForeignKeys('hr_hire_requisitioin_criterias');
        $this->delete('hr_hire_requisitioin_criterias');

        DB::table('hr_hire_requisitioin_criterias')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'Education Level',
                'created_at' => '2021-09-29 18:21:50',
                'uuid' => '3c910198-4d49-40fc-b17a-7c4c99aafeee',
                'updated_at' => \Illuminate\Support\Carbon::now(),
                'deleted_at' => NULL,
            ),
            1 =>
                array (
                    'id' => 2,
                    'name' => 'Age Limit',
                    'created_at' => '2021-09-29 18:21:50',
                    'uuid' => '3c910198-4d49-40fc-b17a-7c4c99aafeee',
                    'updated_at' => \Illuminate\Support\Carbon::now(),
                    'deleted_at' => NULL,
                ),
            2 =>
                array (
                    'id' => 3,
                    'name' => 'Skills',
                    'created_at' => '2021-09-29 18:21:50',
                    'uuid' => '3c910198-4d49-40fc-b17a-7c4c99aafeee',
                    'updated_at' => \Illuminate\Support\Carbon::now(),
                    'deleted_at' => NULL,
                ),
            3 =>
                array (
                    'id' => 4,
                    'name' => 'Experience',
                    'created_at' => '2021-09-29 18:21:50',
                    'uuid' => '3c910198-4d49-40fc-b17a-7c4c99aafeee',
                    'updated_at' => \Illuminate\Support\Carbon::now(),
                    'deleted_at' => NULL,
                ),
            4 =>
                array (
                    'id' => 5,
                    'name' => 'Professional Certificate',
                    'created_at' => '2021-09-29 18:21:50',
                    'uuid' => '3c910198-4d49-40fc-b17a-7c4c99aafeee',
                    'updated_at' => \Illuminate\Support\Carbon::now(),
                    'deleted_at' => NULL,
                )
        ));

        $this->enableForeignKeys('hr_hire_requisitioin_criterias');
    }
}
