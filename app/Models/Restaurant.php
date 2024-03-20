<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    public $guarded = [];
    public $table = 'restaurants';
    public $with = ['facilities'];

    public function alternatif()
    {
        return $this->hasMany(Alternatif::class);
    }

    public function facilities()
    {
        return $this->belongsToMany(Facility::class, 'restaurants_facilities');
    }
}
