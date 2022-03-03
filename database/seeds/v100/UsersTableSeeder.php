<?php

use Database\DisableForeignKeys;
use Database\TruncateTable;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class UsersTableSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys("users");
        $userRepo = new \App\Repositories\Access\UserRepository();
        $check = $userRepo->query()->where('email',config('mdh.email'));
        if  ($check->count() == 0) {
            $user = $userRepo->query()->updateOrCreate([
                'email' => config('mdh.email'),
                'first_name' => 'admin',
                'last_name' => 'admin',
                'phone' => '+255712123456',
                'password' => Hash::make(config('mdh.password')),
                'gender_cv_id' => 6,
                'active' => 1,
            ]);
            $this->enableForeignKeys("users");

            $this->disableForeignKeys('role_user');
            $user->roles()->attach(['role_id' => 1]);
            $this->enableForeignKeys("role_user");

            $this->disableForeignKeys('permission_role');
            $permissions = \DB::table('permission_role')->select('permission_id')->where(['role_id' => 1])->get();
            $this->enableForeignKeys("permission_role");

            foreach ($permissions as $permission){
                \DB::table('permission_user')->insert([
                    'permission_id' => $permission->permission_id,
                    'user_id' => $user->id,
                ]);
            }
        }else{

            $user = $check->first();
            $this->disableForeignKeys('permission_role');
            $permissions = \App\Models\Auth\PermissionRole::query()->select('permission_id')->where(['role_id' => 1])->get();
            $this->enableForeignKeys("permission_role");

            $user->permissions()->detach($permissions->toArray());
            $user->permissions()->sync($permissions->toArray());

        }

    }
}

