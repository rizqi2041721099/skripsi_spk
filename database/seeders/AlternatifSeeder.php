<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Alternatif;

class AlternatifSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'restaurant_id' => 1,
                'v_harga_makanan'   => 5,
                'v_jarak'   => 5,
                'v_fasilitas'   => 4,
                'v_jam_operasional'   => 4,
                'v_variasi_makanan'   => 1,
            ],
            [
                'restaurant_id' => 2,
                'v_harga_makanan'   => 5,
                'v_jarak'   => 5,
                'v_fasilitas'   => 3,
                'v_jam_operasional'   => 1,
                'v_variasi_makanan'   => 2,
            ],
            [
                'restaurant_id' => 3,
                'v_harga_makanan'   => 5,
                'v_jarak'   => 4,
                'v_fasilitas'   => 4,
                'v_jam_operasional'   => 4,
                'v_variasi_makanan'   => 2,
            ],
            [
                'restaurant_id' => 4,
                'v_harga_makanan'   => 5,
                'v_jarak'   => 4,
                'v_fasilitas'   => 4,
                'v_jam_operasional'   => 4,
                'v_variasi_makanan'   => 4,
            ],
            [
                'restaurant_id' => 5,
                'v_harga_makanan'   => 5,
                'v_jarak'   => 4,
                'v_fasilitas'   => 3,
                'v_jam_operasional'   => 2,
                'v_variasi_makanan'   => 3,
            ],
            [
                'restaurant_id' => 6,
                'v_harga_makanan'   => 5,
                'v_jarak'   => 3,
                'v_fasilitas'   => 4,
                'v_jam_operasional'   => 2,
                'v_variasi_makanan'   => 3,
            ],
            [
                'restaurant_id' => 8,
                'v_harga_makanan'   => 5,
                'v_jarak'   => 5,
                'v_fasilitas'   => 3,
                'v_jam_operasional'   => 2,
                'v_variasi_makanan'   => 2,
            ],
            [
                'restaurant_id' => 9,
                'v_harga_makanan'   => 5,
                'v_jarak'   => 4,
                'v_fasilitas'   => 4,
                'v_jam_operasional'   => 2,
                'v_variasi_makanan'   => 4,
            ],
            [
                'restaurant_id' => 10,
                'v_harga_makanan'   => 5,
                'v_jarak'   => 4,
                'v_fasilitas'   => 4,
                'v_jam_operasional'   => 2,
                'v_variasi_makanan'   => 3,
            ],
            [
                'restaurant_id' => 11,
                'v_harga_makanan'   => 5,
                'v_jarak'   => 3,
                'v_fasilitas'   => 4,
                'v_jam_operasional'   => 2,
                'v_variasi_makanan'   => 2,
            ],
            [
                'restaurant_id' => 12,
                'v_harga_makanan'   => 5,
                'v_jarak'   => 4,
                'v_fasilitas'   => 3,
                'v_jam_operasional'   => 2,
                'v_variasi_makanan'   => 1,
            ],
            [
                'restaurant_id' => 13,
                'v_harga_makanan'   => 3,
                'v_jarak'   => 5,
                'v_fasilitas'   => 3,
                'v_jam_operasional'   => 5,
                'v_variasi_makanan'   => 2,
            ],
            [
                'restaurant_id' => 14,
                'v_harga_makanan'   => 1,
                'v_jarak'   => 3,
                'v_fasilitas'   => 5,
                'v_jam_operasional'   => 5,
                'v_variasi_makanan'   => 1,
            ],
            [
                'restaurant_id' => 15,
                'v_harga_makanan'   => 5,
                'v_jarak'   => 5,
                'v_fasilitas'   => 3,
                'v_jam_operasional'   => 3,
                'v_variasi_makanan'   => 2,
            ],
            [
                'restaurant_id' => 16,
                'v_harga_makanan'   => 5,
                'v_jarak'   => 5,
                'v_fasilitas'   => 4,
                'v_jam_operasional'   => 2,
                'v_variasi_makanan'   => 2,
            ],
        ];

        Alternatif::insert($data);
    }
}
