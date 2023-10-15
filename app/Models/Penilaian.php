<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    protected $table = 'penilaian';
    protected $fillable = [
        'karyawan_id',
        'kategori_id',
        'skor',
        'tanggal_penilaian', /* tambahkan atribut lain sesuai kebutuhan */
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'karyawan_id');
    }

    public function kategoriPenilaian()
    {
        return $this->belongsTo(KategoriPenilaian::class, 'kategori_id');
    }

    use HasFactory;
}
