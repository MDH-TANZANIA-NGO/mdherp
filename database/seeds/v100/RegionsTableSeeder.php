<?php

use Illuminate\Database\Seeder;
use Database\TruncateTable;
use Database\DisableForeignKeys;

class RegionsTableSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        $this->disableForeignKeys("regions");
        $this->delete('regions');

        \DB::table('regions')->insert(array (

            0 =>
            array (
                'id' => 1,
                'name' => 'Arusha',
                'country_id' => 1,
                'hasc' => 'TZ.AS',
                'zone_id' => 4,
                'isactive' => true,
                'exceptional' =>false,
                'is_city'=>true,
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'Dar es Salaam',
                'country_id' => 1,
                'hasc' => 'TZ.DS',
                'zone_id' => 2,
                'isactive' => true,
                'exceptional' =>true,
                'is_city'=>true,
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'Dodoma',
                'country_id' => 1,
                'hasc' => 'TZ.DO',
                'zone_id' => 1,
                'isactive' => true,
                'exceptional' =>false,
                'is_city'=>true,
            ),
            3 =>
            array (
                'id' => 4,
                'name' => 'Geita',
                'country_id' => 1,
                'hasc' => 'TZ.GE',
                'zone_id' => 3,
                'isactive' => true,
                'exceptional' =>false,
                'is_city'=>false,
            ),
            4 =>
            array (
                'id' => 5,
                'name' => 'Iringa',
                'country_id' => 1,
                'hasc' => 'TZ.IG',
                'zone_id' => 5,
                'isactive' => true,
                'exceptional' =>false,
                'is_city'=>false,
            ),
            5 =>
            array (
                'id' => 6,
                'name' => 'Kagera',
                'country_id' => 1,
                'hasc' => 'TZ.KG',
                'zone_id' => 3,
                'isactive' => true,
                'exceptional' =>false,
                'is_city'=>false,
            ),
            6 =>
            array (
                'id' => 7,
                'name' => 'Katavi',
                'country_id' => 1,
                'hasc' => 'TZ.KA',
                'zone_id' => 5,
                'isactive' => true,
                'exceptional' =>false,
                'is_city'=>false,
            ),
            7 =>
            array (
                'id' => 8,
                'name' => 'Kigoma',
                'country_id' => 1,
                'hasc' => 'TZ.KM',
                'zone_id' => 1,
                'isactive' => true,
                'exceptional' =>false,
                'is_city'=>false,
            ),
            8 =>
            array (
                'id' => 9,
                'name' => 'Kilimanjaro',
                'country_id' => 1,
                'hasc' => 'TZ.KL',
                'zone_id' => 4,
                'isactive' => true,
                'exceptional' =>false,
                'is_city'=>false,
            ),
            9 =>
            array (
                'id' => 10,
                'name' => 'Lindi',
                'country_id' => 1,
                'hasc' => 'TZ.LI',
                'zone_id' => 6,
                'isactive' => true,
                'exceptional' =>false,
                'is_city'=>false,
            ),
            10 =>
            array (
                'id' => 11,
                'name' => 'Manyara',
                'country_id' => 1,
                'hasc' => 'TZ.MY',
                'zone_id' => 4,
                'isactive' => true,
                'exceptional' =>false,
                'is_city'=>false,
            ),
            11 =>
            array (
                'id' => 12,
                'name' => 'Mara',
                'country_id' => 1,
                'hasc' => 'TZ.MA',
                'zone_id' => 3,
                'isactive' => true,
                'exceptional' =>false,
                'is_city'=>false,
            ),
            12 =>
            array (
                'id' => 13,
                'name' => 'Mbeya',
                'country_id' => 1,
                'hasc' => 'TZ.MB',
                'zone_id' => 5,
                'isactive' => true,
                'exceptional' =>false,
                'is_city'=>true,
            ),
            13 =>
            array (
                'id' => 14,
                'name' => 'Morogoro',
                'country_id' => 1,
                'hasc' => 'TZ.MO',
                'zone_id' => 2,
                'isactive' => true,
                'exceptional' =>false,
                'is_city'=>false,
            ),
            14 =>
            array (
                'id' => 15,
                'name' => 'Mtwara',
                'country_id' => 1,
                'hasc' => 'TZ.MT',
                'zone_id' => 6,
                'isactive' => true,
                'exceptional' =>false,
                'is_city'=>false,
            ),
            15 =>
            array (
                'id' => 16,
                'name' => 'Mwanza',
                'country_id' => 1,
                'hasc' => 'TZ.MZ',
                'zone_id' => 3,
                'isactive' => true,
                'exceptional' =>false,
                'is_city'=>true,
            ),
            16 =>
            array (
                'id' => 17,
                'name' => 'Njombe',
                'country_id' => 1,
                'hasc' => 'TZ.NJ',
                'zone_id' => 5,
                'isactive' => true,
                'exceptional' =>false,
                'is_city'=>false,
            ),
            17 =>
            array (
                'id' => 18,
                'name' => 'Pemba North',
                'country_id' => 1,
                'hasc' => 'TZ.PN',
                'zone_id' => 2,
                'isactive' => true,
                'exceptional' =>false,
                'is_city'=>false,
            ),
            18 =>
            array (
                'id' => 19,
                'name' => 'Pemba South',
                'country_id' => 1,
                'hasc' => 'TZ.PS',
                'zone_id' => 2,
                'isactive' => true,
                'exceptional' =>false,
                'is_city'=>false,
            ),
            19 =>
            array (
                'id' => 20,
                'name' => 'Pwani',
                'country_id' => 1,
                'hasc' => 'TZ.PW',
                'zone_id' => 2,
                'isactive' => true,
                'exceptional' =>false,
                'is_city'=>false,
            ),
            20 =>
            array (
                'id' => 21,
                'name' => 'Rukwa',
                'country_id' => 1,
                'hasc' => 'TZ.RU',
                'zone_id' => 5,
                'isactive' => true,
                'exceptional' =>false,
                'is_city'=>false,
            ),
            21 =>
            array (
                'id' => 22,
                'name' => 'Ruvuma',
                'country_id' => 1,
                'hasc' => 'TZ.RV',
                'zone_id' => 6,
                'isactive' => true,
                'exceptional' =>false,
                'is_city'=>false,
            ),
            22 =>
            array (
                'id' => 23,
                'name' => 'Shinyanga',
                'country_id' => 1,
                'hasc' => 'TZ.SY',
                'zone_id' => 3,
                'isactive' => true,
                'exceptional' =>false,
                'is_city'=>false,
            ),
            23 =>
            array (
                'id' => 24,
                'name' => 'Simiyu',
                'country_id' => 1,
                'hasc' => 'TZ.SI',
                'zone_id' => 3,
                'isactive' => true,
                'exceptional' =>false,
                'is_city'=>false,
            ),
            24 =>
            array (
                'id' => 25,
                'name' => 'Singida',
                'country_id' => 1,
                'hasc' => 'TZ.SD',
                'zone_id' => 1,
                'isactive' => true,
                'exceptional' =>false,
                'is_city'=>false,
            ),
            25 =>
            array (
                'id' => 26,
                'name' => 'Tabora',
                'country_id' => 1,
                'hasc' => 'TZ.TB',
                'zone_id' => 1,
                'isactive' => true,
                'exceptional' =>false,
                'is_city'=>false,
            ),
            26 =>
            array (
                'id' => 27,
                'name' => 'Tanga',
                'country_id' => 1,
                'hasc' => 'TZ.TN',
                'zone_id' => 4,
                'isactive' => true,
                'exceptional' =>false,
                'is_city'=>false,
            ),
            27 =>
            array (
                'id' => 28,
                'name' => 'Zanzibar North',
                'country_id' => 1,
                'hasc' => 'TZ.ZN',
                'zone_id' => 2,
                'isactive' => true,
                'exceptional' =>false,
                'is_city'=>true,
            ),
            28 =>
            array (
                'id' => 29,
                'name' => 'Zanzibar South and Central',
                'country_id' => 1,
                'hasc' => 'TZ.ZS',
                'zone_id' => 2,
                'isactive' => true,
                'exceptional' =>false,
                'is_city'=>true,
            ),
            29 =>
            array (
                'id' => 30,
                'name' => 'Zanzibar Urban West',
                'country_id' => 1,
                'hasc' => 'TZ.ZW',
                'zone_id' => 2,
                'isactive' => true,
                'exceptional' =>false,
                'is_city'=>true,
            ),
            30 =>
            array (
                'id' => 31,
                'name' => 'Songwe',
                'country_id' => 1,
                'hasc' => NULL,
                'zone_id' => 5,
                'isactive' => true,
                'exceptional' =>false,
                'is_city'=>false,
            ),
            31 =>
            array (
                'id' => 32,
                'name' => 'Unguja South',
                'country_id' => 1,
                'zone_id' => 2,
                'hasc' => NULL,
                'isactive' => true,
                'exceptional' =>false,
                'is_city'=>true,
            ),
            32 =>
            array (
                'id' => 33,
                'name' => 'Unguja North',
                'country_id' => 1,
                'zone_id' => 2,
                'hasc' => NULL,
                'isactive' => true,
                'exceptional' =>false,
                'is_city'=>true,
            ),
            33 =>
                array (
                    'id' => 34,
                    'name' => 'HQ',
                    'country_id' => 1,
                    'zone_id' => 2,
                    'hasc' => NULL,
                    'isactive' => true,
                    'exceptional' =>false,
                    'is_city'=>true,
                ),
            34 =>
                array (
                    'id' => 0,
                    'name' => 'Unknown',
                    'country_id' => 1,
                    'zone_id' => 2,
                    'hasc' => NULL,
                    'isactive' => true,
                    'exceptional' =>false,
                    'is_city'=>true,
                ),
        ));
        $this->enableForeignKeys("regions");

    }
}
