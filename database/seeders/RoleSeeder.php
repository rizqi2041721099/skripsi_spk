<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            'ADMIN' => ['ALL'],
            'USER' => ['dashboard', 'list-restaurant', 'filter-restaurant']
        ];

        // Create roles and assign permissions
        foreach ($roles as $roleName => $permissions) {
            $role = Role::create(['name' => $roleName]);
            if ($roleName === 'all_permissions') {
                $permissions = Permission::pluck('name')->toArray();
            }
            foreach ($permissions as $permissionName) {
                $permission = Permission::firstOrCreate(['name' => $permissionName]);
                $role->givePermissionTo($permission);
            }
        }

    }
}
