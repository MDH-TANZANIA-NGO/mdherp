<?php

use Illuminate\Database\Seeder;
use Database\TruncateTable;
use Database\DisableForeignKeys;

class RolesTableSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        $this->disableForeignKeys("roles");
        $this->delete('roles');

        \DB::table('roles')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'super_admin',
                'description' => 'Admin of system',
                'isfree' => 0,
                'isadministrative' => 1,
                'isactive' => '1',
            ),

            1 =>
                array (
                    'id' => 2,
                    'name' => 'employee',
                    'description' => 'System admin',
                    'isfree' => 0,
                    'isadministrative' => 0,
                    'isactive' => '1',
            ),

        ));
        $this->enableForeignKeys("roles");

    }
}
