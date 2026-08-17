<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatistikPenduduk extends Model
{
    protected $fillable = [
        'dusun_id', 'kategori', 'label', 'jumlah_laki', 'jumlah_perempuan', 'tahun',
    ];

    public function dusun()
    {
        return $this->belongsTo(Dusun::class);
    }
}