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

        $this->disableForeignKeys('designations');
        $this->delete('designations');

        \DB::table('designations')->insert(array (
            0 =>
            array (
                'id' => 1,
                'unit_id' => 1,
                'name' => 'Program',
                'short_name' => 'DOP',
                'created_at' => '2020-07-08 20:16:49',
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'isactive' => 1,
            ),
            1 =>
                array (
                    'id' => 2,
                    'unit_id' => 1,
                    'name' => 'Strategic Information',
                    'short_name' => 'DSI',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            2 =>
            array (
                'id' => 3,
                'unit_id' => 2,
                'name' => 'Assistant',
                'short_name' => 'AASS',
                'created_at' => '2020-07-08 20:16:49',
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'isactive' => 1,
            ),
            3 =>
            array (
                'id' => 4,
                'unit_id' => 2,
                'name' => 'Officer',
                'short_name' => 'AOff',
                'created_at' => '2020-07-08 20:16:49',
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'isactive' => 1,
            ),
            4 =>
                array (
                    'id' => 5,
                    'unit_id' => 2,
                    'name' => 'Manager',
                    'short_name' => 'HRM',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            5 =>
                array (
                    'id' => 6,
                    'unit_id' => 1,
                    'name' => 'Grants and Compliance',
                    'short_name' => 'DG',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            6 =>
                array (
                    'id' => 7,
                    'unit_id' => 1,
                    'name' => 'Finance',
                    'short_name' => 'DF',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            7 =>
                array (
                    'id' => 8,
                    'unit_id' => 1,
                    'name' => 'Human Resource',
                    'short_name' => 'DHR',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            8 =>
                array (
                    'id' => 9,
                    'unit_id' => 3,
                    'name' => 'Officer',
                    'short_name' => 'TBHIVO',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            9 =>
                array (
                    'id' => 10,
                    'unit_id' => 3,
                    'name' => 'Manager',
                    'short_name' => 'TBHIVM',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            10 =>
                array (
                    'id' => 11,
                    'unit_id' => 4,
                    'name' => 'Officer',
                    'short_name' => 'AO',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            11 =>
                array (
                    'id' => 12,
                    'unit_id' => 4,
                    'name' => 'Manager',
                    'short_name' => 'AM',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            12 =>
                array (
                    'id' => 13,
                    'unit_id' => 5,
                    'name' => 'Officer',
                    'short_name' => 'CEO',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            13 =>
                array (
                    'id' => 14,
                    'unit_id' => 6,
                    'name' => 'Officer',
                    'short_name' => 'COO',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            14 =>
                array (
                    'id' => 15,
                    'unit_id' => 7,
                    'name' => 'Officer',
                    'short_name' => 'RCSIO',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            15 =>
                array (
                    'id' => 16,
                    'unit_id' => 7,
                    'name' => 'Manager',
                    'short_name' => 'RCSIM',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            16 =>
                array (
                    'id' => 17,
                    'unit_id' => 8,
                    'name' => 'Assistance',
                    'short_name' => 'CLA',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            17 =>
                array (
                    'id' => 18,
                    'unit_id' => 8,
                    'name' => 'Officer',
                    'short_name' => 'CLO',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            18 =>
                array (
                    'id' => 19,
                    'unit_id' => 8,
                    'name' => 'Manager',
                    'short_name' => 'CLM',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            19 =>
                array (
                    'id' => 20,
                    'unit_id' => 9,
                    'name' => 'Manager',
                    'short_name' => 'CM',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            20 =>
                array (
                    'id' => 21,
                    'unit_id' => 9,
                    'name' => 'Officer',
                    'short_name' => 'CO',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            21 =>
                array (
                    'id' => 22,
                    'unit_id' => 10,
                    'name' => 'Officer',
                    'short_name' => 'CMO',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            22 =>
                array (
                    'id' => 23,
                    'unit_id' => 10,
                    'name' => 'Manager',
                    'short_name' => 'CMM',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            23 =>
                array (
                    'id' => 24,
                    'unit_id' => 11,
                    'name' => 'Officer',
                    'short_name' => 'DICTO',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            24 =>
                array (
                    'id' => 25,
                    'unit_id' => 11,
                    'name' => 'Manager',
                    'short_name' => 'DICTM',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            25 =>
                array (
                    'id' => 26,
                    'unit_id' => 12,
                    'name' => 'Manager',
                    'short_name' => 'DM',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            26 =>
                array (
                    'id' => 27,
                    'unit_id' => 12,
                    'name' => 'Officer',
                    'short_name' => 'DO',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            27 =>
                array (
                    'id' => 28,
                    'unit_id' => 13,
                    'name' => 'Program',
                    'short_name' => 'DDP',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            28 =>
                array (
                    'id' => 29,
                    'unit_id' => 13,
                    'name' => 'Strategic Information',
                    'short_name' => 'DDSI',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            29 =>
                array (
                    'id' => 30,
                    'unit_id' => 13,
                    'name' => 'Finance',
                    'short_name' => 'DDF',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            30 =>
                array (
                    'id' => 31,
                    'unit_id' => 13,
                    'name' => 'Grants',
                    'short_name' => 'DDG',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            31 =>
                array (
                    'id' => 32,
                    'unit_id' => 14,
                    'name' => 'Officer',
                    'short_name' => 'DCFO',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            32 =>
                array (
                    'id' => 33,
                    'unit_id' => 14,
                    'name' => 'Assistance',
                    'short_name' => 'DCFA',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            33 =>
                array (
                    'id' => 34,
                    'unit_id' => 14,
                    'name' => 'Manager',
                    'short_name' => 'DCFM',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            34 =>
                array (
                    'id' => 35,
                    'unit_id' => 15,
                    'name' => 'Manager',
                    'short_name' => 'DCSIM',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            35 =>
                array (
                    'id' => 36,
                    'unit_id' => 15,
                    'name' => 'Officer',
                    'short_name' => 'DCSIO',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            36 =>
                array (
                    'id' => 37,
                    'unit_id' => 16,
                    'name' => 'Manager',
                    'short_name' => 'DCSM',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            37 =>
                array (
                    'id' => 38,
                    'unit_id' => 16,
                    'name' => 'Officer',
                    'short_name' => 'DCSO',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            38 =>
                array (
                    'id' => 39,
                    'unit_id' => 17,
                    'name' => 'Officer',
                    'short_name' => 'DDO',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            39 =>
                array (
                    'id' => 40,
                    'unit_id' => 18,
                    'name' => 'Manager',
                    'short_name' => 'DPM',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            40 =>
                array (
                    'id' => 41,
                    'unit_id' => 19,
                    'name' => 'Officer',
                    'short_name' => 'DRO',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            41 =>
                array (
                    'id' => 42,
                    'unit_id' => 19,
                    'name' => 'Manager',
                    'short_name' => 'DRM',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            42 =>
                array (
                    'id' => 43,
                    'unit_id' => 20,
                    'name' => 'Officer',
                    'short_name' => 'PAO',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            43 =>
                array (
                    'id' => 44,
                    'unit_id' => 20,
                    'name' => 'Manager',
                    'short_name' => 'PRAM',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            44 =>
                array (
                    'id' => 45,
                    'unit_id' => 21,
                    'name' => 'Officer',
                    'short_name' => 'PAoM',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            45 =>
                array (
                    'id' => 46,
                    'unit_id' => 22,
                    'name' => 'Officer',
                    'short_name' => 'PoAM',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),

            46 =>
                array (
                    'id' => 47,
                    'unit_id' => 23,
                    'name' => 'Manager',
                    'short_name' => 'FAM',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            47 =>
                array (
                    'id' => 48,
                    'unit_id' => 23,
                    'name' => 'Officer',
                    'short_name' => 'FAO',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            48 =>
                array (
                    'id' => 49,
                    'unit_id' => 24,
                    'name' => 'Officer',
                    'short_name' => 'FO',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            49 =>
                array (
                    'id' => 50,
                    'unit_id' => 24,
                    'name' => 'Manager',
                    'short_name' => 'FM',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            50 =>
                array (
                    'id' => 51,
                    'unit_id' => 25,
                    'name' => 'Officer',
                    'short_name' => 'FDO',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            51 =>
                array (
                    'id' => 52,
                    'unit_id' => 26,
                    'name' => 'Officer',
                    'short_name' => 'SkTO',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            52 =>
                array (
                    'id' => 53,
                    'unit_id' => 26,
                    'name' => 'Manager',
                    'short_name' => 'STiM',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            53 =>
                array (
                    'id' => 54,
                    'unit_id' => 27,
                    'name' => 'Officer',
                    'short_name' => 'GHO',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            54 =>
                array (
                    'id' => 55,
                    'unit_id' => 27,
                    'name' => 'Manager',
                    'short_name' => 'GHM',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            55 =>
                array (
                    'id' => 56,
                    'unit_id' => 28,
                    'name' => 'Manager',
                    'short_name' => 'GM',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            56 =>
                array (
                    'id' => 57,
                    'unit_id' => 28,
                    'name' => 'Officer',
                    'short_name' => 'GO',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            57 =>
                array (
                    'id' => 58,
                    'unit_id' => 29,
                    'name' => 'Officer',
                    'short_name' => 'STBHO',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            58 =>
                array (
                    'id' => 59,
                    'unit_id' => 29,
                    'name' => 'Manager',
                    'short_name' => 'STBHM',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            59 =>
                array (
                    'id' => 60,
                    'unit_id' => 30,
                    'name' => 'Manager',
                    'short_name' => 'HCTM',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            60 =>
                array (
                    'id' => 61,
                    'unit_id' => 30,
                    'name' => 'Officer',
                    'short_name' => 'HCTO',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            61 =>
                array (
                    'id' => 62,
                    'unit_id' => 31,
                    'name' => 'Officer',
                    'short_name' => 'HTMO',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            62 =>
                array (
                    'id' => 63,
                    'unit_id' => 31,
                    'name' => 'Manager',
                    'short_name' => 'HTMM',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            63 =>
                array (
                    'id' => 64,
                    'unit_id' => 32,
                    'name' => 'Manager',
                    'short_name' => 'HTSM',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            64 =>
                array (
                    'id' => 65,
                    'unit_id' => 32,
                    'name' => 'Officer',
                    'short_name' => 'HTSO',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            65 =>
                array (
                    'id' => 66,
                    'unit_id' => 33,
                    'name' => 'Developer',
                    'short_name' => 'ICSD',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            66 =>
                array (
                    'id' => 67,
                    'unit_id' => 34,
                    'name' => 'Manager',
                    'short_name' => 'ITM',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            67 =>
                array (
                    'id' => 68,
                    'unit_id' => 34,
                    'name' => 'Officer',
                    'short_name' => 'ITO',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            68 =>
                array (
                    'id' => 69,
                    'unit_id' => 35,
                    'name' => 'Officer',
                    'short_name' => 'IGLPO',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            69 =>
                array (
                    'id' => 70,
                    'unit_id' => 35,
                    'name' => 'Manager',
                    'short_name' => 'IGLPM',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            70 =>
                array (
                    'id' => 71,
                    'unit_id' => 36,
                    'name' => 'Manager',
                    'short_name' => 'GCM',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            71 =>
                array (
                    'id' => 72,
                    'unit_id' => 36,
                    'name' => 'Officer',
                    'short_name' => 'GCM',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            72 =>
                array (
                    'id' => 73,
                    'unit_id' => 37,
                    'name' => 'Officer',
                    'short_name' => 'SIO',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            73 =>
                array (
                    'id' => 74,
                    'unit_id' => 37,
                    'name' => 'Manager',
                    'short_name' => 'SIM',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            74 =>
                array (
                    'id' => 75,
                    'unit_id' => 38,
                    'name' => 'Advisor',
                    'short_name' => 'STA',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            75 =>
                array (
                    'id' => 76,
                    'unit_id' => 38,
                    'name' => 'Officer',
                    'short_name' => 'STO',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            76 =>
                array (
                    'id' => 77,
                    'unit_id' => 38,
                    'name' => 'Manager',
                    'short_name' => 'STM',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            77 =>
                array (
                    'id' => 78,
                    'unit_id' => 39,
                    'name' => 'Officer',
                    'short_name' => 'SPAO',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            78 =>
                array (
                    'id' => 79,
                    'unit_id' => 39,
                    'name' => 'Manager',
                    'short_name' => 'SPAM',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            79 =>
                array (
                    'id' => 80,
                    'unit_id' => 40,
                    'name' => 'Manager',
                    'short_name' => 'SRCSM',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            80 =>
                array (
                    'id' => 81,
                    'unit_id' => 40,
                    'name' => 'Officer',
                    'short_name' => 'SRCSO',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            81 =>
                array (
                    'id' => 82,
                    'unit_id' => 41,
                    'name' => 'Manager',
                    'short_name' => 'RPM',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            82 =>
                array (
                    'id' => 83,
                    'unit_id' => 42,
                    'name' => 'Manager',
                    'short_name' => 'SQIM',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            83 =>
                array (
                    'id' => 84,
                    'unit_id' => 42,
                    'name' => 'Officer',
                    'short_name' => 'SQIO',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            84 =>
                array (
                    'id' => 85,
                    'unit_id' => 43,
                    'name' => 'Officer',
                    'short_name' => 'SPO',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            85 =>
                array (
                    'id' => 86,
                    'unit_id' => 43,
                    'name' => 'Manager',
                    'short_name' => 'SPM',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            86 =>
                array (
                    'id' => 87,
                    'unit_id' => 44,
                    'name' => 'Manager',
                    'short_name' => 'QIO',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            87 =>
                array (
                    'id' => 88,
                    'unit_id' => 44,
                    'name' => 'Officer',
                    'short_name' => 'QIM',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            88 =>
                array (
                    'id' => 89,
                    'unit_id' => 45,
                    'name' => 'Officer',
                    'short_name' => 'RCLO',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            89 =>
                array (
                    'id' => 90,
                    'unit_id' => 45,
                    'name' => 'Manager',
                    'short_name' => 'RCLM',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            90 =>
                array (
                    'id' => 91,
                    'unit_id' => 46,
                    'name' => 'Officer',
                    'short_name' => 'SCO',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            91 =>
                array (
                    'id' => 92,
                    'unit_id' => 46,
                    'name' => 'Manager',
                    'short_name' => 'SCM',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            92 =>
                array (
                    'id' => 93,
                    'unit_id' => 47,
                    'name' => 'Manager',
                    'short_name' => 'SFM',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            93 =>
                array (
                    'id' => 94,
                    'unit_id' => 48,
                    'name' => 'Officer',
                    'short_name' => 'PO',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            94 =>
                array (
                    'id' => 95,
                    'unit_id' => 48,
                    'name' => 'Manager',
                    'short_name' => 'PM',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            95 =>
                array (
                    'id' => 96,
                    'unit_id' => 49,
                    'name' => 'Accountant',
                    'short_name' => 'PTA',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            96 =>
                array (
                    'id' => 97,
                    'unit_id' => 50,
                    'name' => 'Manager',
                    'short_name' => 'SHTSM',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            97 =>
                array (
                    'id' => 98,
                    'unit_id' => 50,
                    'name' => 'Officer',
                    'short_name' => 'SHTSO',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            98 =>
                array (
                    'id' => 99,
                    'unit_id' => 51,
                    'name' => 'Officer',
                    'short_name' => 'LSO',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            99 =>
                array (
                    'id' => 100,
                    'unit_id' => 52,
                    'name' => 'Officer',
                    'short_name' => 'SFTO',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            100 =>
                array (
                    'id' => 101,
                    'unit_id' => 53,
                    'name' => 'Advisor',
                    'short_name' => 'SLA',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            101 =>
                array (
                    'id' => 102,
                    'unit_id' => 54,
                    'name' => 'Officer',
                    'short_name' => 'SGO',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            102 =>
                array (
                    'id' => 103,
                    'unit_id' => 55,
                    'name' => 'Manager',
                    'short_name' => 'VMMCSM',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            103 =>
                array (
                    'id' => 104,
                    'unit_id' => 56,
                    'name' => 'Manager',
                    'short_name' => 'RCSLM',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            104 =>
                array (
                    'id' => 105,
                    'unit_id' => 57,
                    'name' => 'Officer',
                    'short_name' => 'SSCO',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            105 =>
                array (
                    'id' => 106,
                    'unit_id' => 58,
                    'name' => 'Manager',
                    'short_name' => 'PMj',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            106 =>
                array (
                    'id' => 107,
                    'unit_id' => 58,
                    'name' => 'Accountant',
                    'short_name' => 'PA',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            107 =>
                array (
                    'id' => 108,
                    'unit_id' => 59,
                    'name' => 'Officer',
                    'short_name' => 'MCHO1',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            108 =>
                array (
                    'id' => 109,
                    'unit_id' => 60,
                    'name' => 'Officer',
                    'short_name' => 'MCHO',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            109 =>
                array (
                    'id' => 110,
                    'unit_id' => 61,
                    'name' => 'Officer',
                    'short_name' => 'SM&EO',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            110 =>
                array (
                    'id' => 111,
                    'unit_id' => 61,
                    'name' => 'Manager',
                    'short_name' => 'SM&EM',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            111 =>
                array (
                    'id' => 112,
                    'unit_id' => 62,
                    'name' => 'Manager',
                    'short_name' => 'M&EM',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),

            112 =>
                array (
                    'id' => 113,
                    'unit_id' => 62,
                    'name' => 'Officer',
                    'short_name' => 'M&EO',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            113 =>
                array (
                    'id' => 114,
                    'unit_id' => 63,
                    'name' => 'Officer',
                    'short_name' => 'SFAO',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            114 =>
                array (
                    'id' => 115,
                    'unit_id' => 64,
                    'name' => '',
                    'short_name' => 'ST',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            115 =>
                array (
                    'id' => 116,
                    'unit_id' => 65,
                    'name' => 'Officer',
                    'short_name' => 'RMCHO',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            116 =>
                array (
                    'id' => 117,
                    'unit_id' => 66,
                    'name' => 'Manager',
                    'short_name' => 'MM',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            117 =>
                array (
                    'id' => 118,
                    'unit_id' => 66,
                    'name' => 'Officer',
                    'short_name' => 'MO',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            118 =>
                array (
                    'id' => 119,
                    'unit_id' => 67,
                    'name' => 'Officer',
                    'short_name' => 'LSCO',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            119 =>
                array (
                    'id' => 120,
                    'unit_id' => 68,
                    'name' => 'Manager',
                    'short_name' => 'MPM',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),


        ));

        $this->enableForeignKeys('designations');
    }
}
