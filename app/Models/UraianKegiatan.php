<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UraianKegiatan extends Model
{
    use HasFactory;
    protected $table = 'uraian_kegiatans';
    protected $fillable = [
        'id_indikator_kerjas',
        'uraian_kegiatan',
        'ak_target',        
        'qtt_target', 
        'mutu_target',
        'ak_realisasi',        
        'qty_realisasi', 
        'mutu_realisasi',
        'created_at',
        'updated_at'
    ];


    public function indikatorKerja(){
        return $this->belongsTo(\App\Models\IndikatorKerja::class, 'id_indikator_kerjas');
    }

    public function transIndikator(){
        return $this->hasOne(\App\Models\TransIndikatoriKinerja::class, 'id_uraian_kegiatan');
    }
}
