<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FoodVariaty;

class FoodVariatiesSeeder extends Seeder
{
    public function run()
    {
       $data = [
            ['name' => 'Es Teh'],
            ['name' => 'Mie Ayam'],
            ['name' => 'Sate Sapi'],
            ['name' => 'Sate Ayam'],
            ['name' => 'Nasi Pecel'],
            ['name' => 'Air Putih'],
            ['name' => 'Nasi'],
            ['name' => 'Ayam Penyet'],
            ['name' => 'Lalapan Ayam'],
            ['name' => 'Lalapan Bebek'],
            ['name' => 'Nasi Rawon'],
            ['name' => 'Ayam Geprek'],
            ['name' => 'Ayam Goreng'],
            ['name' => 'Soto Ayam'],
            ['name' => 'Soto Madura'],
       ];

       FoodVariaty::insert($data);
    }
}
