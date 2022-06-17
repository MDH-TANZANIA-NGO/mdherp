<?php

use Illuminate\Database\Seeder;
use Database\TruncateTable;
use Database\DisableForeignKeys;

class DistrictsTableSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        $this->disableForeignKeys("districts");
        $this->delete('districts');

        \DB::table('districts')->insert(array (
            0 =>
            array (
                'id' => 1,
                'region_id' => 1,
                'name' => 'Meru',
                'separate_id' => null,

            ),
            1 =>
            array (
                'id' => 2,
                'region_id' => 1,
                'name' => 'Arusha City',
                'separate_id' => null,

            ),
            2 =>
            array (
                'id' => 3,
                'region_id' => 1,
                'name' => 'Arusha District',
                'separate_id' => null,
            ),
            3 =>
            array (
                'id' => 4,
                'region_id' => 1,
                'name' => 'Karatu',
                'separate_id' => null,
            ),
            4 =>
            array (
                'id' => 5,
                'region_id' => 1,
                'name' => 'Longido',
                'separate_id' => null,
            ),
            5 =>
            array (
                'id' => 6,
                'region_id' => 1,
                'name' => 'Monduli',
                'separate_id' => null,
            ),
            6 =>
            array (
                'id' => 7,
                'region_id' => 1,
                'name' => 'Ngorongoro',
                'separate_id' => null,
            ),
            7 =>
            array (
                'id' => 8,
                'region_id' => 2,
                'name' => 'Ilala',
                'separate_id' => 2,
            ),
            8 =>
            array (
                'id' => 9,
                'region_id' => 2,
                'name' => 'Kinondoni',
                'separate_id' => 2,
            ),
            9 =>
            array (
                'id' => 10,
                'region_id' => 2,
                'name' => 'Temeke',
                'separate_id' => 2,
            ),
            10 =>
            array (
                'id' => 11,
                'region_id' => 2,
                'name' => 'Kigamboni',
                'separate_id' => 2,
            ),
            11 =>
            array (
                'id' => 12,
                'region_id' => 2,
                'name' => 'Ubungo',
                'separate_id' => 2,
            ),
            12 =>
            array (
                'id' => 13,
                'region_id' => 3,
                'name' => 'Bahi',
                'separate_id' => null,
            ),
            13 =>
            array (
                'id' => 14,
                'region_id' => 3,
                'name' => 'Chamwino',
                'separate_id' => null,
            ),
            14 =>
            array (
                'id' => 15,
                'region_id' => 3,
                'name' => 'Chemba',
                'separate_id' => null,
            ),
            15 =>
            array (
                'id' => 16,
                'region_id' => 3,
                'name' => 'Dodoma Municipal',
                'separate_id' => 2,
            ),
            16 =>
            array (
                'id' => 17,
                'region_id' => 3,
                'name' => 'Kondoa',
                'separate_id' => null,
            ),
            17 =>
            array (
                'id' => 18,
                'region_id' => 3,
                'name' => 'Kongwa',
                'separate_id' => null,
            ),
            18 =>
            array (
                'id' => 19,
                'region_id' => 3,
                'name' => 'Mpwapwa',
                'separate_id' => null,
            ),
            19 =>
            array (
                'id' => 20,
                'region_id' => 4,
                'name' => 'Bukombe',
                'separate_id' => 1,
            ),
            20 =>
            array (
                'id' => 21,
                'region_id' => 4,
                'name' => 'Chato',
                'separate_id' => 1,
            ),
            21 =>
            array (
                'id' => 22,
                'region_id' => 4,
                'name' => 'Geita District Council',
                'separate_id' => 1,
            ),
            22 =>
            array (
                'id' => 23,
                'region_id' => 4,
                'name' => 'Mbogwe',
                'separate_id' => 1,
            ),
            23 =>
            array (
                'id' => 24,
                'region_id' => 4,
                'name' => 'Nyang\'hwale',
                'separate_id' => 1,
            ),
            24 =>
            array (
                'id' => 25,
                'region_id' => 5,
                'name' => 'Iringa District',
                'separate_id' => null,
            ),
            25 =>
            array (
                'id' => 26,
                'region_id' => 5,
                'name' => 'Iringa Municipal',
                'separate_id' => null,
            ),
            26 =>
            array (
                'id' => 27,
                'region_id' => 5,
                'name' => 'Kilolo',
                'separate_id' => null,
            ),
            27 =>
            array (
                'id' => 28,
                'region_id' => 5,
                'name' => 'Mafinga Town',
                'separate_id' => null,
            ),
            28 =>
            array (
                'id' => 29,
                'region_id' => 5,
                'name' => 'Mufindi',
                'separate_id' => null,
            ),
            29 =>
            array (
                'id' => 30,
                'region_id' => 6,
                'name' => 'Biharamulo',
                'separate_id' => 1,
            ),
            30 =>
            array (
                'id' => 31,
                'region_id' => 6,
                'name' => 'Bukoba District',
                'separate_id' => 1,
            ),
            31 =>
            array (
                'id' => 32,
                'region_id' => 6,
                'name' => 'Bukoba Municipal',
                'separate_id' => 2,
            ),
            32 =>
            array (
                'id' => 33,
                'region_id' => 6,
                'name' => 'Karagwe',
                'separate_id' => 1,
            ),
            33 =>
            array (
                'id' => 34,
                'region_id' => 6,
                'name' => 'Kyerwa',
                'separate_id' => 1,
            ),
            34 =>
            array (
                'id' => 35,
                'region_id' => 6,
                'name' => 'Missenyi',
                'separate_id' => 1,
            ),
            35 =>
            array (
                'id' => 36,
                'region_id' => 6,
                'name' => 'Muleba',
                'separate_id' => 1,
            ),
            36 =>
            array (
                'id' => 37,
                'region_id' => 6,
                'name' => 'Ngara',
                'separate_id' => 1,
            ),
            37 =>
            array (
                'id' => 38,
                'region_id' => 7,
                'name' => 'Mlele',
                'separate_id' => null,
            ),
            38 =>
            array (
                'id' => 39,
                'region_id' => 7,
                'name' => 'Mpanda',
                'separate_id' => null,
            ),
            39 =>
            array (
                'id' => 40,
                'region_id' => 7,
                'name' => 'Mpanda Town',
                'separate_id' => null,
            ),
            40 =>
            array (
                'id' => 41,
                'region_id' => 8,
                'name' => 'Buhigwe',
                'separate_id' => 1,
            ),
            41 =>
            array (
                'id' => 42,
                'region_id' => 8,
                'name' => 'Kakonko',
                'separate_id' => null,
            ),
            42 =>
            array (
                'id' => 43,
                'region_id' => 8,
                'name' => 'Kasulu District',
                'separate_id' => 1,
            ),
            43 =>
            array (
                'id' => 44,
                'region_id' => 8,
                'name' => 'Kasulu Town',
                'separate_id' => 3,
            ),
            44 =>
            array (
                'id' => 45,
                'region_id' => 8,
                'name' => 'Kibondo',
                'separate_id' => 1,
            ),
            45 =>
            array (
                'id' => 46,
                'region_id' => 8,
                'name' => 'Kigoma District',
                'separate_id' => 1,
            ),
            46 =>
            array (
                'id' => 47,
                'region_id' => 8,
                'name' => 'Kigoma-Ujiji Municipal',
                'separate_id' => 2,
            ),
            47 =>
            array (
                'id' => 48,
                'region_id' => 8,
                'name' => 'Uvinza',
                'separate_id' => 1,
            ),
            48 =>
            array (
                'id' => 49,
                'region_id' => 9,
                'name' => 'Hai',
                'separate_id' => null,
            ),
            49 =>
            array (
                'id' => 50,
                'region_id' => 9,
                'name' => 'Moshi District',
                'separate_id' => null,
            ),
            50 =>
            array (
                'id' => 51,
                'region_id' => 9,
                'name' => 'Moshi Municipal',
                'separate_id' => null,
            ),
            51 =>
            array (
                'id' => 52,
                'region_id' => 9,
                'name' => 'Mwanga',
                'separate_id' => null,
            ),
            52 =>
            array (
                'id' => 53,
                'region_id' => 9,
                'name' => 'Rombo',
                'separate_id' => null,
            ),
            53 =>
            array (
                'id' => 54,
                'region_id' => 9,
                'name' => 'Same',
                'separate_id' => null,
            ),
            54 =>
            array (
                'id' => 55,
                'region_id' => 9,
                'name' => 'Siha',
                'separate_id' => null,
            ),
            55 =>
            array (
                'id' => 56,
                'region_id' => 10,
                'name' => 'Kilwa',
                'separate_id' => null,
            ),
            56 =>
            array (
                'id' => 57,
                'region_id' => 10,
                'name' => 'Lindi District',
                'separate_id' => null,
            ),
            57 =>
            array (
                'id' => 58,
                'region_id' => 10,
                'name' => 'Lindi Municipal',
                'separate_id' => null,
            ),
            58 =>
            array (
                'id' => 59,
                'region_id' => 10,
                'name' => 'Liwale',
                'separate_id' => null,
            ),
            59 =>
            array (
                'id' => 60,
                'region_id' => 10,
                'name' => 'Nachingwea',
                'separate_id' => null,
            ),
            60 =>
            array (
                'id' => 61,
                'region_id' => 10,
                'name' => 'Ruangwa',
                'separate_id' => null,
            ),
            61 =>
            array (
                'id' => 62,
                'region_id' => 11,
                'name' => 'Babati Town',
                'separate_id' => null,
            ),
            62 =>
            array (
                'id' => 63,
                'region_id' => 11,
                'name' => 'Babati District',
                'separate_id' => null,
            ),
            63 =>
            array (
                'id' => 64,
                'region_id' => 11,
                'name' => 'Hanang',
                'separate_id' => null,
            ),
            64 =>
            array (
                'id' => 65,
                'region_id' => 11,
                'name' => 'Kiteto',
                'separate_id' => null,
            ),
            65 =>
            array (
                'id' => 66,
                'region_id' => 11,
                'name' => 'Mbulu',
                'separate_id' => null,
            ),
            66 =>
            array (
                'id' => 67,
                'region_id' => 11,
                'name' => 'Simanjiro',
                'separate_id' => null,
            ),
            67 =>
            array (
                'id' => 68,
                'region_id' => 12,
                'name' => 'Bunda Town Council',
                'separate_id' => 3,
            ),
            68 =>
            array (
                'id' => 69,
                'region_id' => 12,
                'name' => 'Butiama',
                'separate_id' => 1,
            ),
            69 =>
            array (
                'id' => 70,
                'region_id' => 12,
                'name' => 'Musoma District',
                'separate_id' => 1,
            ),
            70 =>
            array (
                'id' => 71,
                'region_id' => 12,
                'name' => 'Musoma Municipal',
                'separate_id' => 2,
            ),
            71 =>
            array (
                'id' => 72,
                'region_id' => 12,
                'name' => 'Rorya',
                'separate_id' => 1,
            ),
            72 =>
            array (
                'id' => 73,
                'region_id' => 12,
                'name' => 'Serengeti',
                'separate_id' => null,
            ),
            73 =>
            array (
                'id' => 74,
                'region_id' => 12,
                'name' => 'Tarime District',
                'separate_id' => 1,
            ),
            74 =>
            array (
                'id' => 75,
                'region_id' => 13,
                'name' => 'Busokelo',
                'separate_id' => null,
            ),
            75 =>
            array (
                'id' => 76,
                'region_id' => 13,
                'name' => 'Chunya',
                'separate_id' => null,
            ),
            76 =>
            array (
                'id' => 77,
                'region_id' => 13,
                'name' => 'Kyela',
                'separate_id' => 1,
            ),
            77 =>
            array (
                'id' => 78,
                'region_id' => 13,
                'name' => 'Mbarali',
                'separate_id' => null,
            ),
            78 =>
            array (
                'id' => 79,
                'region_id' => 13,
                'name' => 'Mbeya City',
                'separate_id' => null,
            ),
            79 =>
            array (
                'id' => 80,
                'region_id' => 13,
                'name' => 'Mbeya District',
                'separate_id' => null,
            ),
            80 =>
            array (
                'id' => 81,
                'region_id' => 13,
                'name' => 'Rungwe',
                'separate_id' => null,
            ),
            81 =>
            array (
                'id' => 82,
                'region_id' => 14,
                'name' => 'Gairo',
                'separate_id' => null,
            ),
            82 =>
            array (
                'id' => 83,
                'region_id' => 14,
                'name' => 'Kilombero',
                'separate_id' => 1,
            ),
            83 =>
            array (
                'id' => 84,
                'region_id' => 14,
                'name' => 'Kilosa',
                'separate_id' => 1,
            ),
            84 =>
            array (
                'id' => 85,
                'region_id' => 14,
                'name' => 'Morogoro District',
                'separate_id' => 1,
            ),
            85 =>
            array (
                'id' => 86,
                'region_id' => 14,
                'name' => 'Morogoro Municipal',
                'separate_id' => 2,
            ),
            86 =>
            array (
                'id' => 87,
                'region_id' => 14,
                'name' => 'Mvomero',
                'separate_id' => 1,
            ),
            87 =>
            array (
                'id' => 88,
                'region_id' => 14,
                'name' => 'Ulanga',
                'separate_id' => 1,
            ),
            88 =>
            array (
                'id' => 89,
                'region_id' => 15,
                'name' => 'Masasi District',
                'separate_id' => null,
            ),
            89 =>
            array (
                'id' => 90,
                'region_id' => 15,
                'name' => 'Masasi Town',
                'separate_id' => null,
            ),
            90 =>
            array (
                'id' => 91,
                'region_id' => 15,
                'name' => 'Mtwara District',
                'separate_id' => null,
            ),
            91 =>
            array (
                'id' => 92,
                'region_id' => 15,
                'name' => 'Mtwara Municipal',
                'separate_id' => null,
            ),
            92 =>
            array (
                'id' => 93,
                'region_id' => 15,
                'name' => 'Nanyumbu',
                'separate_id' => null,
            ),
            93 =>
            array (
                'id' => 94,
                'region_id' => 15,
                'name' => 'Newala',
                'separate_id' => null,
            ),
            94 =>
            array (
                'id' => 95,
                'region_id' => 15,
                'name' => 'Tandahimba',
                'separate_id' => null,
            ),
            95 =>
            array (
                'id' => 96,
                'region_id' => 16,
                'name' => 'Ilemela',
                'separate_id' => 2,
            ),
            96 =>
            array (
                'id' => 97,
                'region_id' => 16,
                'name' => 'Kwimba',
                'separate_id' => 1,
            ),
            97 =>
            array (
                'id' => 98,
                'region_id' => 16,
                'name' => 'Magu',
                'separate_id' => 1,
            ),
            98 =>
            array (
                'id' => 99,
                'region_id' => 16,
                'name' => 'Misungwi',
                'separate_id' => 1,
            ),
            99 =>
            array (
                'id' => 100,
                'region_id' => 16,
                'name' => 'Nyamagana',
                'separate_id' => 2,
            ),
            100 =>
            array (
                'id' => 101,
                'region_id' => 16,
                'name' => 'Sengerema',
                'separate_id' => 1,
            ),
            101 =>
            array (
                'id' => 102,
                'region_id' => 16,
                'name' => 'Ukerewe',
                'separate_id' => 1,
            ),
            102 =>
            array (
                'id' => 103,
                'region_id' => 32,
                'name' => 'Kati',
                'separate_id' => null,
            ),
            103 =>
            array (
                'id' => 104,
                'region_id' => 32,
                'name' => 'Kusini',
                'separate_id' => null,
            ),
            104 =>
            array (
                'id' => 105,
                'region_id' => 30,
                'name' => 'Magharibi',
                'separate_id' => null,
            ),
            105 =>
            array (
                'id' => 106,
                'region_id' => 30,
                'name' => 'Mjini',
                'separate_id' => null,
            ),
            106 =>
            array (
                'id' => 107,
                'region_id' => 33,
                'name' => 'Kaskazini A',
                'separate_id' => null,
            ),
            107 =>
            array (
                'id' => 108,
                'region_id' => 33,
                'name' => 'Kaskazini B',
                'separate_id' => null,
            ),
            108 =>
            array (
                'id' => 109,
                'region_id' => 18,
                'name' => 'Micheweni',
                'separate_id' => null,
            ),
            109 =>
            array (
                'id' => 110,
                'region_id' => 18,
                'name' => 'Wete',
                'separate_id' => null,
            ),
            110 =>
            array (
                'id' => 111,
                'region_id' => 19,
                'name' => 'Chake Chake',
                'separate_id' => null,
            ),
            111 =>
            array (
                'id' => 112,
                'region_id' => 19,
                'name' => 'Mkoani',
                'separate_id' => null,
            ),
            112 =>
            array (
                'id' => 113,
                'region_id' => 17,
                'name' => 'Ludewa',
                'separate_id' => null,
            ),
            113 =>
            array (
                'id' => 114,
                'region_id' => 17,
                'name' => 'Makambako',
                'separate_id' => null,
            ),
            114 =>
            array (
                'id' => 115,
                'region_id' => 17,
                'name' => 'Makete',
                'separate_id' => null,
            ),
            115 =>
            array (
                'id' => 116,
                'region_id' => 17,
                'name' => 'Njombe District',
                'separate_id' => null,
            ),
            116 =>
            array (
                'id' => 117,
                'region_id' => 17,
                'name' => 'Njombe Town',
                'separate_id' => null,
            ),
            117 =>
            array (
                'id' => 118,
                'region_id' => 17,
                'name' => 'Wanging\'ombe',
                'separate_id' => null,
            ),
            118 =>
            array (
                'id' => 119,
                'region_id' => 20,
                'name' => 'Bagamoyo',
                'separate_id' => 2,
            ),
            119 =>
            array (
                'id' => 120,
                'region_id' => 20,
                'name' => 'Kibaha District',
                'separate_id' => 1,
            ),
            120 =>
            array (
                'id' => 121,
                'region_id' => 20,
                'name' => 'Kibaha Town',
                'separate_id' => 1,
            ),
            121 =>
            array (
                'id' => 122,
                'region_id' => 20,
                'name' => 'Kisarawe',
                'separate_id' => null,
            ),
            122 =>
            array (
                'id' => 123,
                'region_id' => 20,
                'name' => 'Mafia',
                'separate_id' => null,
            ),
            123 =>
            array (
                'id' => 124,
                'region_id' => 20,
                'name' => 'Mkuranga',
                'separate_id' => 1,
            ),
            124 =>
            array (
                'id' => 125,
                'region_id' => 20,
                'name' => 'Rufiji',
                'separate_id' => null,
            ),
            125 =>
            array (
                'id' => 126,
                'region_id' => 21,
                'name' => 'Kalambo',
                'separate_id' => null,
            ),
            126 =>
            array (
                'id' => 127,
                'region_id' => 21,
                'name' => 'Nkasi',
                'separate_id' => null,
            ),
            127 =>
            array (
                'id' => 128,
                'region_id' => 21,
                'name' => 'Sumbawanga District',
                'separate_id' => null,
            ),
            128 =>
            array (
                'id' => 129,
                'region_id' => 21,
                'name' => 'Sumbawanga Municipal',
                'separate_id' => null,
            ),
            129 =>
            array (
                'id' => 130,
                'region_id' => 22,
                'name' => 'Mbinga',
                'separate_id' => null,
            ),
            130 =>
            array (
                'id' => 131,
                'region_id' => 22,
                'name' => 'Songea District',
                'separate_id' => null,
            ),
            131 =>
            array (
                'id' => 132,
                'region_id' => 22,
                'name' => 'Songea Municipal',
                'separate_id' => null,
            ),
            132 =>
            array (
                'id' => 133,
                'region_id' => 22,
                'name' => 'Tunduru',
                'separate_id' => null,
            ),
            133 =>
            array (
                'id' => 134,
                'region_id' => 22,
                'name' => 'Namtumbo',
                'separate_id' => null,
            ),
            134 =>
            array (
                'id' => 135,
                'region_id' => 22,
                'name' => 'Nyasa',
                'separate_id' => null,
            ),
            135 =>
            array (
                'id' => 136,
                'region_id' => 24,
                'name' => 'Bariadi',
                'separate_id' => 3,
            ),
            136 =>
            array (
                'id' => 137,
                'region_id' => 24,
                'name' => 'Busega',
                'separate_id' => null,
            ),
            137 =>
            array (
                'id' => 138,
                'region_id' => 24,
                'name' => 'Itilima',
                'separate_id' => 1,
            ),
            138 =>
            array (
                'id' => 139,
                'region_id' => 24,
                'name' => 'Maswa',
                'separate_id' => 1,
            ),
            139 =>
            array (
                'id' => 140,
                'region_id' => 24,
                'name' => 'Meatu',
                'separate_id' => null,
            ),
            140 =>
            array (
                'id' => 141,
                'region_id' => 25,
                'name' => 'Ikungi',
                'separate_id' => null,
            ),
            141 =>
            array (
                'id' => 142,
                'region_id' => 25,
                'name' => 'Iramba',
                'separate_id' => null,
            ),
            142 =>
            array (
                'id' => 143,
                'region_id' => 25,
                'name' => 'Manyoni',
                'separate_id' => null,
            ),
            143 =>
            array (
                'id' => 144,
                'region_id' => 25,
                'name' => 'Mkalama',
                'separate_id' => null,
            ),
            144 =>
            array (
                'id' => 145,
                'region_id' => 25,
                'name' => 'Singida District',
                'separate_id' => null,
            ),
            145 =>
            array (
                'id' => 146,
                'region_id' => 25,
                'name' => 'Singida Municipal',
                'separate_id' => null,
            ),
            146 =>
            array (
                'id' => 147,
                'region_id' => 26,
                'name' => 'Igunga',
                'separate_id' => null,
            ),
            147 =>
            array (
                'id' => 148,
                'region_id' => 26,
                'name' => 'Kaliua',
                'separate_id' => null,
            ),
            148 =>
            array (
                'id' => 149,
                'region_id' => 26,
                'name' => 'Nzega',
                'separate_id' => 1,
            ),
            149 =>
            array (
                'id' => 150,
                'region_id' => 26,
                'name' => 'Sikonge',
                'separate_id' => null,
            ),
            150 =>
            array (
                'id' => 151,
                'region_id' => 26,
                'name' => 'Tabora Municipal',
                'separate_id' => null,
            ),
            151 =>
            array (
                'id' => 152,
                'region_id' => 26,
                'name' => 'Urambo',
                'separate_id' => null,
            ),
            152 =>
            array (
                'id' => 153,
                'region_id' => 26,
                'name' => 'Uyui',
                'separate_id' => null,
            ),
            153 =>
            array (
                'id' => 154,
                'region_id' => 27,
                'name' => 'Handeni District',
                'separate_id' => null,
            ),
            154 =>
            array (
                'id' => 155,
                'region_id' => 27,
                'name' => 'Handeni Town',
                'separate_id' => null,
            ),
            155 =>
            array (
                'id' => 156,
                'region_id' => 27,
                'name' => 'Kilindi',
                'separate_id' => null,
            ),
            156 =>
            array (
                'id' => 157,
                'region_id' => 27,
                'name' => 'Korogwe Town',
                'separate_id' => null,
            ),
            157 =>
            array (
                'id' => 158,
                'region_id' => 27,
                'name' => 'Korogwe District',
                'separate_id' => null,
            ),
            158 =>
            array (
                'id' => 159,
                'region_id' => 27,
                'name' => 'Lushoto',
                'separate_id' => null,
            ),
            159 =>
            array (
                'id' => 160,
                'region_id' => 27,
                'name' => 'Muheza',
                'separate_id' => null,
            ),
            160 =>
            array (
                'id' => 161,
                'region_id' => 27,
                'name' => 'Mkinga',
                'separate_id' => null,
            ),
            161 =>
            array (
                'id' => 162,
                'region_id' => 27,
                'name' => 'Pangani',
                'separate_id' => null,
            ),
            162 =>
            array (
                'id' => 163,
                'region_id' => 27,
                'name' => 'Tanga City',
                'separate_id' => null,
            ),
            163 =>
            array (
                'id' => 164,
                'region_id' => 23,
                'name' => 'Kahama Town',
                'separate_id' => null,
            ),
            164 =>
            array (
                'id' => 165,
                'region_id' => 23,
                'name' => 'Kahama District',
                'separate_id' => null,
            ),
            165 =>
            array (
                'id' => 166,
                'region_id' => 23,
                'name' => 'Kishapu',
                'separate_id' => null,
            ),
            166 =>
            array (
                'id' => 167,
                'region_id' => 23,
                'name' => 'Shinyanga District',
                'separate_id' => null,
            ),
            167 =>
            array (
                'id' => 168,
                'region_id' => 23,
                'name' => 'Shinyanga Municipal',
                'separate_id' => null,
            ),
            168 =>
            array (
                'id' => 169,
                'region_id' => 31,
                'name' => 'Songwe',
                'separate_id' => null,
            ),
            169 =>
            array (
                'id' => 170,
                'region_id' => 31,
                'name' => 'Mbozi',
                'separate_id' => null,
            ),
            170 =>
            array (
                'id' => 171,
                'region_id' => 31,
                'name' => 'Ileje',
                'separate_id' => null,
            ),
            171 =>
            array (
                'id' => 172,
                'region_id' => 31,
                'name' => 'Momba',
                'separate_id' => null,
            ),
            172 =>
                array (
                    'id' => 173,
                    'region_id' => 4,
                    'name' => 'Geita Town Council',
                    'separate_id' => 3,
                ),
            173 =>
                array (
                    'id' => 174,
                    'region_id' => 16,
                    'name' => 'Buchosa',
                    'separate_id' => 1,
                ),
            174 =>
                array (
                    'id' => 175,
                    'region_id' => 20,
                    'name' => 'Chalinze',
                    'separate_id' => 1,
                ),
            175 =>
                array (
                    'id' => 176,
                    'region_id' => 12,
                    'name' => 'Bunda District',
                    'separate_id' => 1,
                ),
            176 =>
                array (
                    'id' => 177,
                    'region_id' => 12,
                    'name' => 'Tarime Town Council',
                    'separate_id' => 3,
                ),
            177 =>
                array (
                    'id' => 178,
                    'region_id' => 30,
                    'name' => 'Zanzibar West District',
                    'separate_id' => null,
                ),
        ));
        $this->enableForeignKeys("districts");
    }
}
