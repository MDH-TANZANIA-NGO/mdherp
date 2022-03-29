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
                'name' => 'Director of',
                'title' => 'Director of',
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
                    'name' => 'Chief Operating',
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
                    'name' => 'Regional Clinical And SI',
                    'title' => 'RCSI',
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
                    'name' => 'Deputy Director of',
                    'title' => 'DEP. DIR. OF',
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
                    'name' => 'District Community Service',
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
                    'name' => 'District Data',
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
                    'name' => 'Project Administration',
                    'title' => 'PA',
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
                    'name' => 'Senior Training',
                    'title' => 'STR',
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
                    'name' => 'Senior TB/HIV',
                    'title' => 'STBHIV',
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
                    'name' => 'ICT CUM',
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
            35 =>
                array (
                    'id' => 36,
                    'name' => 'Grants and Compliance',
                    'title' => 'GAC',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2021-03-10 16:32:27',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            36 =>
                array (
                    'id' => 37,
                    'name' => 'Senior IT',
                    'title' => 'SIT',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2021-03-10 16:32:27',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            37 =>
                array (
                    'id' => 38,
                    'name' => 'Senior Technical',
                    'title' => 'STE',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2021-03-10 16:32:27',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            38 =>
                array (
                    'id' => 39,
                    'name' => 'Senior Program Administration',
                    'title' => 'SPA',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2021-03-10 16:32:27',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            39 =>
                array (
                    'id' => 40,
                    'name' => 'Senior Retention Community Linkage',
                    'title' => 'SRCL',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2021-03-10 16:32:27',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            40 =>
                array (
                    'id' => 41,
                    'name' => 'Regional Project',
                    'title' => 'RP',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2021-03-10 16:32:27',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            41 =>
                array (
                    'id' => 42,
                    'name' => 'Senior QI & PHE',
                    'title' => 'SQP',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2021-03-10 16:32:27',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            42 =>
                array (
                    'id' => 43,
                    'name' => 'Senior Prevention',
                    'title' => 'SP.',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2021-03-10 16:32:27',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            43 =>
                array (
                    'id' => 44,
                    'name' => 'Quality Improvement',
                    'title' => 'QI.',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2021-03-10 16:32:27',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            44 =>
                array (
                    'id' => 45,
                    'name' => 'Retention & Community Linkage',
                    'title' => 'RCL',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2021-03-10 16:32:27',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            45 =>
                array (
                    'id' => 46,
                    'name' => 'Supply Chain',
                    'title' => 'SC.',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2021-03-10 16:32:27',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            46 =>
                array (
                    'id' => 47,
                    'name' => 'Senior Finance',
                    'title' => 'SF.',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2021-03-10 16:32:27',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            47 =>
                array (
                    'id' => 48,
                    'name' => 'Procurement  ',
                    'title' => 'PO.',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2021-03-10 16:32:27',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            48 =>
                array (
                    'id' => 49,
                    'name' => 'Payroll & Tax ',
                    'title' => 'PT.',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2021-03-10 16:32:27',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            49 =>
                array (
                    'id' => 50,
                    'name' => 'Senior HTS',
                    'title' => 'SH.',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2021-03-10 16:32:27',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            50 =>
                array (
                    'id' => 51,
                    'name' => 'Laboratory Service',
                    'title' => 'LS.',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2021-03-10 16:32:27',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            51 =>
                array (
                    'id' => 52,
                    'name' => 'Senior Facility & Transport',
                    'title' => 'SFT.',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2021-03-10 16:32:27',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            52 =>
                array (
                    'id' => 53,
                    'name' => 'Senior Lab',
                    'title' => 'SL.',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2021-03-10 16:32:27',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            53 =>
                array (
                    'id' => 54,
                    'name' => 'Senior Grants',
                    'title' => 'SG.',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2021-03-10 16:32:27',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            54 =>
                array (
                    'id' => 55,
                    'name' => 'VMMC Senior',
                    'title' => 'VS.',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2021-03-10 16:32:27',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            55 =>
                array (
                    'id' => 56,
                    'name' => 'Regional Retention & Community',
                    'title' => 'RRC.',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2021-03-10 16:32:27',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            56 =>
                array (
                    'id' => 57,
                    'name' => 'Store and Supply Chain',
                    'title' => 'SSC.',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2021-03-10 16:32:27',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            57 =>
                array (
                    'id' => 58,
                    'name' => 'Project',
                    'title' => 'P.',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2021-03-10 16:32:27',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            58 =>
                array (
                    'id' => 59,
                    'name' => 'M. & CH Senior',
                    'title' => 'MCHS.',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2021-03-10 16:32:27',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            59 =>
                array (
                    'id' => 60,
                    'name' => 'Maternal & Child Health',
                    'title' => 'MCH.',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2021-03-10 16:32:27',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            60 =>
                array (
                    'id' => 61,
                    'name' => 'Senior Monitoring and Evaluation',
                    'title' => 'SME.',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2021-03-10 16:32:27',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            61 =>
                array (
                    'id' => 62,
                    'name' => 'Monitoring and Evaluation',
                    'title' => 'ME.',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2021-03-10 16:32:27',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            62 =>
                array (
                    'id' => 63,
                    'name' => 'Senior Finance and Administration',
                    'title' => 'SFA.',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2021-03-10 16:32:27',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            63 =>
                array (
                    'id' => 64,
                    'name' => 'Statistician',
                    'title' => 'S.',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2021-03-10 16:32:27',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            64 =>
                array (
                    'id' => 65,
                    'name' => 'Regional Maternal & Child Health',
                    'title' => 'RMCH.',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2021-03-10 16:32:27',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            65 =>
                array (
                    'id' => 66,
                    'name' => 'MAT',
                    'title' => 'MAT.',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2021-03-10 16:32:27',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            66 =>
                array (
                    'id' => 67,
                    'name' => 'Lab & Supply Chain',
                    'title' => 'LSC.',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2021-03-10 16:32:27',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            67 =>
                array (
                    'id' => 68,
                    'name' => 'Menengitis Prevention',
                    'title' => 'MP.',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2021-03-10 16:32:27',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            68 =>
                array (
                    'id' => 69,
                    'name' => 'Requester',
                    'title' => 'APP.',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2021-03-10 16:32:27',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            69 =>
                array (
                    'id' => 70,
                    'name' => 'Program Area Manager',
                    'title' => 'Program Area Manager',
                    'unit_group_id' => '1',
                    'isactive' => '1',
                    'created_at' => '2021-03-10 16:32:27',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            70 =>
                array (
                    'id' => 71,
                    'name' => 'Director',
                    'title' => 'Director.',
                    'unit_group_id' => '1',
                    'isactive' => '0',
                    'created_at' => '2021-03-10 16:32:27',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            71 =>
                array (
                    'id' => 72,
                    'name' => 'Approver',
                    'title' => 'Approver.',
                    'unit_group_id' => '1',
                    'isactive' => '0',
                    'created_at' => '2022-01-10 16:32:27',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            72 =>
                array (
                    'id' => 73,
                    'name' => 'Endorse',
                    'title' => 'Endorse.',
                    'unit_group_id' => '1',
                    'isactive' => '0',
                    'created_at' => '2022-01-10 16:32:27',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            73 =>
                array (
                    'id' => 74,
                    'name' => 'Supervisor',
                    'title' => 'Supervisor.',
                    'unit_group_id' => '1',
                    'isactive' => '0',
                    'created_at' => '2022-01-10 16:32:27',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            74 =>
                array (
                    'id' => 75,
                    'name' => 'General Service Drivers',
                    'title' => 'General Service Drivers.',
                    'unit_group_id' => '1',
                    'isactive' => '0',
                    'created_at' => '2022-01-10 16:32:27',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),



        ));

        $this->enableForeignKeys('units');
    }
}
