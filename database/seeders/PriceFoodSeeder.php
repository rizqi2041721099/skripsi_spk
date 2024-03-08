<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PriceFood;

class PriceFoodSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'standar_name' => 'Murah',
                'range_price' => 'Rp. 2.000,00 - Rp. 15.000,00',
            ],
            [
                'standar_name' => 'Normal',
                'range_price' => 'Rp. 15.000,00 - Rp. 25.000,00',
            ],
            [
                'standar_name' => 'Mahal',
                'range_price' => '> Rp.25.000,00'
            ]
        ];

        PriceFood::insert($data);
    }
}
