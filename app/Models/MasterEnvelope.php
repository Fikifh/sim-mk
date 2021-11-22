<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterEnvelope extends Model
{
    use HasFactory;

    protected $table = 'master_envelopes';
    protected $fillable = ['name', 'description'];
}
