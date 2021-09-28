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
                'name' => 'Director',
                'title' => 'Director',
                'unit_group_id' => '1',
                'isactive' => '1',
                'created_at' => '2020-07-08 20:16:49',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'Human Resource',
                'title' => 'HR',
                'unit_group_id' => '1',
                'isactive' => '1',
                'created_at' => '2020-07-08 20:16:49',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            2 =>
                array (
                    'id' => 3,
                    'name' => 'TB/HIV',
                    'title' => 'TB/HIV',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            3 =>
                array (
                    'id' => 4,
                    'name' => 'Administration',
                    'title' => 'ADMIN',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            4 =>
                array (
                    'id' => 5,
                    'name' => 'Chief Executive Officer',
                    'title' => 'CEO',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            5 =>
                array (
                    'id' => 6,
                    'name' => 'Chief Operation',
                    'title' => 'CO',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            6 =>
                array (
                    'id' => 7,
                    'name' => 'Clinical And SI',
                    'title' => 'CSI',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            7 =>
                array (
                    'id' => 8,
                    'name' => 'Community Linkage',
                    'title' => 'CL',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            8 =>
                array (
                    'id' => 9,
                    'name' => 'Compliance',
                    'title' => 'COM',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            9 =>
                array (
                    'id' => 10,
                    'name' => 'CryptoCocoal Menengitis ',
                    'title' => 'CM',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            10 =>
                array (
                    'id' => 11,
                    'name' => 'Data And ICT',
                    'title' => 'DICT',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            11 =>
                array (
                    'id' => 12,
                    'name' => 'Data',
                    'title' => 'DATA',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            12 =>
                array (
                    'id' => 13,
                    'name' => 'Deputy Director of Program',
                    'title' => 'DEP. DIR. OF PROG',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            13 =>
                array (
                    'id' => 14,
                    'name' => 'Dist Comm Field',
                    'title' => 'DCF',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            14 =>
                array (
                    'id' => 15,
                    'name' => 'District clinical & si',
                    'title' => 'DCSI',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            15 =>
                array (
                    'id' => 16,
                    'name' => 'District Community',
                    'title' => 'DC',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            16 =>
                array (
                    'id' => 17,
                    'name' => 'District Date',
                    'title' => 'DD',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            17 =>
                array (
                    'id' => 18,
                    'name' => 'District Project',
                    'title' => 'DP',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            18 =>
                array (
                    'id' => 19,
                    'name' => 'Dreams',
                    'title' => 'DREAMS',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            19 =>
                array (
                    'id' => 20,
                    'name' => 'Executive Assistance',
                    'title' => 'EA',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            20 =>
                array (
                    'id' => 21,
                    'name' => 'Faith Based',
                    'title' => 'FB',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            21 =>
                array (
                    'id' => 22,
                    'name' => 'Field Project',
                    'title' => 'FP',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            22 =>
                array (
                    'id' => 23,
                    'name' => 'Finance & Administration',
                    'title' => 'FADMIN',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            23 =>
                array (
                    'id' => 24,
                    'name' => 'Finance',
                    'title' => 'FNC',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            24 =>
                array (
                    'id' => 25,
                    'name' => 'Front Desk',
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
                    'name' => 'General Service',
                    'title' => 'GS',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            26 =>
                array (
                    'id' => 27,
                    'name' => 'GHS Project',
                    'title' => 'GHSP',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            27 =>
                array (
                    'id' => 28,
                    'name' => 'Grants',
                    'title' => 'GRNT',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            28 =>
                array (
                    'id' => 29,
                    'name' => 'HIV',
                    'title' => 'HIV',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            29 =>
                array (
                    'id' => 30,
                    'name' => 'HIV Care & treatment',
                    'title' => 'HIVCT',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            30 =>
                array (
                    'id' => 31,
                    'name' => 'HIV TB Malaria integr',
                    'title' => 'HIVTMI',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            31 =>
                array (
                    'id' => 32,
                    'name' => 'HTS',
                    'title' => 'HTS',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            32 =>
                array (
                    'id' => 33,
                    'name' => 'ICT',
                    'title' => 'ICT',
                    'unit_group_id' => '1',
                    'isactive' => '0',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            33 =>
                array (
                    'id' => 34,
                    'name' => 'Information Technology',
                    'title' => 'IT',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2021-03-10 16:32:27',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            34 =>
                array (
                    'id' => 35,
                    'name' => 'ITF GHS Lab Project',
                    'title' => 'IGLP',
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
