<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class IndikatorKerja extends Model
{
    use HasFactory;
    protected $table = 'indikator_kerjas';
    protected $fillable = [
        'kegiatan',
        'periode',
        'users_id',        
        'created_by'
    ];

    public function admin(){
        return $this->belongsTo(\App\Models\User::class, 'created_by');
    }

    public function pegawai(){
        return $this->belongsTo(\App\Models\User::class, 'users_id');
    }

    public function uraianKegiatan(){
        return $this->hasMany(\App\Models\UraianKegiatan::class, 'id_indikator_kerjas');
    }   
}
