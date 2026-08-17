<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dusun extends Model
{
    protected $fillable = ['nama_dusun', 'deskripsi'];

    public function statistikPenduduk()
    {
        return $this->hasMany(StatistikPenduduk::class);
    }
}