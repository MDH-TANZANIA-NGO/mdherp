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
                'name' => 'Receivable',
                'short_name' => 'ACCREC',
                'created_at' => '2020-07-08 20:16:49',
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'isactive' => 1,
            ),
            1 =>
                array (
                    'id' => 2,
                    'unit_id' => 1,
                    'name' => 'Payable',
                    'short_name' => 'ACCPAY',
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
                'unit_id' => 3,
                'name' => 'Boat skipper',
                'short_name' => 'ABS',
                'created_at' => '2020-07-08 20:16:49',
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'isactive' => 1,
            ),
            5 =>
            array (
                'id' => 6,
                'unit_id' => 3,
                'name' => 'Sub-grant officer',
                'short_name' => 'ASGO',
                'created_at' => '2020-07-08 20:16:49',
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'isactive' => 1,
            ),
            6 =>
            array (
                'id' => 7,
                'unit_id' => 4,
                'name' => 'Skipper',
                'short_name' => 'BSK',
                'created_at' => '2020-07-08 20:16:49',
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'isactive' => 1,
            ),
            7 =>
            array (
                'id' => 8,
                'unit_id' => 5,
                'name' => 'Assistant',
                'short_name' => 'CCA',
                'created_at' => '2020-07-08 20:16:49',
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'isactive' => 1,
            ),
            8 =>
                array (
                    'id' => 9,
                    'unit_id' => 6,
                    'name' => 'Finance and administration',
                    'short_name' => 'DFA',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            9 =>
                array (
                    'id' => 10,
                    'unit_id' => 6,
                    'name' => 'Prevention Service',
                    'short_name' => 'DPS',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            10 =>
                array (
                    'id' => 11,
                    'unit_id' => 7,
                    'name' => 'Assistant',
                    'short_name' => 'EASS',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            11 =>
                array (
                    'id' => 12,
                    'unit_id' => 8,
                    'name' => 'Assistant',
                    'short_name' => 'FASS',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            12 =>
                array (
                    'id' => 13,
                    'unit_id' => 8,
                    'name' => 'Officer',
                    'short_name' => 'FOFF',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            13 =>
                array (
                    'id' => 14,
                    'unit_id' => 8,
                    'name' => 'Officer FCI',
                    'short_name' => 'FOFFF',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            14 =>
                array (
                    'id' => 15,
                    'unit_id' => 9,
                    'name' => 'Assistant Mobile Payment',
                    'short_name' => 'FAMP',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            15 =>
                array (
                    'id' => 16,
                    'unit_id' => 9,
                    'name' => 'Officer System And Quality',
                    'short_name' => 'FOSQ',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            16 =>
                array (
                    'id' => 17,
                    'unit_id' => 10,
                    'name' => 'Inventory Clerk',
                    'short_name' => 'FIC',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            17 =>
                array (
                    'id' => 18,
                    'unit_id' => 10,
                    'name' => 'Supervisor',
                    'short_name' => 'FS',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            18 =>
                array (
                    'id' => 19,
                    'unit_id' => 11,
                    'name' => 'Officer',
                    'short_name' => 'HIF',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            19 =>
                array (
                    'id' => 20,
                    'unit_id' => 12,
                    'name' => 'Assistant',
                    'short_name' => 'HRA',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            20 =>
                array (
                    'id' => 21,
                    'unit_id' => 12,
                    'name' => 'Officer',
                    'short_name' => 'HRO',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            21 =>
                array (
                    'id' => 22,
                    'unit_id' => 12,
                    'name' => 'Officer - L & D',
                    'short_name' => 'HROLD',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            22 =>
                array (
                    'id' => 23,
                    'unit_id' => 13,
                    'name' => 'Manager',
                    'short_name' => 'ICTM',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            23 =>
                array (
                    'id' => 24,
                    'unit_id' => 13,
                    'name' => 'Officer',
                    'short_name' => 'ICTO',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            24 =>
                array (
                    'id' => 25,
                    'unit_id' => 14,
                    'name' => 'Assistant',
                    'short_name' => 'IAS',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            25 =>
                array (
                    'id' => 26,
                    'unit_id' => 15,
                    'name' => 'Assistant',
                    'short_name' => 'LRA',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            26 =>
                array (
                    'id' => 27,
                    'unit_id' => 15,
                    'name' => 'Officer',
                    'short_name' => 'LRO',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            27 =>
                array (
                    'id' => 28,
                    'unit_id' => 16,
                    'name' => 'Assistant',
                    'short_name' => 'OASS',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            28 =>
                array (
                    'id' => 29,
                    'unit_id' => 16,
                    'name' => 'Manager',
                    'short_name' => 'OMG',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            29 =>
                array (
                    'id' => 30,
                    'unit_id' => 17,
                    'name' => 'Assistant',
                    'short_name' => 'OHRAS',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            30 =>
                array (
                    'id' => 31,
                    'unit_id' => 18,
                    'name' => 'Assistant',
                    'short_name' => 'PLA',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            31 =>
                array (
                    'id' => 32,
                    'unit_id' => 18,
                    'name' => 'Officer',
                    'short_name' => 'PLO',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            32 =>
                array (
                    'id' => 33,
                    'unit_id' => 18,
                    'name' => 'Specialist',
                    'short_name' => 'PLS',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            33 =>
                array (
                    'id' => 34,
                    'unit_id' => 19,
                    'name' => 'Assistant',
                    'short_name' => 'PGA',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            34 =>
                array (
                    'id' => 35,
                    'unit_id' => 19,
                    'name' => 'Driver',
                    'short_name' => 'PGD',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            35 =>
                array (
                    'id' => 36,
                    'unit_id' => 20,
                    'name' => 'Assistant',
                    'short_name' => 'PIA',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            36 =>
                array (
                    'id' => 37,
                    'unit_id' => 20,
                    'name' => 'Manager',
                    'short_name' => 'PIM',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            37 =>
                array (
                    'id' => 38,
                    'unit_id' => 20,
                    'name' => 'Officer',
                    'short_name' => 'PIO',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            38 =>
                array (
                    'id' => 39,
                    'unit_id' => 20,
                    'name' => 'Officer - LAB',
                    'short_name' => 'PIOL',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            39 =>
                array (
                    'id' => 40,
                    'unit_id' => 21,
                    'name' => 'Coordinator',
                    'short_name' => 'PCOO',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            40 =>
                array (
                    'id' => 41,
                    'unit_id' => 22,
                    'name' => 'Accountant',
                    'short_name' => 'SACC',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            41 =>
                array (
                    'id' => 42,
                    'unit_id' => 22,
                    'name' => 'Finance Manager',
                    'short_name' => 'SFM',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            42 =>
                array (
                    'id' => 43,
                    'unit_id' => 22,
                    'name' => 'Strategic Information Advisor',
                    'short_name' => 'SSIA',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            43 =>
                array (
                    'id' => 44,
                    'unit_id' => 23,
                    'name' => 'Assistant',
                    'short_name' => 'SAASS',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            44 =>
                array (
                    'id' => 45,
                    'unit_id' => 24,
                    'name' => 'Consultant',
                    'short_name' => 'SMMC',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            45 =>
                array (
                    'id' => 46,
                    'unit_id' => 25,
                    'name' => 'Assistant',
                    'short_name' => 'SIASS',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            46 =>
                array (
                    'id' => 47,
                    'unit_id' => 25,
                    'name' => 'Manager',
                    'short_name' => 'SIMG',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            47 =>
                array (
                    'id' => 48,
                    'unit_id' => 25,
                    'name' => 'Officer',
                    'short_name' => 'SIO',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            48 =>
                array (
                    'id' => 49,
                    'unit_id' => 26,
                    'name' => 'Advisor',
                    'short_name' => 'TCA',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            49 =>
                array (
                    'id' => 50,
                    'unit_id' => 26,
                    'name' => 'Advisor - CBHS',
                    'short_name' => 'TCAC',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            50 =>
                array (
                    'id' => 51,
                    'unit_id' => 26,
                    'name' => 'Officer',
                    'short_name' => 'TCOFF',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            51 =>
                array (
                    'id' => 52,
                    'unit_id' => 26,
                    'name' => 'Officer - KVP',
                    'short_name' => 'TCOFFK',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            52 =>
                array (
                    'id' => 53,
                    'unit_id' => 26,
                    'name' => 'Officer - Surveilance and Survey',
                    'short_name' => 'TCOFFSS',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            53 =>
                array (
                    'id' => 54,
                    'unit_id' => 26,
                    'name' => 'Officer - Youth and Intervention',
                    'short_name' => 'TCOFFYI',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            54 =>
                array (
                    'id' => 55,
                    'unit_id' => 27,
                    'name' => 'Driver',
                    'short_name' => 'TD',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            55 =>
                array (
                    'id' => 56,
                    'unit_id' => 28,
                    'name' => 'Advisor',
                    'short_name' => 'ZSIA',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            56 =>
                array (
                    'id' => 57,
                    'unit_id' => 29,
                    'name' => 'Coastal',
                    'short_name' => 'ZPMC',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            57 =>
                array (
                    'id' => 58,
                    'unit_id' => 29,
                    'name' => 'Lake Zone',
                    'short_name' => 'ZPMLZ',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            58 =>
                array (
                    'id' => 59,
                    'unit_id' => 30,
                    'name' => 'Intern',
                    'short_name' => 'ICAPEMP',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            59 =>
                array (
                    'id' => 60,
                    'unit_id' => 30,
                    'name' => 'Specific Task',
                    'short_name' => 'ICAPEMP',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            60 =>
                array (
                    'id' => 61,
                    'unit_id' => 31,
                    'name' => 'Director',
                    'short_name' => 'CONDIR',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            61 =>
                array (
                    'id' => 62,
                    'unit_id' => 32,
                    'name' => 'Supervisor',
                    'short_name' => 'EMPSUP',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 0,
                ),
            62 =>
                array (
                    'id' => 63,
                    'unit_id' => 33,
                    'name' => '',
                    'short_name' => 'APPBLK',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 0,
                ),
            63 =>
                array (
                    'id' => 64,
                    'unit_id' => 18,
                    'name' => 'Sub Unit Manager',
                    'short_name' => 'PLSUM',
                    'created_at' => '2020-09-28 16:39:33',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            64 =>
                array (
                    'id' => 65,
                    'unit_id' => 22,
                    'name' => 'Human Resource And Administration Manager',
                    'short_name' => 'SNHRAM',
                    'created_at' => '2020-11-05 15:53:00',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            65 =>
                array (
                    'id' => 66,
                    'unit_id' => 34,
                    'name' => 'Operating Officer',
                    'short_name' => 'COO',
                    'created_at' => '2021-03-10 16:32:27',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            66 =>
                array (
                    'id' => 67,
                    'unit_id' => 35,
                    'name' => 'Developer',
                    'short_name' => 'SASD',
                    'created_at' => '2021-03-10 16:32:27',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),
            67 =>
                array (
                    'id' => 68,
                    'unit_id' => 19,
                    'name' => 'Specialist',
                    'short_name' => 'PGSL',
                    'created_at' => '2020-07-08 20:16:49',
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                    'isactive' => 1,
                ),

        ));

        $this->enableForeignKeys('designations');
    }
}
