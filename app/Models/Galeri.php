<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    protected $fillable = ['judul', 'foto', 'kategori', 'tanggal'];

    protected $casts = [
        'tanggal' => 'date',
    ];
}