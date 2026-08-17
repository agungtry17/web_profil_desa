<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $fillable = [
        'judul', 'slug', 'konten', 'foto', 'kategori', 'tanggal_publish', 'penulis_id',
    ];

    protected $casts = [
        'tanggal_publish' => 'date',
    ];

    public function penulis()
    {
        return $this->belongsTo(User::class, 'penulis_id');
    }
}