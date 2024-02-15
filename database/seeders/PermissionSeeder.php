<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run()
    {
       $permissions = [
            [
                'name' => 'list-food-variaties',
                'group_menu'    => '0',
            ],
            [
                'name' => 'create-food-variaties',
                'group_menu'    => '0',
            ],
            [
                'name' => 'edit-food-variaties',
                'group_menu'    => '0',
            ],
            [
                'name' => 'delete-food-variaties',
                'group_menu'    => '0',
            ],
            [
                'name' => 'list-facilities',
                'group_menu'    => '0',
            ],
            [
                'name' => 'create-facilities',
                'group_menu'    => '0',
            ],
            [
                'name' => 'edit-facilities',
                'group_menu'    => '0',
            ],
            [
                'name' => 'delete-facilities',
                'group_menu'    => '0',
            ],
            [
                'name' => 'list-flavors',
                'group_menu'    => '0',
            ],
            [
                'name' => 'create-flavors',
                'group_menu'    => '0',
            ],
            [
                'name' => 'edit-flavors',
                'group_menu'    => '0',
            ],
            [
                'name' => 'delete-flavors',
                'group_menu'    => '0',
            ],
            [
                'name' => 'list-menu',
                'group_menu'    => '0',
            ],
            [
                'name' => 'create-menu',
                'group_menu'    => '0',
            ],
            [
                'name' => 'edit-menu',
                'group_menu'    => '0',
            ],
            [
                'name' => 'delete-menu',
                'group_menu'    => '0',
            ],
            [
                'name' => 'list-restaurant',
                'group_menu'    => '0',
            ],
            [
                'name' => 'create-restaurant',
                'group_menu'    => '0',
            ],
            [
                'name' => 'edit-restaurant',
                'group_menu'    => '0',
            ],
            [
                'name' => 'delete-restaurant',
                'group_menu'    => '0',
            ],
            [
                'name' => 'filter-restaurant',
                'group_menu'    => '0',
            ],


            // permission users
            [
                'name' => 'filter-restaurant',
                'group_menu'    => '1',
            ],
            [
                'name' => 'create-restaurant',
                'group_menu'    => '1',
            ],

            [
                'name' => 'list-users',
                'group_menu'    => '0',
            ],
            [
                'name' => 'create-users',
                'group_menu'    => '0',
            ],
            [
                'name' => 'edit-users',
                'group_menu'    => '0',
            ],
            [
                'name' => 'delete-users',
                'group_menu'    => '0',
            ],
            [
                'name' => 'list-role',
                'group_menu'    => '0',
            ],
            [
                'name' => 'create-role',
                'group_menu'    => '0',
            ],
            [
                'name' => 'edit-role',
                'group_menu'    => '0',
            ],
            [
                'name' => 'delete-role',
                'group_menu'    => '0',
            ],

        ];

        foreach ($permissions as $permission) {
            $permission['guard_name']  = 'web';
            Permission::updateOrCreate([
                'name'  => $permission['name']
            ],$permission);
        }
    }
}
