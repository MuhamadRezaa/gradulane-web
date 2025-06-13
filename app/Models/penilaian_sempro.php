<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class penilaian_sempro extends Model
{
    use HasFactory;
    protected $table = 'penilaian_sempros';
    protected $guarded = ['id'];
}
