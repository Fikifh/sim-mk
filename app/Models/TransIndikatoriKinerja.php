<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransIndikatoriKinerja extends Model
{
    use HasFactory;
    protected $table = 'trans_indikator_kinerjas';
    protected $fillable = [
        'users_id',
        'id_indikator_kerjas',
        'ak_realisasi',        
        'qtt_realisasi', 
        'mutu_realisasi',
        'created_at',
        'updated_at'
    ];

    public function indikatorKerja(){
        return $this->belongsTo(\App\Models\IndikatorKerja::class, 'id_indikator_kerjas');
    }


    public function user(){
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}
