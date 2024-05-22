<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            PermissionSeeder::class,
            SuperAdminSeeder::class,
            KriteriaSeeder::class,
            KriteriaVariasiMenuSeeder::class,
            KriteriaJarakSeeder::class,
            KriteriaHargaSeeder::class,
            KriteriaRasaSeeder::class,
            KriteriaFasilitasSeeder::class,
            RestaurantSeeder::class,
            AlternatifSeeder::class,
            FasilitasSeeder::class,
            // FoodVariatiesSeeder::class,
        ]);
    }
}
