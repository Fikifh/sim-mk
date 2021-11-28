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
        'id_uraian_kegiatan',
        'ak_realisasi',        
        'qtt_realisasi', 
        'mutu_realisasi',
        'keterangan',
        'created_at',
        'updated_at'
    ];

    public function uraianKegiatan(){
        return $this->belongsTo(\App\Models\UraianKegiatan::class, 'id_uraian_kegiatan');
    }


    public function user(){
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public $timestamps = true;

}
