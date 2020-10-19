<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblMenu extends Model
{
    use HasFactory;
    protected $table = 'tbl_menu';

    protected $fillable = ['name', 'description', 'icon', 'type'];
}
