<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'role-create',
            'role-edit',
            'role-list',
            'role-delete',
            'permission-list',
            'permission-create',
            'permission-edit',
            'permission-delete',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission
            ]);
        }




    //     $role = Role::findById(1);  
    //     $permission = Permission::create([
    //         'name' => 'user-index',
    //         'name' => 'user-create',
    //         'name' => 'user-edit',
    //         'name' =>  'user-delete',
    //         'name' =>  'role-create',
    //         'name' =>   'role-edit',
    //         'name' =>  'role-list',
    //         'name' =>    'role-delete',
    //         'name' =>  'permission-list',
    //         'name' =>  'permission-create',
    //         'name' =>   'permission-edit',
    //         'name' =>    'permission-delete'

    //     ]);

    //     $role->givePermissionTo($permission);  


    //     $role = Role::findById(2);
    //     $permission = Permission::create([
    //         'name' => 'user-index',
    //         'name' => 'user-create',
    //         'name' => 'user-edit',
    //         'name' =>  'user-delete',
            
    //     ]
    // );
    //     $role->givePermissionTo($permission);


}
}
