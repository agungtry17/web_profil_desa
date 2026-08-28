<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Perluas dulu enum supaya 'jumlah_kk' valid, tanpa hapus value lama
        DB::statement("ALTER TABLE statistik_penduduks MODIFY kategori ENUM('usia', 'pekerjaan', 'pendidikan', 'kesehatan', 'jumlah_penduduk', 'jumlah_kk') NOT NULL");

        // 2. Baru migrasikan data lama ke value baru
        DB::table('statistik_penduduks')
            ->whereIn('kategori', ['kesehatan', 'jumlah_penduduk'])
            ->update(['kategori' => 'jumlah_kk']);

        // 3. Persempit enum ke set final setelah data aman
        DB::statement("ALTER TABLE statistik_penduduks MODIFY kategori ENUM('usia', 'pekerjaan', 'pendidikan', 'jumlah_kk') NOT NULL");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE statistik_penduduks MODIFY kategori ENUM('usia', 'pekerjaan', 'pendidikan', 'kesehatan', 'jumlah_penduduk', 'jumlah_kk') NOT NULL");

        DB::table('statistik_penduduks')
            ->where('kategori', 'jumlah_kk')
            ->update(['kategori' => 'kesehatan']);

        DB::statement("ALTER TABLE statistik_penduduks MODIFY kategori ENUM('usia', 'pekerjaan', 'pendidikan', 'kesehatan') NOT NULL");
    }
};