<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class SuperAdminSeeder extends Seeder
{
    public function run()
    {
        $user = User::create([
            'name'  => 'admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('123456'),
        ]);

        $role        = Role::updateOrcreate([
            'name' => 'ADMIN'
        ],[
            'name' => 'ADMIN'
        ]);
        $permissions = Permission::pluck('id','id')->all();

        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);
    }
}
