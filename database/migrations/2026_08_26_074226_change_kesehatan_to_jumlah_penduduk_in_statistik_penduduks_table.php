<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Perluas enum dulu, biar 'kesehatan' dan 'jumlah_penduduk' sama-sama valid sementara
        DB::statement("ALTER TABLE statistik_penduduks MODIFY kategori ENUM('usia', 'pekerjaan', 'pendidikan', 'kesehatan', 'jumlah_penduduk') NOT NULL");

        // 2. Update data lama
        DB::table('statistik_penduduks')->where('kategori', 'kesehatan')->update(['kategori' => 'jumlah_penduduk']);

        // 3. Persempit lagi enumnya, buang 'kesehatan'
        DB::statement("ALTER TABLE statistik_penduduks MODIFY kategori ENUM('usia', 'pekerjaan', 'pendidikan', 'jumlah_penduduk') NOT NULL");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE statistik_penduduks MODIFY kategori ENUM('usia', 'pekerjaan', 'pendidikan', 'kesehatan', 'jumlah_penduduk') NOT NULL");
        DB::table('statistik_penduduks')->where('kategori', 'jumlah_penduduk')->update(['kategori' => 'kesehatan']);
        DB::statement("ALTER TABLE statistik_penduduks MODIFY kategori ENUM('usia', 'pekerjaan', 'pendidikan', 'kesehatan') NOT NULL");
    }
};