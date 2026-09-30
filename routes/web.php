<?php

use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\Admin\PengumumanController as AdminPengumumanController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfilController as AdminProfilController;
use App\Http\Controllers\Admin\PejabatController;
use App\Http\Controllers\Admin\StrukturController;
use App\Http\Controllers\Admin\BeritaController as AdminBeritaController;
use App\Http\Controllers\Admin\GaleriController as AdminGaleriController;
use App\Http\Controllers\Admin\LayananController;
use App\Http\Controllers\Admin\SitalawangController;
use App\Http\Controllers\Admin\SurveiController;
use App\Http\Controllers\Admin\PengaturanController;
use Illuminate\Support\Facades\Route;

// ========================================
// ROUTE AUTH
// ========================================
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// ========================================
// ROUTE LANDING PAGE
// ========================================
Route::get('/', [LandingPageController::class, 'index'])->name('home');

// ========================================
// ROUTE PROFIL PUBLIK
// ========================================
Route::get('/pejabat', [ProfilController::class, 'pejabat'])->name('pejabat');
Route::get('/struktur', [ProfilController::class, 'struktur'])->name('struktur');

// ========================================
// ROUTE LAYANAN PUBLIK
// ========================================
Route::get('/layanan/sitalawang', [ProfilController::class, 'sitalawang'])->name('layanan.sitalawang');
Route::get('/layanan/hasil-survei', [ProfilController::class, 'hasilSurvei'])->name('layanan.survei');

// ========================================
// ROUTE BERITA PUBLIK
// ========================================
Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('berita.detail');

// ========================================
// ROUTE GALERI PUBLIK
// ========================================
Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri.index');
Route::get('/galeri/search', [GaleriController::class, 'search'])->name('galeri.search');
Route::get('/galeri/{slug}', [GaleriController::class, 'show'])->name('galeri.detail');

// ========================================
// ROUTE PENGUMUMAN PUBLIK
// ========================================
Route::get('/pengumuman/popup', [PengumumanController::class, 'popup'])->name('pengumuman.popup');
Route::get('/pengumuman/banner', [PengumumanController::class, 'banner'])->name('pengumuman.banner');
Route::get('/pengumuman/{slug}', [PengumumanController::class, 'show'])->name('pengumuman.detail');

// ========================================
// ROUTE ADMIN
// ========================================
Route::prefix('admin')->name('admin.')->middleware(['admin'])->group(function () {

    // ===== DASHBOARD =====
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // ===== PROFIL (Manual - tanpa parameter) =====
    Route::get('/profil', [AdminProfilController::class, 'index'])->name('profil.index');
    Route::get('/profil/edit', [AdminProfilController::class, 'edit'])->name('profil.edit');
    Route::put('/profil', [AdminProfilController::class, 'update'])->name('profil.update');

    // ===== PEJABAT (Resource) =====
    Route::resource('pejabat', PejabatController::class);

    // ===== STRUKTUR ORGANISASI (Manual - single image, tanpa parameter) =====
    Route::get('/struktur', [StrukturController::class, 'index'])->name('struktur.index');
    Route::get('/struktur/create', [StrukturController::class, 'create'])->name('struktur.create');
    Route::post('/struktur', [StrukturController::class, 'store'])->name('struktur.store');
    Route::get('/struktur/edit', [StrukturController::class, 'edit'])->name('struktur.edit');
    Route::put('/struktur', [StrukturController::class, 'update'])->name('struktur.update');
    Route::delete('/struktur', [StrukturController::class, 'destroy'])->name('struktur.destroy');

    // ===== BERITA (Resource) =====
    Route::resource('berita', AdminBeritaController::class);

    // ===== PENGUMUMAN (Resource) =====
    Route::resource('pengumuman', AdminPengumumanController::class);

    // ===== GALERI (Resource) =====
    Route::resource('galeri', AdminGaleriController::class);

    // ===== LAYANAN (Resource) =====
    Route::resource('layanan', LayananController::class);

    // ===== SI-TALAWANG (Manual - tanpa parameter) =====
    Route::get('/sitalawang', [SitalawangController::class, 'index'])->name('sitalawang.index');
    Route::get('/sitalawang/edit', [SitalawangController::class, 'edit'])->name('sitalawang.edit');
    Route::put('/sitalawang', [SitalawangController::class, 'update'])->name('sitalawang.update');

    // ===== HASIL SURVEI (Manual - tanpa parameter) =====
    Route::get('/survei', [SurveiController::class, 'index'])->name('survei.index');
    Route::get('/survei/edit', [SurveiController::class, 'edit'])->name('survei.edit');
    Route::put('/survei', [SurveiController::class, 'update'])->name('survei.update');

    // ===== PENGATURAN (Manual - tanpa parameter) =====
    Route::get('/pengaturan', [PengaturanController::class, 'index'])->name('pengaturan.index');
    Route::post('/pengaturan', [PengaturanController::class, 'update'])->name('pengaturan.update');
});
