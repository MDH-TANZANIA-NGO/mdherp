<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();
        $this->call(RolesTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(PermissionRoleTableSeeder::class);
        $this->call(CodesTableSeeder::class);
        $this->call(CodeValuesTableSeeder::class);
        $this->call(DesignationsTableSeeder::class);
        $this->call(UnitGroupsTableSeeder::class);
        $this->call(UnitsTableSeeder::class);
        $this->call(SysdefsTableSeeder::class);
        $this->call(RegionsTableSeeder::class);
        $this->call(ZonesTableSeeder::class);
        $this->call(DistrictsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
//        $this->call(WfModuleGroupsTableSeeder::class);
//        $this->call(WfModulesTableSeeder::class);
//        $this->call(WfDefinitionsTableSeeder::class);
        DB::commit();
    }
}
