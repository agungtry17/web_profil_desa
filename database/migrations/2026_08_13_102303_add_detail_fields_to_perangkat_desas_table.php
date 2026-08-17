<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('perangkat_desas', function (Blueprint $table) {
            $table->text('biografi')->nullable()->after('foto');
            $table->string('email')->nullable()->after('no_hp');
            $table->string('linkedin')->nullable()->after('email');
            $table->string('tahun_menjabat')->nullable()->after('linkedin');
            $table->text('riwayat_karir')->nullable()->after('tahun_menjabat');
        });
    }

    public function down(): void
    {
        Schema::table('perangkat_desas', function (Blueprint $table) {
            $table->dropColumn(['biografi', 'email', 'linkedin', 'tahun_menjabat', 'riwayat_karir']);
        });
    }
};