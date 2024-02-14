<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $super = Role::updateOrCreate([
            'name' => 'ADMIN',
        ],[
            'name' => 'ADMIN',
        ]);

        $super_perm = Permission::whereIn('group_menu',['1'])->pluck('id','id')->all();
        $super->syncPermissions($super_perm);

        $user = Role::updateOrCreate([
            'name' => 'USER',
        ],[
            'name' => 'USER',
        ]);

        $user_perm = Permission::whereIn('group_menu',['0'])->pluck('id','id')->all();
        $user->syncPermissions($user_perm);

    }
}
