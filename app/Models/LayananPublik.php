<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LayananPublik extends Model
{
    protected $fillable = [
        'nama_layanan', 'syarat', 'alur_pengurusan', 'estimasi_waktu', 'biaya',
    ];
}