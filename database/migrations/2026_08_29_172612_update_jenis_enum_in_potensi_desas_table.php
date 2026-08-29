<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Perluas enum dulu, tampung value lama & baru sekaligus
        DB::statement("ALTER TABLE potensi_desas MODIFY jenis ENUM('ekonomi', 'umkm', 'wisata', 'kerajinan', 'kesenian') NOT NULL");

        // 2. Baru migrasikan data lama
        DB::table('potensi_desas')
            ->where('jenis', 'kerajinan')
            ->update(['jenis' => 'kesenian']);

        // 3. Ciutkan enum ke value final
        DB::statement("ALTER TABLE potensi_desas MODIFY jenis ENUM('ekonomi', 'umkm', 'wisata', 'kesenian') NOT NULL");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE potensi_desas MODIFY jenis ENUM('ekonomi', 'umkm', 'wisata', 'kerajinan', 'kesenian') NOT NULL");

        DB::table('potensi_desas')
            ->where('jenis', 'kesenian')
            ->update(['jenis' => 'kerajinan']);

        DB::statement("ALTER TABLE potensi_desas MODIFY jenis ENUM('ekonomi', 'umkm', 'wisata', 'kerajinan') NOT NULL");
    }
};