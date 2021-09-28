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
                    'name' => 'Supervisor',
                    'lang' => NULL,
                    'description' => 'This user is an employee supervisor',
                    'reference' => 'ASU',
                    'sort' => 1,
                    'isactive' => 1,
                ),
            8 =>
                array (
                    'id' => 9,
                    'code_id' => 3,
                    'name' => 'Super Admin',
                    'lang' => NULL,
                    'description' => 'This user is a system super admin',
                    'reference' => 'ASADM',
                    'sort' => 1,
                    'isactive' => 0,
                ),
            9 =>
                array (
                    'id' => 10,
                    'code_id' => 4,
                    'name' => 'Taxi',
                    'lang' => NULL,
                    'description' => 'Taxi',
                    'reference' => 'TET',
                    'sort' => 1,
                    'isactive' => 1,
                ),
            10 =>
                array (
                    'id' => 11,
                    'code_id' => 5,
                    'name' => 'DC',
                    'lang' => NULL,
                    'description' => 'District',
                    'reference' => 'RSDS',
                    'sort' => 1,
                    'isactive' => 1,
                ),
            11 =>
                array (
                    'id' => 12,
                    'code_id' => 5,
                    'name' => 'MC',
                    'lang' => NULL,
                    'description' => 'Manicipal council',
                    'reference' => 'RSMC',
                    'sort' => 1,
                    'isactive' => 1,
                ),
            12 =>
                array (
                    'id' => 13,
                    'code_id' => 5,
                    'name' => 'TC',
                    'lang' => NULL,
                    'description' => 'Town council',
                    'reference' => 'RSTC',
                    'sort' => 1,
                    'isactive' => 1,
                ),
            13 =>
                array (
                    'id' => 14,
                    'code_id' => 6,
                    'name' => 'Boat',
                    'lang' => NULL,
                    'description' => 'Boat Transport',
                    'reference' => 'ICTBO',
                    'sort' => 1,
                    'isactive' => 1,
                ),
            14 =>
                array (
                    'id' => 15,
                    'code_id' => 6,
                    'name' => 'Bus',
                    'lang' => NULL,
                    'description' => 'Bust Transport',
                    'reference' => 'ICTBU',
                    'sort' => 1,
                    'isactive' => 1,
                ),
            15 =>
                array (
                    'id' => 16,
                    'code_id' => 6,
                    'name' => 'Flight',
                    'lang' => NULL,
                    'description' => 'Flight Transport',
                    'reference' => 'ICTF',
                    'sort' => 1,
                    'isactive' => 1,
                ),
            16 =>
                array (
                    'id' => 17,
                    'code_id' => 6,
                    'name' => 'ICAP Cars',
                    'lang' => NULL,
                    'description' => 'ICAP Cars Transport',
                    'reference' => 'ICTC',
                    'sort' => 1,
                    'isactive' => 1,
                ),
            17 =>
                array (
                    'id' => 18,
                    'code_id' => 7,
                    'name' => 'Pre Booked Hotel',
                    'lang' => NULL,
                    'description' => 'Pre Booked Hotel',
                    'reference' => 'ICAPBH',
                    'sort' => 1,
                    'isactive' => 1,
                ),
            18 =>
                array (
                    'id' => 19,
                    'code_id' => 7,
                    'name' => 'No Contracted Hotel',
                    'lang' => NULL,
                    'description' => 'No Contracted Hotel',
                    'reference' => 'ICAPNCH',
                    'sort' => 1,
                    'isactive' => 1,
                ),
            19 =>
                array (
                    'id' => 20,
                    'code_id' => 7,
                    'name' => 'No Need For Hotel',
                    'lang' => NULL,
                    'description' => 'No Need For Hotel',
                    'reference' => 'ICAPNFH',
                    'sort' => 1,
                    'isactive' => 1,
                ),
            20 =>
                array (
                    'id' => 21,
                    'code_id' => 8,
                    'name' => 'Departure',
                    'lang' => NULL,
                    'description' => 'Departure date',
                    'reference' => 'ICAPTTRD',
                    'sort' => 1,
                    'isactive' => 1,
                ),
            21 =>
                array (
                    'id' => 22,
                    'code_id' => 8,
                    'name' => 'Return',
                    'lang' => NULL,
                    'description' => 'Return Date',
                    'reference' => 'ICAPTTRR',
                    'sort' => 1,
                    'isactive' => 1,
                ),
            22 =>
                array (
                    'id' => 23,
                    'code_id' => 5,
                    'name' => 'Exception within city',
                    'lang' => NULL,
                    'description' => 'Within the city',
                    'reference' => 'RSTEXCEPT',
                    'sort' => 0,
                    'isactive' => 1,
                ),
            23 =>
                array (
                    'id' => 24,
                    'code_id' => 9,
                    'name' => 'Lunch',
                    'lang' => NULL,
                    'description' => 'Lunch',
                    'reference' => 'SEPDIVL',
                    'sort' => 0,
                    'isactive' => 1,
                ),
            24 =>
                array (
                    'id' => 25,
                    'code_id' => 9,
                    'name' => 'Dinner',
                    'lang' => NULL,
                    'description' => 'Dinner',
                    'reference' => 'SEPDIVD',
                    'sort' => 0,
                    'isactive' => 1,
                ),
            25 =>
                array (
                    'id' => 26,
                    'code_id' => 9,
                    'name' => 'Incidental',
                    'lang' => NULL,
                    'description' => 'Incidental',
                    'reference' => 'SEPDIVI',
                    'sort' => 0,
                    'isactive' => 1,
                ),
            26 =>
                array (
                    'id' => 27,
                    'code_id' => 10,
                    'name' => 'Not',
                    'lang' => NULL,
                    'description' => 'Not Receiptable, Accounted on TBERs',
                    'reference' => 'DIVCRNOT',
                    'sort' => 0,
                    'isactive' => 1,
                ),
            27 =>
                array (
                    'id' => 28,
                    'code_id' => 4,
                    'name' => 'Uber',
                    'lang' => NULL,
                    'description' => 'UBER',
                    'reference' => 'TEUBER',
                    'sort' => 1,
                    'isactive' => 1,
                ),
            28 =>
                array (
                    'id' => 29,
                    'code_id' => 11,
                    'name' => 'Mr',
                    'lang' => NULL,
                    'description' => 'Mr',
                    'reference' => 'TIMR',
                    'sort' => 1,
                    'isactive' => 1,
                ),
            29 =>
                array (
                    'id' => 30,
                    'code_id' => 11,
                    'name' => 'Mrs',
                    'lang' => NULL,
                    'description' => 'Mrs',
                    'reference' => 'TIMRS',
                    'sort' => 1,
                    'isactive' => 1,
                ),
            30 =>
                array (
                    'id' => 31,
                    'code_id' => 11,
                    'name' => 'Ms',
                    'lang' => NULL,
                    'description' => 'Miss',
                    'reference' => 'TIMS',
                    'sort' => 1,
                    'isactive' => 1,
                ),
            31 =>
                array (
                    'id' => 32,
                    'code_id' => 11,
                    'name' => 'Dr',
                    'lang' => NULL,
                    'description' => 'Doctor',
                    'reference' => 'TIDR',
                    'sort' => 1,
                    'isactive' => 1,
                ),
            33 =>
                array (
                    'id' => 34,
                    'code_id' => 11,
                    'name' => 'Prof',
                    'lang' => NULL,
                    'description' => 'Professor',
                    'reference' => 'TIPRO',
                    'sort' => 1,
                    'isactive' => 1,
                ),
            34 =>
                array (
                    'id' => 35,
                    'code_id' => 11,
                    'name' => 'Miss',
                    'lang' => NULL,
                    'description' => 'Miss',
                    'reference' => 'TIMISS',
                    'sort' => 1,
                    'isactive' => 1,
                ),
            35 =>
                array (
                    'id' => 36,
                    'code_id' => 12,
                    'name' => 'Transport',
                    'lang' => NULL,
                    'description' => 'Transport',
                    'reference' => 'EXPTRNS',
                    'sort' => 1,
                    'isactive' => 1,
                ),
            36 =>
                array (
                    'id' => 37,
                    'code_id' => 12,
                    'name' => 'Accommodation',
                    'lang' => NULL,
                    'description' => 'Accommodation',
                    'reference' => 'EXPHT',
                    'sort' => 1,
                    'isactive' => 1,
                ),
            37 =>
                array (
                    'id' => 38,
                    'code_id' => 12,
                    'name' => 'Stationary',
                    'lang' => NULL,
                    'description' => 'Stationary',
                    'reference' => 'EXPFR',
                    'sort' => 1,
                    'isactive' => 1,
                ),
            38 =>
                array (
                    'id' => 39,
                    'code_id' => 12,
                    'name' => 'Bank Deposit Receipt',
                    'lang' => NULL,
                    'description' => 'Bank Deposit Receipt',
                    'reference' => 'EXPBDR',
                    'sort' => 1,
                    'isactive' => 1,
                ),
            39 =>
                array (
                    'id' => 40,
                    'code_id' => 12,
                    'name' => 'Car-wash receipt(s)',
                    'lang' => NULL,
                    'description' => 'Car-wash receipt(s)',
                    'reference' => 'EXPCWR',
                    'sort' => 1,
                    'isactive' => 1,
                ),
            40 =>
                array (
                    'id' => 41,
                    'code_id' => 12,
                    'name' => 'Care giver and child support',
                    'lang' => NULL,
                    'description' => 'Care giver and child support',
                    'reference' => 'EXPCGCS',
                    'sort' => 1,
                    'isactive' => 1,
                ),

            41 =>
                array (
                    'id' => 42,
                    'code_id' => 3,
                    'name' => 'Office',
                    'lang' => 'office',
                    'description' => 'This user is an office',
                    'reference' => 'AOFF',
                    'sort' => 0,
                    'isactive' => 1,
                ),
            43 =>
                array (
                    'id' => 43,
                    'code_id' => 13,
                    'name' => 'COV',
                    'lang' => 'Community Outreach Volunteer',
                    'description' => 'This is COV',
                    'reference' => 'CCPTCO',
                    'sort' => 0,
                    'isactive' => 1,
                ),
            44 =>
                array (
                    'id' => 44,
                    'code_id' => 13,
                    'name' => 'CEC',
                    'lang' => 'CEC',
                    'description' => 'This is CEC',
                    'reference' => 'CCPTCE',
                    'sort' => 0,
                    'isactive' => 1,
                ),

            42 =>
                array(
                    'id' => 43,
                    'code_id' => 13,
                    'name' => 'Certified Sick Leave',
                    'lang' => 'leave',
                    'description' => 'This is sick leave which has documentation',
                    'reference' => 'CSLL',
                    'sort' => 10,
                    'isactive' => 1,

                ),

            43 =>
                array(
                    'id' => 44,
                    'code_id' => 13,
                    'name' => 'Maternity Leave',
                    'lang' => 'leave',
                    'description' => 'This is maternity leave',
                    'reference' => 'MTLL',
                    'sort' => 84,
                    'isactive' => 1,

                ),

            44 =>
                array(
                    'id' => 45,
                    'code_id' => 13,
                    'name' => 'Paternity Leave',
                    'lang' => 'leave',
                    'description' => 'This is paternity leave',
                    'reference' => 'PTLL',
                    'sort' => 4,
                    'isactive' => 1,
                ),

            45 =>
                array(
                    'id' => 46,
                    'code_id' => 13,
                    'name' => 'Bereavement',
                    'lang' => 'leave',
                    'description' => 'This is leave for bereaving',
                    'reference' => 'BVLL',
                    'sort' => 4,
                    'isactive' => 1,
                ),

            46 =>
                array(
                    'id' => 47,
                    'code_id' => 13,
                    'name' => 'Vacation',
                    'lang' => 'leave',
                    'description' => 'This is annual leave',
                    'reference' => 'VALL',
                    'sort' => 22,
                    'isactive' => 1,
                ),

            47 =>
                array(
                    'id' => 48,
                    'code_id' => 14,
                    'name' => 'Office Attendances',
                    'lang' => 'OfficeA',
                    'description' => 'These are attendances in the office',
                    'reference' => 'TOA',
                    'sort' => 4,
                    'isactive' => 1,
                ),

            48 =>
                array(
                    'id' => 49,
                    'code_id' => 14,
                    'name' => 'Field Attendances',
                    'lang' => 'FieldA',
                    'description' => 'These are attendances on the field',
                    'reference' => 'TFA',
                    'sort' => 4,
                    'isactive' => 1,
                ),

            49 =>
                array(
                    'id' => 50,
                    'code_id' => 14,
                    'name' => 'Leave Taken',
                    'lang' => 'leaveT',
                    'description' => 'These are leaves taken',
                    'reference' => 'TLT',
                    'sort' => 22,
                    'isactive' => 1,
                ),

        ));
        $this->enableForeignKeys("code_values");

    }
}
