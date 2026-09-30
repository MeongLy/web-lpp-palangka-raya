<?php

namespace App\Http\Controllers;

use App\Models\Pejabat;
use App\Models\Profil;
use App\Models\Struktur;

class ProfilController extends Controller
{
    /**
     * Halaman Pejabat
     */
    public function pejabat()
    {
        $pejabat = Pejabat::active()->ordered()->get();
        return view('profil.pejabat', compact('pejabat'));
    }

    /**
     * Halaman Struktur Organisasi
     */
    public function struktur()
    {
        $struktur = Struktur::active()->ordered()->get();
        return view('profil.struktur', compact('struktur'));
    }

    /**
     * Halaman SI-Talawang
     */
    public function sitalawang()
    {
        return view('layanan.sitalawang');
    }

    /**
     * Halaman Hasil Survei
     */
    public function hasilSurvei()
    {
        return view('layanan.hasil-survei');
    }

    /**
     * Halaman Sejarah
     */
    public function sejarah()
    {
        $profil = Profil::first();
        return view('profil.sejarah', compact('profil'));
    }

    /**
     * Halaman Visi & Misi
     */
    public function visiMisi()
    {
        $profil = Profil::first();
        return view('profil.visi-misi', compact('profil'));
    }

    /**
     * Halaman Tugas Pokok & Fungsi
     */
    public function tupoksi()
    {
        $profil = Profil::first();
        return view('profil.tupoksi', compact('profil'));
    }
}
