<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Anggota extends Model
{
    use HasFactory;
    protected $table = 'anggota';
    protected $guarded = ['id'];

    public function organisasi()
    {
        return $this->belongsTo(Organisasi::class);
    }
    public function kepanitiaan(): HasMany
    {
        return $this->hasMany(Kepanitiaan::class);
    }
}