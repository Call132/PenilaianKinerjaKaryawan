<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $table = 'karyawan'; // Nama tabel dalam database

    protected $fillable = [
        'department',
        'posisi',
        'name',
        'tanggal_lahir',
        'no_hp',
        'joining_date',
        'status',
    ];
    public function sudahDinilai($periode, $tahun)
    {
        return $this->penilaian()
            ->where('periode', $periode)
            ->whereYear('tanggal_penilaian', $tahun)
            ->exists();
    }
    public function penilaian()
    {
        return $this->hasMany(Penilaian::class, 'karyawan_id', 'id');
    }
    public function hasilPenilaian()
    {
        return $this->hasMany(hasilPenilaian::class, 'karyawan_id', 'id');
    }
}
