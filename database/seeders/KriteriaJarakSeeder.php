<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KriteriaJarak;

class KriteriaJarakSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'value' => 5,
                'standard_value' => 'Sangat Dekat',
                'range_value' => 'X < 1 KM'
            ],
            [
                'value' => 4,
                'standard_value' => 'Dekat',
                'range_value' => ' 1 - 3 KM'
            ],
            [
                'value' => 3,
                'standard_value' => 'Cukup Dekat',
                'range_value' => '3 - 5 KM'
            ],
            [
                'value' => 2,
                'standard_value' => 'Jauh',
                'range_value' => '5 - 7 KM'
            ],
            [
                'value' => 1,
                'standard_value' => 'Sangat Jauh',
                'range_value' => ' > 7 KM'
            ],
        ];

        KriteriaJarak::insert($data);
    }
}
