<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TugasAkhir extends Model
{
    use HasFactory;
    protected $table = 'tugasakhirs';
    protected $guarded = ['id'];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }

    public function pembimbingta1()
    {
        return $this->belongsTo(Dosen::class, 'pembimbing1');
    }

    public function pembimbingta2()
    {
        return $this->belongsTo(Dosen::class, 'pembimbing2');
    }

    public function bimbingan()
    {
        return $this->hasMany(Bimbingan::class, 'tugasakhir_id');
    }

    public function sempro()
    {
        return $this->hasOne(Sempro::class, 'tugasakhir_id');
    }

    public function sitatugasakhir()
    {
        return $this->hasone(sita::class, 'id');
    }

    public function sesisidang()
    {
        return $this->belongsTo(Sesi::class, 'sesi_id');
    }
}
