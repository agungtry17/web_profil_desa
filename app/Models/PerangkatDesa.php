<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerangkatDesa extends Model
{
    protected $fillable = [
    'nama', 'jabatan', 'foto', 'no_hp', 'urutan',
    'biografi', 'email', 'linkedin', 'tahun_menjabat', 'riwayat_karir',
    ];
}