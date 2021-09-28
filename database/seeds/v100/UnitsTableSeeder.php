<?php

use Illuminate\Database\Seeder;
use Database\TruncateTable;
use Database\DisableForeignKeys;

class UnitsTableSeeder extends Seeder
{

    use DisableForeignKeys, TruncateTable;
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        $this->disableForeignKeys('units');
        $this->delete('units');

        \DB::table('units')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'Accountant',
                'title' => 'Accountant',
                'unit_group_id' => '1',
                'isactive' => '1',
                'created_at' => '2020-07-08 20:16:49',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'Administrative',
                'title' => 'Administrative',
                'unit_group_id' => '1',
                'isactive' => '1',
                'created_at' => '2020-07-08 20:16:49',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            2 =>
                array (
                    'id' => 3,
                    'name' => 'Assistant',
                    'title' => 'Assistant',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            3 =>
                array (
                    'id' => 4,
                    'name' => 'Boat',
                    'title' => 'Boat',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            4 =>
                array (
                    'id' => 5,
                    'name' => 'Contract and compliance',
                    'title' => 'CC',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            5 =>
                array (
                    'id' => 6,
                    'name' => 'Director',
                    'title' => 'DR',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            6 =>
                array (
                    'id' => 7,
                    'name' => 'Executive',
                    'title' => 'EX',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            7 =>
                array (
                    'id' => 8,
                    'name' => 'Field',
                    'title' => 'FD',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            8 =>
                array (
                    'id' => 9,
                    'name' => 'Finance',
                    'title' => 'FN',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            9 =>
                array (
                    'id' => 10,
                    'name' => 'Fleet',
                    'title' => 'FL',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            10 =>
                array (
                    'id' => 11,
                    'name' => 'Health Informatics',
                    'title' => 'HI',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            11 =>
                array (
                    'id' => 12,
                    'name' => 'Human Resource',
                    'title' => 'HR',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            12 =>
                array (
                    'id' => 13,
                    'name' => 'ICT',
                    'title' => 'ICT',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            13 =>
                array (
                    'id' => 14,
                    'name' => 'Inventory and asset',
                    'title' => 'IA',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            14 =>
                array (
                    'id' => 15,
                    'name' => 'Linkage and retention',
                    'title' => 'LR',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            15 =>
                array (
                    'id' => 16,
                    'name' => 'Operation',
                    'title' => 'OP',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            16 =>
                array (
                    'id' => 17,
                    'name' => 'Operation and HR',
                    'title' => 'OHR',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            17 =>
                array (
                    'id' => 18,
                    'name' => 'Procurement and Logistic',
                    'title' => 'PL',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            18 =>
                array (
                    'id' => 19,
                    'name' => 'Program',
                    'title' => 'PG',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            19 =>
                array (
                    'id' => 20,
                    'name' => 'Program and improvement',
                    'title' => 'PGI',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            20 =>
                array (
                    'id' => 21,
                    'name' => 'Project',
                    'title' => 'PR',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            21 =>
                array (
                    'id' => 22,
                    'name' => 'Senior',
                    'title' => 'SN',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            22 =>
                array (
                    'id' => 23,
                    'name' => 'Service agreement',
                    'title' => 'SA',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            23 =>
                array (
                    'id' => 24,
                    'name' => 'Social mobilization and marketing',
                    'title' => 'SMM',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            24 =>
                array (
                    'id' => 25,
                    'name' => 'Strategic information',
                    'title' => 'SI',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            25 =>
                array (
                    'id' => 26,
                    'name' => 'Technical',
                    'title' => 'TC',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            26 =>
                array (
                    'id' => 27,
                    'name' => 'Truck',
                    'title' => 'TRK',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            27 =>
                array (
                    'id' => 28,
                    'name' => 'Zonal strategic information',
                    'title' => 'ZST',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            28 =>
                array (
                    'id' => 29,
                    'name' => 'Zonal project manager',
                    'title' => 'ZPM',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            29 =>
                array (
                    'id' => 30,
                    'name' => 'ICAP',
                    'title' => 'ICAP',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            30 =>
                array (
                    'id' => 31,
                    'name' => 'Country',
                    'title' => 'CON',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            31 =>
                array (
                    'id' => 32,
                    'name' => 'Employee',
                    'title' => 'EMP',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            32 =>
                array (
                    'id' => 33,
                    'name' => 'Applicant',
                    'title' => 'APP',
                    'unit_group_id' => '1',
                    'isactive' => '0',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            33 =>
                array (
                    'id' => 34,
                    'name' => 'Chief',
                    'title' => 'CO',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2021-03-10 16:32:27',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            34 =>
                array (
                    'id' => 35,
                    'name' => 'Software and System',
                    'title' => 'SAS',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2021-03-10 16:32:27',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),

        ));

        $this->enableForeignKeys('units');
    }
}
