<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class KriteriaJarak extends Model
{
    use HasFactory;

    public $guarded = [];

    public function restaurant()
    {
        return $this->hasMany(Restaurant::class);
    }

    public function alternatif()
    {
        return $this->hasMany(Alternatif::class);
    }
}
