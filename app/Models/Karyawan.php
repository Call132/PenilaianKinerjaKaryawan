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
    public function penilaian()
    {
        return $this->hasMany(Penilaian::class);
    }
    
}
