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
                    'name' => 'Permanent Address',
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
                    'name' => 'Current Address',
                    'lang' => NULL,
                    'description' => 'This should not assigned a region',
                    'reference' => 'CA',
                    'sort' => 0,
                    'isactive' => 1,
                ),
            16 =>
                array (
                    'id' => 17,
                    'code_id' => 7,
                    'name' => 'Promotion',
                    'lang' => NULL,
                    'description' => 'An employee being promoted to a new position',
                    'reference' => 'Pro',
                    'sort' => 0,
                    'isactive' => 1,
                ),
            17 =>
                array (
                    'id' => 18,
                    'code_id' => 7,
                    'name' => 'Internal Competition',
                    'lang' => NULL,
                    'description' => 'Not open to the public for external users',
                    'reference' => 'Int',
                    'sort' => 0,
                    'isactive' => 1,
                ),
            18 =>
                array (
                    'id' => 19,
                    'code_id' => 7,
                    'name' => 'Open/External Competition',
                    'lang' => NULL,
                    'description' => 'Available for external users',
                    'reference' => 'Ext',
                    'sort' => 0,
                    'isactive' => 1,
                ),
            19 =>
                array (
                    'id' => 20,
                    'code_id' => 8,
                    'name' => 'Fixed Term Employment',
                    'lang' => NULL,
                    'description' => 'Regular employee given a contract over time',
                    'reference' => 'Fix',
                    'sort' => 0,
                    'isactive' => 1,
                ),
            20 =>
                array (
                    'id' => 21,
                    'code_id' => 8,
                    'name' => 'Consultancy',
                    'lang' => NULL,
                    'description' => 'Contractual agreements to perform a specific task',
                    'reference' => 'Con',
                    'sort' => 0,
                    'isactive' => 1,
                ),
            21 =>
                array (
                    'id' => 22,
                    'code_id' => 9,
                    'name' => 'Addition to existing staff',
                    'lang' => NULL,
                    'description' => 'Addition to existing staff',
                    'reference' => 'Add',
                    'sort' => 0,
                    'isactive' => 1,
                ),
            22 =>
                array (
                    'id' => 23,
                    'code_id' => 9,
                    'name' => 'New Position',
                    'lang' => NULL,
                    'description' => 'A new position, never existed before in an organisation',
                    'reference' => 'New',
                    'sort' => 0,
                    'isactive' => 1,
                ),
            23 =>
                array (
                    'id' => 24,
                    'code_id' => 10,
                    'name' => 'Ordinary Level',
                    'lang' => NULL,
                    'description' => 'Ordinary Level Education',
                    'reference' => 'o-level',
                    'sort' => 0,
                    'isactive' => 1,
                ),
            24 =>
                array (
                    'id' => 25,
                    'code_id' => 10,
                    'name' => 'Advanced Level',
                    'lang' => NULL,
                    'description' => 'Advanced Level Education',
                    'reference' => 'a-level',
                    'sort' => 0,
                    'isactive' => 1,
                ),
            25 =>
                array (
                    'id' => 26,
                    'code_id' => 10,
                    'name' => 'Diploma',
                    'lang' => NULL,
                    'description' => 'Diploma',
                    'reference' => 'diploma',
                    'sort' => 0,
                    'isactive' => 1,
                ),
            26 =>
                array (
                    'id' => 27,
                    'code_id' => 10,
                    'name' => 'Advanced Diploma',
                    'lang' => NULL,
                    'description' => 'Advanced Diploma',
                    'reference' => 'advanced',
                    'sort' => 0,
                    'isactive' => 1,
                ),
            27 =>
                array (
                    'id' => 28,
                    'code_id' => 10,
                    'name' => 'Bachelor Degree',
                    'lang' => NULL,
                    'description' => 'Bachelor Degree',
                    'reference' => 'bachelor',
                    'sort' => 0,
                    'isactive' => 1,
                ),
            28 =>
                array (
                    'id' => 29,
                    'code_id' => 10,
                    'name' => 'Masters Degree',
                    'lang' => NULL,
                    'description' => 'Masters Degree',
                    'reference' => 'masters',
                    'sort' => 0,
                    'isactive' => 1,
                ),
            29 =>
                array (
                    'id' => 30,
                    'code_id' => 10,
                    'name' => 'PhD',
                    'lang' => NULL,
                    'description' => 'PhD',
                    'reference' => 'phd',
                    'sort' => 0,
                    'isactive' => 1,
                ),
            30 =>
                array (
                    'id' => 31,
                    'code_id' => 11,
                    'name' => 'Ready',
                    'lang' => NULL,
                    'description' => 'ready',
                    'reference' => 'ready',
                    'sort' => 0,
                    'isactive' => 1,
                ),
            31 =>
                array (
                    'id' => 32,
                    'code_id' => 11,
                    'name' => 'Not Ready',
                    'lang' => NULL,
                    'description' => 'notready',
                    'reference' => 'notready',
                    'sort' => 0,
                    'isactive' => 1,
                ),
            32 =>
                array (
                    'id' => 33,
                    'code_id' => 12,
                    'name' => 'child',
                    'lang' => NULL,
                    'description' => 'This could be a son or daughter but we have the gender section',
                    'reference' => 'ch',
                    'sort' => 0,
                    'isactive' => 1,
                ),
            33 =>
                array (
                    'id' => 34,
                    'code_id' => 12,
                    'name' => 'spouse',
                    'lang' => NULL,
                    'description' => 'The loved one',
                    'reference' => 'sp',
                    'sort' => 0,
                    'isactive' => 1,
                ),
            34 =>
                array (
                    'id' => 35,
                    'code_id' => 12,
                    'name' => 'other',
                    'lang' => NULL,
                    'description' => 'The loved one',
                    'reference' => 'ot',
                    'sort' => 0,
                    'isactive' => 1,
                ),
            35 =>
                array (
                    'id' => 36,
                    'code_id' => 12,
                    'name' => 'father',
                    'lang' => NULL,
                    'description' => 'The loved one',
                    'reference' => 'fa',
                    'sort' => 0,
                    'isactive' => 1,
                ),
            36 =>
                array (
                    'id' => 37,
                    'code_id' => 12,
                    'name' => 'mother',
                    'lang' => NULL,
                    'description' => 'The loved one',
                    'reference' => 'mo',
                    'sort' => 0,
                    'isactive' => 1,
                ),
            37 =>
                array (
                    'id' => 38,
                    'code_id' => 12,
                    'name' => 'uncle',
                    'lang' => NULL,
                    'description' => 'The loved one',
                    'reference' => 'un',
                    'sort' => 0,
                    'isactive' => 1,
                ),
            38 =>
                array (
                    'id' => 39,
                    'code_id' => 12,
                    'name' => 'sibling',
                    'lang' => NULL,
                    'description' => 'The loved one',
                    'reference' => 'sib',
                    'sort' => 0,
                    'isactive' => 1,
                ),
            39 =>
                array (
                    'id' => 40,
                    'code_id' => 12,
                    'name' => 'aunt',
                    'lang' => NULL,
                    'description' => 'The loved one',
                    'reference' => 'au',
                    'sort' => 0,
                    'isactive' => 1,
                ),
            40 =>
                array (
                    'id' => 41,
                    'code_id' => 12,
                    'name' => 'cousin',
                    'lang' => NULL,
                    'description' => 'The loved one',
                    'reference' => 'cou',
                    'sort' => 0,
                    'isactive' => 1,
                ),
            41 =>
                array (
                    'id' => 42,
                    'code_id' => 13,
                    'name' => 'Supervisor',
                    'lang' => NULL,
                    'description' => 'I have conducted a staff performance evaluation interview.  The interview has focused on the performance of the employee both quantitative and qualitative. Below are comments on the overall performance of the employee and suggestion on how MDH could help the employee.',
                    'reference' => 'smr',
                    'sort' => 0,
                    'isactive' => 1,
                ),
            42 =>
                array (
                    'id' => 43,
                    'code_id' => 13,
                    'name' => 'Employee',
                    'lang' => NULL,
                    'description' => 'I have gone through the assessment made by my Supervisor and I agree/disagree with the assessment for the following reasons:-',
                    'reference' => 'emr',
                    'sort' => 0,
                    'isactive' => 1,
                ),
            43 =>
                array (
                    'id' => 44,
                    'code_id' => 13,
                    'name' => 'RPM',
                    'lang' => NULL,
                    'description' => 'Remarks by RPM',
                    'reference' => 'rmr',
                    'sort' => 0,
                    'isactive' => 1,
                ),
            44 =>
                array (
                    'id' => 45,
                    'code_id' => 13,
                    'name' => 'Director',
                    'lang' => NULL,
                    'description' => 'Remarks by Director',
                    'reference' => 'dmr',
                    'sort' => 0,
                    'isactive' => 1,
                ),
            45 =>
                array (
                    'id' => 46,
                    'code_id' => 13,
                    'name' => 'HR Director',
                    'lang' => NULL,
                    'description' => 'Human Resource Director Remarkd',
                    'reference' => 'hrdmr',
                    'sort' => 0,
                    'isactive' => 1,
                ),
            46 =>
                array (
                    'id' => 47,
                    'code_id' => 13,
                    'name' => 'CEO',
                    'lang' => NULL,
                    'description' => 'CEO REmrks',
                    'reference' => 'cmr',
                    'sort' => 0,
                    'isactive' => 1,
                ),
            47 =>
                array (
                    'id' => 48,
                    'code_id' => 4,
                    'name' => 'New Staff',
                    'lang' => NULL,
                    'description' => 'New Staff',
                    'reference' => 'ns',
                    'sort' => 0,
                    'isactive' => 1,
                ),
            48 =>
                array (
                    'id' => 49,
                    'code_id' => 9,
                    'name' => 'Replacement of the existing Staff',
                    'lang' => NULL,
                    'description' => 'Replacement of the existing Staff',
                    'reference' => 'Replace',
                    'sort' => 0,
                    'isactive' => 1,
                ),



        ));
        $this->enableForeignKeys("code_values");

    }
}
