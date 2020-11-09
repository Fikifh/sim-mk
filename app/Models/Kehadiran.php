<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kehadiran extends Model
{
    use HasFactory;

    protected $table = 'kehadirans';
    protected $fillable = ['users_id', 'nilai', 'bulan'];
    protected $dates = ['created_at', 'updated_at'];
}
