<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\Admin\GaleriController;
use App\Http\Controllers\Admin\PerangkatDesaController;
use App\Http\Controllers\Admin\DusunController;
use App\Http\Controllers\Admin\StatistikPendudukController;
use App\Http\Controllers\Admin\PotensiDesaController;
use App\Http\Controllers\Admin\LayananPublikController;
use App\Http\Controllers\Admin\PesanKontakController;
use App\Http\Controllers\Admin\ProfilDesaController;

Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/profil', [PublicController::class, 'profil'])->name('profil');
Route::get('/statistik', [PublicController::class, 'statistik'])->name('statistik');
Route::get('/potensi', [PublicController::class, 'potensi'])->name('potensi');
Route::get('/berita', [PublicController::class, 'berita'])->name('berita');
Route::get('/berita/{berita:slug}', [PublicController::class, 'beritaDetail'])->name('berita.show');
Route::get('/layanan', [PublicController::class, 'layanan'])->name('layanan');
Route::get('/galeri', [PublicController::class, 'galeri'])->name('galeri');
Route::get('/kontak', [PublicController::class, 'kontak'])->name('kontak');
Route::post('/kontak', [PublicController::class, 'kontakStore'])->name('kontak.store');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('berita', BeritaController::class)->parameters(['berita' => 'berita']);
    Route::resource('galeri', GaleriController::class);
    Route::resource('perangkat', PerangkatDesaController::class);
    Route::resource('dusun', DusunController::class);
    Route::resource('statistik', StatistikPendudukController::class);
    Route::resource('potensi', PotensiDesaController::class);
    Route::resource('layanan', LayananPublikController::class);
    Route::resource('pesan', PesanKontakController::class)->only(['index', 'show', 'destroy']);
    Route::get('profil-desa', [ProfilDesaController::class, 'edit'])->name('profil-desa.edit');
    Route::put('profil-desa', [ProfilDesaController::class, 'update'])->name('profil-desa.update');
});

require __DIR__.'/auth.php';