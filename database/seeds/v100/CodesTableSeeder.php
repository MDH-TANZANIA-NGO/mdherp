<?php

use Illuminate\Database\Seeder;
use Database\TruncateTable;
use Database\DisableForeignKeys;

class CodesTableSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        $this->disableForeignKeys("codes");
        $this->delete('codes');

        \DB::table('codes')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'User Logs',
                'lang' => 'user_log',
                'is_system_defined' => 1,
            ),
            1 =>
                array (
                    'id' => 2,
                    'name' => 'user_gender',
                    'lang' => 'gender',
                    'is_system_defined' => 1,
                ),
            2 =>
                array (
                    'id' => 3,
                    'name' => 'user_account',
                    'lang' => 'user_account',
                    'is_system_defined' => 1,
                ),
            3 =>
                array (
                    'id' => 4,
                    'name' => 'marital_status',
                    'lang' => 'marital_status',
                    'is_system_defined' => 1,
                ),
            4 =>
                array (
                    'id' => 5,
                    'name' => 'Project Type',
                    'lang' => 'project_type',
                    'is_system_defined' => 1,
                ),
            5 =>
                array (
                    'id' => 6,
                    'name' => 'Address Type',
                    'lang' => 'address_type',
                    'is_system_defined' => 1,
                ),
            6 =>
                array (
                    'id' => 7,
                    'name' => 'Prospect for Appointment',
                    'lang' => 'prospect_for_appointment',
                    'is_system_defined' => 1,
                ),
            7 =>
                array (
                    'id' => 8,
                    'name' => 'Employment Condition',
                    'lang' => 'employment_condition',
                    'is_system_defined' => 1,
                ),
            8 =>
                array (
                    'id' => 9,
                    'name' => 'Establishment',
                    'lang' => 'establishment',
                    'is_system_defined' => 1,
                ),
            9 =>
                array (
                    'id' => 10,
                    'name' => 'Education Level',
                    'lang' => 'education_level',
                    'is_system_defined' => 1,
                ),
            10 =>
                array (
                    'id' => 11,
                    'name' => 'Readiness',
                    'lang' => 'readiness',
                    'is_system_defined' => 1,
                )


        ));
        $this->enableForeignKeys("codes");

    }
}
