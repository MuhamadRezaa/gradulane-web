<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sempro extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'sempros';
    protected $guarded = ['id'];

    public function tugasakhir()
    {
        return $this->belongsTo(TugasAkhir::class, 'tugasakhir_id');
    }

    public function pengujisempro()
    {
        return $this->belongsTo(Dosen::class, 'pengujisempro_id');
    }

    public function ruangansempro()
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_id');
    }

    public function sesisidang()
    {
        return $this->belongsTo(Sesi::class, 'sesi_id');
    }
}
