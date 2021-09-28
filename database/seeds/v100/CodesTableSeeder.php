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
                    'name' => 'taf_extra',
                    'lang' => 'taf_extra',
                    'is_system_defined' => 1,
                ),
            4 =>
                array (
                    'id' => 5,
                    'name' => 'separate',
                    'lang' => 'separate',
                    'is_system_defined' => 1,
                ),
            5 =>
                array (
                    'id' => 6,
                    'name' => 'icap_transport',
                    'lang' => 'icap_transport',
                    'is_system_defined' => 1,
                ),
            6 =>
                array (
                    'id' => 7,
                    'name' => 'icap_accommodation',
                    'lang' => 'icap_accommodation',
                    'is_system_defined' => 1,
                ),
            7 =>
                array (
                    'id' => 8,
                    'name' => 'taf_trip',
                    'lang' => 'Taf Trip',
                    'is_system_defined' => 1,
                ),
            8 =>
                array (
                    'id' => 9,
                    'name' => 'separate_dividend',
                    'lang' => 'separate_dividend',
                    'is_system_defined' => 1,
                ),
            9 =>
                array (
                    'id' => 10,
                    'name' => 'separate_dividend_classification',
                    'lang' => 'separate_dividend_classification',
                    'is_system_defined' => 1,
                ),
            10 =>
                array (
                    'id' => 11,
                    'name' => 'title',
                    'lang' => 'title',
                    'is_system_defined' => 1,
                ),
            11 =>
                array (
                    'id' => 12,
                    'name' => 'expense',
                    'lang' => 'expense',
                    'is_system_defined' => 1,
                ),

                12 =>
                array (
                    'id' => 13,
                    'name' => 'cov_cec_payment_type',
                    'lang' => 'cov_cec_payment_type',
                    'is_system_defined' => 1,
                ),
                13 =>
                array(
                    'id' => 14,
                    'name' => 'leave_type',
                    'lang' => 'leave_type',
                    'is_system_defined' => 1,
                ),
                14 =>
                array(
                    'id' => 15,
                    'name' => 'timesheet',
                    'lang' => 'timesheet',
                    'is_system_defined' => 1,
                ),

        ));
        $this->enableForeignKeys("codes");

    }
}
