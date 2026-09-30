<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    /**
     * Daftar Berita (dengan pagination)
     */
    public function index()
    {
        $berita = Berita::published()
            ->orderBy('tanggal', 'desc')
            ->paginate(9);

        return view('berita.index', compact('berita'));
    }

    /**
     * Detail Berita
     */
    public function show($slug)
    {
        // Cari berita berdasarkan slug (atau ID sebagai fallback)
        $berita = Berita::published()
            ->where(function($query) use ($slug) {
                $query->where('slug', $slug)
                      ->orWhere('id', $slug);
            })
            ->firstOrFail();

        // Berita lainnya (3 terbaru, exclude current)
        $beritaLain = Berita::published()
            ->where('id', '!=', $berita->id)
            ->orderBy('tanggal', 'desc')
            ->limit(3)
            ->get();

        return view('berita.show', compact('berita', 'beritaLain'));
    }
}
