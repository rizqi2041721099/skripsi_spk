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
            ['name'  => 'cleaner'],
            ['name'  => 'dashboard'],
            ['name'  => 'perhitungan-saw'],
            ['name'  => 'data-master'],
            ['name'  => 'list-rejected-restaurants'],
            ['name'  => 'list-approve-restaurants'],
            ['name'  => 'search-restaurants'],
            [
                'name' => 'list-kriteria-harga',
            ],
            [
                'name' => 'create-kriteria-harga',
            ],
            [
                'name' => 'edit-kriteria-harga',
            ],
            [
                'name' => 'delete-kriteria-harga',
            ],
            [
                'name' => 'list-kriteria-jarak',
            ],
            [
                'name' => 'create-kriteria-jarak',
            ],
            [
                'name' => 'edit-kriteria-jarak',
            ],
            [
                'name' => 'delete-kriteria-jarak',
            ],
            [
                'name' => 'list-kriteria-fasilitas',
            ],
            [
                'name' => 'create-kriteria-fasilitas',
            ],
            [
                'name' => 'edit-kriteria-fasilitas',
            ],
            [
                'name' => 'delete-kriteria-fasilitas',
            ],
            [
                'name' => 'list-kriteria-rasa',
            ],
            [
                'name' => 'create-kriteria-rasa',
            ],
            [
                'name' => 'edit-kriteria-rasa',
            ],
            [
                'name' => 'delete-kriteria-rasa',
            ],
            [
                'name' => 'list-kriteria-variasi-menu',
            ],
            [
                'name' => 'create-kriteriavariasi-menu',
            ],
            [
                'name' => 'edit-kriteria-variasi-menu',
            ],
            [
                'name' => 'delete-kriteria-variasi-menu',
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
