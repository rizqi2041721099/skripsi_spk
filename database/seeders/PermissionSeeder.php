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
            ],
            [
                'name' => 'create-food-variaties',
            ],
            [
                'name' => 'edit-food-variaties',
            ],
            [
                'name' => 'delete-food-variaties',
            ],
            [
                'name' => 'list-facilities',
            ],
            [
                'name' => 'create-facilities',
            ],
            [
                'name' => 'edit-facilities',
            ],
            [
                'name' => 'delete-facilities',
            ],
            [
                'name' => 'list-menu',
            ],
            [
                'name' => 'create-menu',
            ],
            [
                'name' => 'edit-menu',
            ],
            [
                'name' => 'delete-menu',
            ],
            [
                'name' => 'list-restaurant',
            ],
            [
                'name' => 'create-restaurant',
            ],
            [
                'name' => 'edit-restaurant',
            ],
            [
                'name' => 'delete-restaurant',
            ],
            [
                'name' => 'filter-restaurant',
            ],
            [
                'name' => 'list-users',
            ],
            [
                'name' => 'create-users',
            ],
            [
                'name' => 'edit-users',
            ],
            [
                'name' => 'delete-users',
            ],
            [
                'name' => 'list-role',
            ],
            [
                'name' => 'create-role',
            ],
            [
                'name' => 'edit-role',
            ],
            [
                'name' => 'delete-role',
            ],
            [
                'name' => 'list-kriteria',
            ],
            [
                'name' => 'create-kriteria',
            ],
            [
                'name' => 'edit-kriteria',
            ],
            [
                'name' => 'delete-kriteria',
            ],
            [
                'name' => 'list-alternatif',
            ],
            [
                'name' => 'create-alternatif',
            ],
            [
                'name' => 'edit-alternatif',
            ],
            [
                'name' => 'delete-alternatif',
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
