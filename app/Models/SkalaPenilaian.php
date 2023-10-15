<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkalaPenilaian extends Model
{
    use HasFactory;
    protected $table = 'skala_penilaian';
    protected $fillable = ['kategori_id', 'nilai', 'deskripsi', /* tambahkan atribut lain sesuai kebutuhan */];
}
