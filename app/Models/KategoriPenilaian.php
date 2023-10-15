<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriPenilaian extends Model
{
    protected $table = 'kategori_penilaian';
    protected $fillable = ['nama_kategori', /* tambahkan atribut lain sesuai kebutuhan */];

    public function skalaPenilaian()
    {
        return $this->hasMany(SkalaPenilaian::class, 'kategori_id');
    }

    use HasFactory;
}
