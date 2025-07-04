<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;
    protected $table = 'jabatans';
    protected $primaryKey = 'id_jabatan';
    protected $fillable = ['namajabatan'];

    public function dosen()
    {
        return $this->hasMany(Jabatan::class, 'jabatan_id');
    }
}
