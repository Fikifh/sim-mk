<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SasaranKegiatan extends Model
{
    use HasFactory;
    protected $table = 'sasaran_kegiatan';
    protected $fillable = ['nama', 'created_by'];

    public function indikatorKerjas(){
        return $this->hasMany(\App\Models\IndikatorKerja::class, 'sasaran_kegiatan_id');
    }

    public $timestamps = true;
}
