<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatanfungsional extends Model
{
    use HasFactory;
    protected $table = 'jabatanfungsionals';
    protected $primaryKey = 'id';
    protected $fillable = ['jabatanfungsional'];

    public function dosen()
    {
        return $this->hasMany(Jabatan::class, 'jabatanfungsional_id');
    }
}
