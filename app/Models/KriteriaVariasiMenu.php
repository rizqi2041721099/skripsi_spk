<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class KriteriaVariasiMenu extends Model
{
    use HasFactory;

    public $guarded = ['id'];
    public $table = 'kriteria_variasi_menus';

    public function restaurant()
    {
        return $this->hasMany(Restaurant::class);
    }
}
