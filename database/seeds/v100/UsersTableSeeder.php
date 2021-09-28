<?php

use Database\DisableForeignKeys;
use Database\TruncateTable;
use Illuminate\Database\Seeder;

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
        $super_admin = config('icap.super_admin_email');
        $this->disableForeignKeys("users");
        $userRepo = new \App\Repositories\Access\UserRepository();
        $check = $userRepo->query()->where('email',$super_admin );
        if  ($check->count() == 0) {
            $user = $userRepo->query()->updateOrCreate([
                'email' => $super_admin,
                'first_name' => 'Hamis',
                'last_name' => 'Hamis',
                'phone' => '255758483019',
                'password' => bcrypt('123456'),
                'gender_cv_id' => 6,
                'isactive' => 1,
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

