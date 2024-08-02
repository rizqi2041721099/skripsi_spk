<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class AlternatifUser extends Model
{
    use HasFactory;

    public $guarded = [];
    public $table = 'alternatifs_users';
    public $with = ['jarak','jamOperasional','fasilitas','variasiMenu','harga'];

    public function jarak()
    {
        return $this->belongsTo(KriteriaJarak::class, 'v_jarak');
    }

    public function variasiMenu()
    {
        return $this->belongsTo(KriteriaVariasiMenu::class, 'v_variasi_makanan');
    }

    public function jamOperasional()
    {
        return $this->belongsTo(KategoriJamOperasional::class, 'v_jam_operasional');
    }

    public function fasilitas()
    {
        return $this->belongsTo(KriteriaFasilitas::class,'v_fasilitas');
    }

    public function harga()
    {
        return $this->belongsTo(KriteriaHarga::class,'v_harga_makanan');
    }
}
