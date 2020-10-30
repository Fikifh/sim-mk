<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiCapaian extends Model
{
    use HasFactory;
    protected $table = 'nilai_capaians';
    protected $fillable = ['nilai_angka_min', 'nilai_angka', 'nilai_text'];
}
