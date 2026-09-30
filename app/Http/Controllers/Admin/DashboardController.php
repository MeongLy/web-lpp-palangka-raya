<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Layanan;
use App\Models\Pejabat;
use App\Models\Pengumuman;  // ← tambah

class DashboardController extends Controller
{
    public function index()
    {
        // ===== STATISTIK =====
        $totalPejabat    = Pejabat::count();
        $totalBerita     = Berita::count();
        $totalGaleri     = Galeri::count();
        $totalLayanan    = Layanan::count();

        // ===== PENGUMUMAN (BARU) =====
        $totalPengumuman       = Pengumuman::count();
        $totalPengumumanAktif  = Pengumuman::active()->tayang()->count();

        // ===== BERITA TERBARU =====
        $beritaTerbaru = Berita::latest()->limit(5)->get();

        // ===== PENGUMUMAN AKTIF (untuk widget) =====
        $pengumumanAktif = Pengumuman::active()
            ->tayang()
            ->prioritas()
            ->limit(6)
            ->get();

        return view('admin.dashboard', compact(
            'totalPejabat',
            'totalBerita',
            'totalGaleri',
            'totalLayanan',
            'totalPengumuman',
            'totalPengumumanAktif',
            'beritaTerbaru',
            'pengumumanAktif'
        ));
    }
}
