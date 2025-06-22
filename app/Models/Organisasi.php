<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organisasi extends Model
{
    use HasFactory;
    protected $table = 'organisasi';
    protected $guarded = ['id'];
    public function kegiatan()
    {
        return $this->hasMany(Kegiatan::class);
    }

    public function anggota()
    {
        return $this->hasMany(Anggota::class);
    }
}
