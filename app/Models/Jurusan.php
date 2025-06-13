<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;

    protected $table = 'jurusans';
    protected $guarded = [
        'id'
    ];
    protected $keytype = 'String';

    public function prodi()
    {
        return $this->hasMany(Prodi::class, 'jurusan_id');
    }

    public function mahasiswas()
    {
        return $this->hasMany(Mahasiswa::class, 'jurusan_id');
    }

    public function dosen()
    {
        return $this->hasMany(Dosen::class, 'jurusan_id');
    }

    public function staff()
    {
        return $this->hasMany(Staff::class, 'jurusan_id');
    }
}
