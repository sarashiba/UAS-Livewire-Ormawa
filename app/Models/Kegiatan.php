<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;
    protected $table = 'kegiatan'; 
    protected $guarded = ['id']; 

    public function organisasi()
    {
        return $this->belongsTo(Organisasi::class);
    }

    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class);
    }

    public function kepanitiaan()
    {
        return $this->hasMany(Kepanitiaan::class);
    }
}