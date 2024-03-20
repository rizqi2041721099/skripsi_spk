<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory;

    public $guarded = [];
    public $table = 'facilities';

    public function restaurants()
    {
        return $this->belongsToMany(Restaurant::class, 'restaurants_facilities');
    }
}
