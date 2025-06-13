<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class penilaian_sita extends Model
{
    use HasFactory;
    protected $table = 'penilaian_sitas';
    protected $guarded = ['id'];
}
