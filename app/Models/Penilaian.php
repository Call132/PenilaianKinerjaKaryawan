<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class penilaian extends Model
{
    protected $table = 'penilaian';

    protected $fillable = [
        'tanggal_penilaian',
        'tujuan',
        'tahun',
        'periode',
        'karyawan_id',

    ];
    use HasFactory;

    public function hasilPenilaian()
    {
        return $this->hasMany(hasilPenilaian::class, 'penilaian_id', 'id');
    }
    

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'karyawan_id', 'id');
    }
}
