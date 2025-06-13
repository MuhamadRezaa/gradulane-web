<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;
    public $table = 'mahasiswas';
    protected $guarded = ['id'];
    protected $fillable = [
        'namamhs',
        'nim',
        'kelas',
        'jeniskelamin',
        'email',
        'jurusan_id',
        'prodi_id',
        'foto',
    ];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'jurusan_id');
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id');
    }

    public function tugasakhir()
    {
        return $this->belongsTo(TugasAkhir::class, 'mahasiswa_id');
    }

    public function bimbingan()
    {
        return $this->belongsTo(Bimbingan::class, 'mahasiswa_id');
    }
}
