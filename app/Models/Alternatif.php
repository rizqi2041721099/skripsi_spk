<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Alternatif extends Model
{
    use HasFactory;

    public $guarded = [];
    public $with = ['restaurant'];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
