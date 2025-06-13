<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;
    protected $table = 'dosens';
    protected $guarded = ['id'];
    protected $fillable = [
        'namadosen',
        'nidn',
        'nip',
        'tmpt_tgl_lahir',
        'tgl_lahir',
        'jeniskelamin',
        'email',
        'no_hp',
        'alamat',
        'jurusan_id',
        'prodi_id',
        'jabatan_id',
        'jabatanfungsional_id',
        'foto',
    ];

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'jabatan_id');
    }

    public function jabatanfungsional()
    {
        return $this->belongsTo(Jabatanfungsional::class, 'jabatanfungsional_id');
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'jurusan_id');
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id');
    }

    public function pembimbingta1()
    {
        return $this->hasOne(TugasAkhir::class, 'pembimbing1');
    }

    public function pembimbingta2()
    {
        return $this->hasOne(TugasAkhir::class, 'pembimbing2');
    }

    public function bidangs()
    {
        return $this->belongsToMany(Bidang::class, 'bidangdosens', 'dosen_id', 'bidang_id');
    }

    public function bimbingan()
    {
        return $this->belongsTo(Bimbingan::class, 'pembimbing_id');
    }

    public function pengujisempro()
    {
        return $this->hasOne(Sempro::class, 'pengujisempro_id');
    }

    public function ketuasita()
    {
        return $this->hasmany(sita::class, 'id');
    }
    public function sekretarissita()
    {
        return $this->hasmany(sita::class, 'id');
    }

    public function penguji1sita()
    {
        return $this->hasmany(sita::class, 'id');
    }

    public function penguji2sita()
    {
        return $this->hasmany(sita::class, 'id');
    }
}
