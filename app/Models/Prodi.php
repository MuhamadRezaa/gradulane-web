<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    use HasFactory;

    protected $table = 'prodis';
    protected $primaryKey = 'id_prodi';
    protected $fillable = ['jurusan_id', 'namajenjang', 'namaprodi'];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'jurusan_id');
    }

    public function mahasiswas()
    {
        return $this->hasMany(Mahasiswa::class, 'prodi_id');
    }

    public function dosen()
    {
        return $this->hasMany(Dosen::class, 'prodi_id');
    }

    public function staff()
    {
        return $this->hasMany(Staff::class, 'prodi_id');
    }
}
