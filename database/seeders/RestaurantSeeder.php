<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Restaurant;

class RestaurantSeeder extends Seeder
{
    public function run()
    {
       $data = [
            [
                'name' => 'Tacibay',
                'address' => 'Belakang Polinema',
                'distance'  => 2,
                'images'   => null,
                'facility'  => 'Toilet, Musholla',
                'qty_variasi_makanan' => 20,
                'average' => 2,
            ],
            [
                'name' => 'Dapur Sedep',
                'address' => 'Belakang Polinema',
                'distance'  => 2,
                'images'   => null,
                'facility'  => 'Toilet, Musholla',
                'qty_variasi_makanan' => 20,
                'average' => 2,
            ],
            [
                'name' => 'Lalapan Tosa',
                'address' => 'Belakang Polinema',
                'distance'  => 2,
                'images'   => null,
                'facility'  => 'Toilet, Musholla',
                'qty_variasi_makanan' => 20,
                'average' => 2,
            ],
            [
                'name' => 'Warung Mama',
                'address' => 'Belakang Polinema',
                'distance'  => 2,
                'images'   => null,
                'facility'  => 'Toilet, Musholla',
                'qty_variasi_makanan' => 20,
                'average' => 2,
            ],
            [
                'name' => 'Ayam Penyet Banyuangi',
                'address' => 'Belakang Polinema',
                'distance'  => 2,
                'images'   => null,
                'facility'  => 'Toilet, Musholla',
                'qty_variasi_makanan' => 20,
                'average' => 2,
            ],
            [
                'name' => 'Rawon Cak Wott',
                'address' => 'Belakang Polinema',
                'distance'  => 2,
                'images'   => null,
                'facility'  => 'Toilet, Musholla',
                'qty_variasi_makanan' => 20,
                'average' => 2,
            ],
            [
                'name' => 'Warung EWK Lapapan Aneka Sambel',
                'address' => 'Belakang Polinema',
                'distance'  => 2,
                'images'   => null,
                'facility'  => 'Toilet, Musholla',
                'qty_variasi_makanan' => 20,
                'average' => 2,
            ],
            [
                'name' => 'Kedai Makcik',
                'address' => 'Belakang Polinema',
                'distance'  => 2,
                'images'   => null,
                'facility'  => 'Toilet, Musholla',
                'qty_variasi_makanan' => 20,
                'average' => 2,
            ],
            [
                'name' => 'Lalapan Ayam Qodir',
                'address' => 'Belakang Polinema',
                'distance'  => 2,
                'images'   => null,
                'facility'  => 'Toilet, Musholla',
                'qty_variasi_makanan' => 20,
                'average' => 2,
            ],
            [
                'name' => 'Warung Ijo',
                'address' => 'Belakang Polinema',
                'distance'  => 2,
                'images'   => null,
                'facility'  => 'Toilet, Musholla',
                'qty_variasi_makanan' => 20,
                'average' => 2,
            ],
            [
                'name' => 'Warung Geprek Ragil',
                'address' => 'Belakang Polinema',
                'distance'  => 2,
                'images'   => null,
                'facility'  => 'Toilet, Musholla',
                'qty_variasi_makanan' => 20,
                'average' => 2,
            ],
            [
                'name' => 'Ayam Goreng Nelongso',
                'address' => 'Belakang Polinema',
                'distance'  => 2,
                'images'   => null,
                'facility'  => 'Toilet, Musholla',
                'qty_variasi_makanan' => 20,
                'average' => 2,
            ],
            [
                'name' => 'Soto Ayam Cak Man',
                'address' => 'Belakang Polinema',
                'distance'  => 2,
                'images'   => null,
                'facility'  => 'Toilet, Musholla',
                'qty_variasi_makanan' => 20,
                'average' => 2,
            ],
            [
                'name' => 'Warung Soto Madura Cak Mad',
                'address' => 'Belakang Polinema',
                'distance'  => 2,
                'images'   => null,
                'facility'  => 'Toilet, Musholla',
                'qty_variasi_makanan' => 20,
                'average' => 2,
            ],
            [
                'name' => 'Warung Makan & Kopi "Tegar"',
                'address' => 'Belakang Polinema',
                'distance'  => 2,
                'images'   => null,
                'facility'  => 'Toilet, Musholla',
                'qty_variasi_makanan' => 20,
                'average' => 2,
            ],
        ];

        Restaurant::insert($data);
    }
}
