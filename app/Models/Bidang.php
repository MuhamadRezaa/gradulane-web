<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bidang extends Model
{
    use HasFactory;

    protected $table = 'bidangs';
    protected $guarded = ['id'];

    public function dosens()
    {
        return $this->belongsToMany(Dosen::class, 'bidangdosens', 'bidang_id', 'dosen_id');
    }
}
