<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kepanitiaan extends Model
{
    use HasFactory;
    protected $table = 'kepanitiaan';
    protected $guarded = ['id'];

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class);
    }

    public function anggota()
    {
        return $this->belongsTo(Anggota::class);
    }
}