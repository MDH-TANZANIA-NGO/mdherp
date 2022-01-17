<?php

use Illuminate\Database\Seeder;
use Database\TruncateTable;
use Database\DisableForeignKeys;

class CodeValuesTableSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        $this->disableForeignKeys("code_values");
        $this->delete('code_values');

        \DB::table('code_values')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'code_id' => 1,
                    'name' => 'Log In',
                    'lang' => NULL,
                    'description' => '',
                    'reference' => 'ULLGI',
                    'sort' => 1,
                    'isactive' => 1,
                ),
            1 =>
                array (
                    'id' => 2,
                    'code_id' => 1,
                    'name' => 'Log Out',
                    'lang' => NULL,
                    'description' => '',
                    'reference' => 'ULLGO',
                    'sort' => 2,
                    'isactive' => 1,
                ),
            2 =>
                array (
                    'id' => 3,
                    'code_id' => 1,
                    'name' => 'Failed Log In',
                    'lang' => NULL,
                    'description' => '',
                    'reference' => 'ULFLI',
                    'sort' => 3,
                    'isactive' => 1,
                ),
            3 =>
                array (
                    'id' => 4,
                    'code_id' => 1,
                    'name' => 'Password Reset',
                    'lang' => NULL,
                    'description' => '',
                    'reference' => 'ULPRS',
                    'sort' => 4,
                    'isactive' => 1,
                ),
            4 =>
                array (
                    'id' => 5,
                    'code_id' => 1,
                    'name' => 'User Lockout',
                    'lang' => NULL,
                    'description' => '',
                    'reference' => 'ULULC',
                    'sort' => 5,
                    'isactive' => 1,
                ),
            5 =>
                array (
                    'id' => 6,
                    'code_id' => 2,
                    'name' => 'Male',
                    'lang' => "MME",
                    'description' => '',
                    'reference' => 'GMALE',
                    'sort' => 2,
                    'isactive' => 1,
                ),
            6 =>
                array (
                    'id' => 7,
                    'code_id' => 2,
                    'name' => 'Female',
                    'lang' => "MKE",
                    'description' => '',
                    'reference' => 'GFIMALE',
                    'sort' => 1,
                    'isactive' => 1,
                ),
            7 =>
                array (
                    'id' => 8,
                    'code_id' => 3,
                    'name' => 'Single',
                    'lang' => NULL,
                    'description' => '',
                    'reference' => 'MSG',
                    'sort' => 1,
                    'isactive' => 1,
                ),
            8 =>
                array (
                    'id' => 9,
                    'code_id' => 3,
                    'name' => 'Married',
                    'lang' => NULL,
                    'description' => '',
                    'reference' => 'MMR',
                    'sort' => 1,
                    'isactive' => 1,
                ),
            9 =>
                array (
                    'id' => 10,
                    'code_id' => 3,
                    'name' => 'Divorced',
                    'lang' => NULL,
                    'description' => '',
                    'reference' => 'MDV',
                    'sort' => 1,
                    'isactive' => 1,
                ),
            10 =>
                array (
                    'id' => 11,
                    'code_id' => 3,
                    'name' => 'Separated',
                    'lang' => NULL,
                    'description' => '',
                    'reference' => 'MSD',
                    'sort' => 1,
                    'isactive' => 1,
                ),
            11 =>
                array (
                    'id' => 12,
                    'code_id' => 3,
                    'name' => 'Widowed',
                    'lang' => NULL,
                    'description' => '',
                    'reference' => 'MWI',
                    'sort' => 1,
                    'isactive' => 1,
                ),
            12 =>
                array (
                    'id' => 13,
                    'code_id' => 5,
                    'name' => 'care and treatment',
                    'lang' => NULL,
                    'description' => 'This should be assigned a region',
                    'reference' => 'PTCT',
                    'sort' => 1,
                    'isactive' => 1,
                ),
            13 =>
                array (
                    'id' => 14,
                    'code_id' => 5,
                    'name' => 'above sites',
                    'lang' => NULL,
                    'description' => 'This should not assigned a region',
                    'reference' => 'PTS',
                    'sort' => 0,
                    'isactive' => 1,
                ),
            14 =>
                array (
                    'id' => 15,
                    'code_id' => 6,
                    'name' => 'permanent Address',
                    'lang' => NULL,
                    'description' => 'This is a permanent Address',
                    'reference' => 'PA',
                    'sort' => 0,
                    'isactive' => 1,
                ),
            15 =>
                array (
                    'id' => 16,
                    'code_id' => 6,
                    'name' => 'current address',
                    'lang' => NULL,
                    'description' => 'This should not assigned a region',
                    'reference' => 'CA',
                    'sort' => 0,
                    'isactive' => 1,
                ),

        ));
        $this->enableForeignKeys("code_values");

    }
}
