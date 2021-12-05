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
                    'name' => 'Grants',
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


        ));

        $this->enableForeignKeys('designations');
    }
}
