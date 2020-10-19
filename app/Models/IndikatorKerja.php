<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndikatorKerja extends Model
{
    use HasFactory;
    protected $table = 'indikator_kerjas';
    protected $fillable = [
        'kegiatan',
        'periode',
        'user_id',        
    ];

    public function user(){
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function uraianKegiatan(){
        return $this->hasOne(\App\Models\UraianKegiatan::class, 'id_indikator_kerjas');
    }
}
