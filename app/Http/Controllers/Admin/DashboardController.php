<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\PerangkatDesa;
use App\Models\PotensiDesa;
use App\Models\Galeri;
use App\Models\PesanKontak;
use App\Models\Dusun;
use App\Models\StatistikPenduduk;
use App\Models\ProfilDesa;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'berita' => Berita::count(),
            'perangkat' => PerangkatDesa::count(),
            'potensi' => PotensiDesa::count(),
            'galeri' => Galeri::count(),
            'pesan_baru' => PesanKontak::where('status', 'baru')->count(),
        ];

        $beritaTerbaru = Berita::latest('tanggal_publish')->take(5)->get();
        $pesanTerbaru = PesanKontak::latest()->take(5)->get();

        $profil = ProfilDesa::first();
        $pengingat = [];

        if (!$profil) {
            $pengingat[] = 'Profil Desa belum diisi sama sekali.';
        } else {
            if (!$profil->foto_banner) $pengingat[] = 'Foto banner Profil Desa belum diupload.';
            if (!$profil->logo) $pengingat[] = 'Logo desa belum diupload.';
            if (!$profil->sambutan) $pengingat[] = 'Sambutan Kepala Desa belum diisi.';
        }

        if (Dusun::count() === 0) $pengingat[] = 'Belum ada data Dusun.';
        if (StatistikPenduduk::count() === 0) $pengingat[] = 'Belum ada data Statistik Penduduk.';
        if (PerangkatDesa::count() === 0) $pengingat[] = 'Belum ada data Perangkat Desa.';

        return view('admin.dashboard', compact('stats', 'beritaTerbaru', 'pesanTerbaru', 'pengingat'));
    }
}