<?php

use Illuminate\Database\Seeder;
use Database\TruncateTable;
use Database\DisableForeignKeys;

class PermissionRoleTableSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        $this->disableForeignKeys("permission_role");
        $this->delete('permission_role');

        \DB::table('permission_role')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'permission_id' => 1,
                    'role_id' => 1,
                ),
            1 =>
                array (
                    'id' => 2,
                    'permission_id' => 2,
                    'role_id' => 1,
                ),
            2 =>
                array (
                    'id' => 3,
                    'permission_id' => 3,
                    'role_id' => 1,
                ),
            3 =>
                array (
                    'id' => 4,
                    'permission_id' => 4,
                    'role_id' => 1,
                ),
            4 =>
                array (
                    'id' => 5,
                    'permission_id' => 5,
                    'role_id' => 1,
                ),
            5 =>
                array (
                    'id' => 6,
                    'permission_id' => 6,
                    'role_id' => 2,
                ),
            6 =>
                array (
                    'id' => 7,
                    'permission_id' => 7,
                    'role_id' => 2,
                ),
            7 =>
                array (
                    'id' => 8,
                    'permission_id' => 8,
                    'role_id' => 2,
                ),
            8 =>
                array (
                    'id' => 9,
                    'permission_id' => 9,
                    'role_id' => 2,
                ),
            9 =>
                array (
                    'id' => 10,
                    'permission_id' => 10,
                    'role_id' => 1,
                ),
            10 =>
                array (
                    'id' => 11,
                    'permission_id' => 11,
                    'role_id' => 1,
                ),
            11 =>
                array (
                    'id' => 12,
                    'permission_id' => 12,
                    'role_id' => 1,
                ),
            12 =>
                array (
                    'id' => 13,
                    'permission_id' => 13,
                    'role_id' => 1,
                ),
            13 =>
                array (
                    'id' => 14,
                    'permission_id' => 14,
                    'role_id' => 1,
                ),
            14 =>
                array (
                    'id' => 15,
                    'permission_id' => 15,
                    'role_id' => 1,
                ),
            15 =>
                array (
                    'id' => 16,
                    'permission_id' => 16,
                    'role_id' => 1,
                ),
            16 =>
                array (
                    'id' => 17,
                    'permission_id' => 17,
                    'role_id' => 1,
                ),
            17 =>
                array (
                    'id' => 18,
                    'permission_id' => 18,
                    'role_id' => 1,
                ),
            18 =>
                array (
                    'id' => 19,
                    'permission_id' => 19,
                    'role_id' => 1,
                ),
            19 =>
                array (
                    'id' => 20,
                    'permission_id' => 20,
                    'role_id' => 1,
                ),
            20 =>
                array (
                    'id' => 21,
                    'permission_id' => 21,
                    'role_id' => 1,
                ),
            21 =>
                array (
                    'id' => 22,
                    'permission_id' => 22,
                    'role_id' => 1,
                ),
            22 =>
                array (
                    'id' => 23,
                    'permission_id' => 23,
                    'role_id' => 1,
                ),
            23 =>
                array (
                    'id' => 24,
                    'permission_id' => 24,
                    'role_id' => 1,
                ),
            24 =>
                array (
                    'id' => 25,
                    'permission_id' => 25,
                    'role_id' => 1,
                ),
            25 =>
                array (
                    'id' => 26,
                    'permission_id' => 26,
                    'role_id' => 1,
                ),
            26 =>
                array (
                    'id' => 27,
                    'permission_id' => 27,
                    'role_id' => 1,
                ),
            27 =>
                array (
                    'id' => 28,
                    'permission_id' => 28,
                    'role_id' => 1,
                ),
            28 =>
                array (
                    'id' => 29,
                    'permission_id' => 29,
                    'role_id' => 1,
                ),
            29 =>
                array (
                    'id' => 30,
                    'permission_id' => 30,
                    'role_id' => 1,
                ),
        ));
        $this->enableForeignKeys("permission_role");

    }
}
