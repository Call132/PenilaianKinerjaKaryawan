<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kriteria extends Model
{
  protected $table = 'kriteria';
  protected $fillable = [
    'kriteria',
    'bobot',



  ];


  use HasFactory;
}
