<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hasilPenilaian extends Model
{
    use HasFactory;
    protected $table = 'hasil_penilaian';
    protected $fillable = [
        'penilaian_id',
        'kriteria_id',
        'karyawan_id',
        'skor',
        'komentar',
        'skor_normalisasi',
        'nilai_akhir',
    ];
    public function kriteria()
    {
        return $this->belongsTo(kriteria::class);
    }
    public function karyawan(){
        return $this->belongsTo(Karyawan::class, 'karyawan_id', 'id');
    }
}
