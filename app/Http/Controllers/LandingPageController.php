<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Layanan;
use App\Models\Pengaturan;
use App\Models\Profil;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        // ===== PROFIL =====
        $profil = Profil::first();

        // ===== BERITA (3 terbaru) =====
        $berita = Berita::published()->latest()->limit(3)->get();

        // ===== GALERI (5 terbaru untuk landing) =====
        // Selalu tampil barang terbaru, tanpa peduli urutan
        $galeri = Galeri::active()
            ->latest('created_at')
            ->limit(5)
            ->get();

        // Total galeri aktif (untuk tombol "Lihat Lebih Banyak")
        $galeriTotal = Galeri::active()->count();

        // ===== LAYANAN =====
        $layanan = Layanan::active()->ordered()->get();

        // ===== PENGATURAN =====
        $pengaturan = Pengaturan::getGroup('kontak');

        return view('landing.index', compact(
            'profil',
            'berita',
            'galeri',
            'galeriTotal',
            'layanan',
            'pengaturan'
        ));
    }
}
