<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Database\DisableForeignKeys;
use Database\TruncateTable;

class FacilityTypeTableSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys("facility_types");
        $this->delete('facility_types');

        DB::table('facility_types')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'name' => 'Dispensary',
                    'facility_category_id' => 1,
                    'created_at' => '2022-01-08 17:08:30',
                    'updated_at' => '2022-01-08 17:08:30',
                ),
            1 =>
                array (
                    'id' => 2,
                    'name' => 'Health Center',
                    'facility_category_id' => 2,
                    'created_at' => '2022-01-08 17:08:30',
                    'updated_at' => '2022-01-08 17:08:30',
                ),
            2 =>
                array (
                    'id' => 3,
                    'name' => 'Maternity and Nursing Home',
                    'facility_category_id' => 3,
                    'created_at' => '2022-01-08 17:08:30',
                    'updated_at' => '2022-01-08 17:08:30',
                ),
            3 =>
                array (
                    'id' => 4,
                    'name' => 'Maternity Home',
                    'facility_category_id' => 4,
                    'created_at' => '2022-01-08 17:08:30',
                    'updated_at' => '2022-01-08 17:08:30',
                ),
            4 =>
                array (
                    'id' => 5,
                    'name' => 'Physiotherapy Clinic',
                    'facility_category_id' => 5,
                    'created_at' => '2022-01-08 17:08:30',
                    'updated_at' => '2022-01-08 17:08:30',
                ),
            5 =>
                array (
                    'id' => 6,
                    'name' => 'Nursing Home',
                    'facility_category_id' => 6,
                    'created_at' => '2022-01-08 17:08:30',
                    'updated_at' => '2022-01-08 17:08:30',
                ),
            6 =>
                array (
                    'id' => 7,
                    'name' => 'Mobile Medical Clinic',
                    'facility_category_id' => 7,
                    'created_at' => '2022-01-08 17:08:30',
                    'updated_at' => '2022-01-08 17:08:30',
                ),
            7 =>
                array (
                    'id' => 8,
                    'name' => 'Polyclinic',
                    'facility_category_id' => 7,
                    'created_at' => '2022-01-08 17:08:30',
                    'updated_at' => '2022-01-08 17:08:30',
                ),
            8 =>
                array (
                    'id' => 9,
                    'name' => 'Super Specialized Clinic',
                    'facility_category_id' => 7,
                    'created_at' => '2022-01-08 17:08:30',
                    'updated_at' => '2022-01-08 17:08:30',
                ),
            9 =>
                array (
                    'id' => 10,
                    'name' => 'Specialized Clinic',
                    'facility_category_id' => 7,
                    'created_at' => '2022-01-08 17:08:30',
                    'updated_at' => '2022-01-08 17:08:30',
                ),
            10 =>
                array (
                    'id' => 11,
                    'name' => 'Medical Clinic',
                    'facility_category_id' => 7,
                    'created_at' => '2022-01-08 17:08:30',
                    'updated_at' => '2022-01-08 17:08:30',
                ),
            11 =>
                array (
                    'id' => 12,
                    'name' => 'Eye Clinic',
                    'facility_category_id' => 7,
                    'created_at' => '2022-01-08 17:08:30',
                    'updated_at' => '2022-01-08 17:08:30',
                ),
            12 =>
                array (
                    'id' => 13,
                    'name' => 'Basic Dental Clinic',
                    'facility_category_id' => 7,
                    'created_at' => '2022-01-08 17:08:30',
                    'updated_at' => '2022-01-08 17:08:30',
                ),
            13 =>
                array (
                    'id' => 14,
                    'name' => 'Optometry Clinic',
                    'facility_category_id' => 7,
                    'created_at' => '2022-01-08 17:08:30',
                    'updated_at' => '2022-01-08 17:08:30',
                ),
            14 =>
                array (
                    'id' => 15,
                    'name' => 'Dialysis Clinic',
                    'facility_category_id' => 7,
                    'created_at' => '2022-01-08 17:08:30',
                    'updated_at' => '2022-01-08 17:08:30',
                ),
            15 =>
                array (
                    'id' => 16,
                    'name' => 'General Clinic',
                    'facility_category_id' => 7,
                    'created_at' => '2022-01-08 17:08:30',
                    'updated_at' => '2022-01-08 17:08:30',
                ),
            16 =>
                array (
                    'id' => 17,
                    'name' => 'Specialized Polyclinic',
                    'facility_category_id' => 7,
                    'created_at' => '2022-01-08 17:08:30',
                    'updated_at' => '2022-01-08 17:08:30',
                ),
            17 =>
                array (
                    'id' => 18,
                    'name' => 'Super Specialized Polyclinic',
                    'facility_category_id' => 7,
                    'created_at' => '2022-01-08 17:08:30',
                    'updated_at' => '2022-01-08 17:08:30',
                ),
            18 =>
                array (
                    'id' => 19,
                    'name' => 'GP Clinic',
                    'facility_category_id' => 7,
                    'created_at' => '2022-01-08 17:08:30',
                    'updated_at' => '2022-01-08 17:08:30',
                ),
            19 =>
                array (
                    'id' => 20,
                    'name' => 'Comprehensive Dental Clinic',
                    'facility_category_id' => 7,
                    'created_at' => '2022-01-08 17:08:30',
                    'updated_at' => '2022-01-08 17:08:30',
                ),
            20 =>
                array (
                    'id' => 21,
                    'name' => 'Psychiatric Clinic',
                    'facility_category_id' => 7,
                    'created_at' => '2022-01-08 17:08:30',
                    'updated_at' => '2022-01-08 17:08:30',
                ),
            21 =>
                array (
                    'id' => 22,
                    'name' => 'Diagnostic Center',
                    'facility_category_id' => 7,
                    'created_at' => '2022-01-08 17:08:30',
                    'updated_at' => '2022-01-08 17:08:30',
                ),
            22 =>
                array (
                    'id' => 23,
                    'name' => 'Specialized Dental Clinic',
                    'facility_category_id' => 7,
                    'created_at' => '2022-01-08 17:08:30',
                    'updated_at' => '2022-01-08 17:08:30',
                ),
            23 =>
                array (
                    'id' => 24,
                    'name' => 'National Hospital',
                    'facility_category_id' => 8,
                    'created_at' => '2022-01-08 17:08:30',
                    'updated_at' => '2022-01-08 17:08:30',
                ),
            24 =>
                array (
                    'id' => 25,
                    'name' => 'National Super Specialized Hospital',
                    'facility_category_id' => 8,
                    'created_at' => '2022-01-08 17:08:30',
                    'updated_at' => '2022-01-08 17:08:30',
                ),
            25 =>
                array (
                    'id' => 26,
                    'name' => 'Zonal Referral Hospital',
                    'facility_category_id' => 8,
                    'created_at' => '2022-01-08 17:08:30',
                    'updated_at' => '2022-01-08 17:08:30',
                ),
            26 =>
                array (
                    'id' => 27,
                    'name' => 'Regional Referral Hospital',
                    'facility_category_id' => 8,
                    'created_at' => '2022-01-08 17:08:30',
                    'updated_at' => '2022-01-08 17:08:30',
                ),
            27 =>
                array (
                    'id' => 28,
                    'name' => 'District Hospital',
                    'facility_category_id' => 8,
                    'created_at' => '2022-01-08 17:08:30',
                    'updated_at' => '2022-01-08 17:08:30',
                ),
            28 =>
                array (
                    'id' => 29,
                    'name' => 'Hospital at Zonal Level',
                    'facility_category_id' => 8,
                    'created_at' => '2022-01-08 17:08:30',
                    'updated_at' => '2022-01-08 17:08:30',
                ),
            29 =>
                array (
                    'id' => 30,
                    'name' => 'Hospital at Regional Level',
                    'facility_category_id' => 8,
                    'created_at' => '2022-01-08 17:08:30',
                    'updated_at' => '2022-01-08 17:08:30',
                ),
            30 =>
                array (
                    'id' => 31,
                    'name' => 'Hospital at District Level',
                    'facility_category_id' => 8,
                    'created_at' => '2022-01-08 17:08:30',
                    'updated_at' => '2022-01-08 17:08:30',
                ),
            31 =>
                array (
                    'id' => 32,
                    'name' => 'Dental Hospital',
                    'facility_category_id' => 8,
                    'created_at' => '2022-01-08 17:08:30',
                    'updated_at' => '2022-01-08 17:08:30',
                ),
            32 =>
                array (
                    'id' => 33,
                    'name' => 'Standalone Laboratory',
                    'facility_category_id' => 9,
                    'created_at' => '2022-01-08 17:08:30',
                    'updated_at' => '2022-01-08 17:08:30',
                ),

            33 =>
                array (
                    'id' => 34,
                    'name' => 'Specimen Collection Point',
                    'facility_category_id' => 9,
                    'created_at' => '2022-01-08 17:08:30',
                    'updated_at' => '2022-01-08 17:08:30',
                ),
            34 =>
                array (
                    'id' => 35,
                    'name' => 'Mortuary Services',
                    'facility_category_id' => 9,
                    'created_at' => '2022-01-08 17:08:30',
                    'updated_at' => '2022-01-08 17:08:30',
                ),
            35 =>
                array (
                    'id' => 36,
                    'name' => 'Level IA2 (Dispensary Laboratory',
                    'facility_category_id' => 9,
                    'created_at' => '2022-01-08 17:08:30',
                    'updated_at' => '2022-01-08 17:08:30',
                ),
            36 =>
                array (
                    'id' => 37,
                    'name' => 'Level IA1 (Health Center Laboratory)',
                    'facility_category_id' => 9,
                    'created_at' => '2022-01-08 17:08:30',
                    'updated_at' => '2022-01-08 17:08:30',
                ),
            37 =>
                array (
                    'id' => 38,
                    'name' => 'Level IIA2 (District Laboratory)',
                    'facility_category_id' => 9,
                    'created_at' => '2022-01-08 17:08:30',
                    'updated_at' => '2022-01-08 17:08:30',
                ),
            38 =>
                array (
                    'id' => 39,
                    'name' => 'Level IIA1 (Regional Laboratory)',
                    'facility_category_id' => 9,
                    'created_at' => '2022-01-08 17:08:30',
                    'updated_at' => '2022-01-08 17:08:30',
                ),
            39 =>
                array (
                    'id' => 40,
                    'name' => 'Level III Multipurpose Health Laboratory',
                    'facility_category_id' => 9,
                    'created_at' => '2022-01-08 17:08:30',
                    'updated_at' => '2022-01-08 17:08:30',
                ),
            40 =>
                array (
                    'id' => 41,
                    'name' => 'Level III Single purpose Health Laboratory',
                    'facility_category_id' => 9,
                    'created_at' => '2022-01-08 17:08:30',
                    'updated_at' => '2022-01-08 17:08:30',
                ),
            41 =>
                array (
                    'id' => 42,
                    'name' => 'Dental Laboratory',
                    'facility_category_id' => 9,
                    'created_at' => '2022-01-08 17:08:30',
                    'updated_at' => '2022-01-08 17:08:30',
                ),
        ));

        $this->enableForeignKeys("facility_types");
    }
}
