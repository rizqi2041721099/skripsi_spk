<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    public $guarded = [];
    public $table = 'restaurants';
    public $with = ['facilities','jarak','fasilitas','rasa','harga','variasiMenu'];

    public function alternatif()
    {
        return $this->hasMany(Alternatif::class);
    }

    public function facilities()
    {
        return $this->belongsToMany(Facility::class, 'restaurants_facilities');
    }

    public function jarak()
    {
        return $this->belongsTo(KriteriaJarak::class, 'kriteria_jarak_id');
    }

    public function harga()
    {
        return $this->belongsTo(KriteriaHarga::class, 'kriteria_harga_id');
    }

    public function variasiMenu()
    {
        return $this->belongsTo(KriteriaVariasiMenu::class, 'variasi_menu_id');
    }

    public function rasa()
    {
        return $this->belongsTo(KriteriaRasa::class, 'kriteria_rasa_id');
    }

    public function fasilitas()
    {
        return $this->belongsTo(KriteriaFasilitas::class,'kriteria_fasilitas_id');
    }

    public function comments(){
        return $this->hasMany(Comment::class)->whereNull('parent_id');
    }
}
