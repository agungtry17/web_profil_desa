<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PotensiDesa extends Model
{
    protected $fillable = ['nama', 'jenis', 'deskripsi', 'foto', 'kontak', 'lokasi'];
}