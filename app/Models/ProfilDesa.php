<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilDesa extends Model
{
    protected $fillable = [
        'nama_desa', 'slogan', 'sambutan', 'sejarah', 'visi', 'misi',
        'letak_geografis', 'batas_wilayah', 'nama_kepala_desa',
        'jumlah_penduduk', 'luas_wilayah', 'alamat_kantor', 'no_telepon',
        'email', 'latitude', 'longitude', 'foto_banner', 'logo',
    ];
}