<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;
    protected $table = 'ruangans';
    protected $primarykey = 'id';
    protected $fillable = ['koderuangan', 'namaruangan'];

    public function ruangansempro()
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_id');
    }

    public function ruangansita()
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_id');
    }
}
