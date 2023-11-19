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
        'periode_penilaian',
        'karyawan_id',
        
    ];
    use HasFactory;

    public function hasilPenilaian()
    {
        return $this->hasMany(hasilPenilaian::class);
    }

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }
}
