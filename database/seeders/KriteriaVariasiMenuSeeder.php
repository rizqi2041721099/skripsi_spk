<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KriteriaVariasiMenu;

class KriteriaVariasiMenuSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'value' => 5,
                'standard_value' => 'Sangat Beragam',
                'range_value'   => '> 20',
            ],
            [
                'value' => 4,
                'standard_value' => 'Beragam',
                'range_value'   => '15 - 20',
            ],
            [
                'value' => 3,
                'standard_value' => 'Cukup',
                'range_value'   => '10 - 15',
            ],
            [
                'value' => 2,
                'standard_value' => 'Kurang Beragam',
                'range_value'   => '5 - 10',
            ],
            [
                'value' => 1,
                'standard_value' => 'Sangat Kurang Beragam',
                'range_value'   => '< 5',
            ],
        ];

        KriteriaVariasiMenu::insert($data);
    }
}
