<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sesi extends Model
{
    use HasFactory;
    protected $table = 'sesis';
    protected $guarded = ['id'];

    public function sempro()
    {
        return $this->hasMany(Sempro::class, 'sesi_id');
    }

    public function tugasakhir()
    {
        return $this->hasMany(TugasAkhir::class, 'sesi_id');
    }

    public function sita()
    {
        return $this->hasMany(TugasAkhir::class, 'sesi_id');
    }
}
