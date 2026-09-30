<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    /**
     * Halaman semua galeri (dengan search, filter & pagination).
     */
    public function index(Request $request)
    {
        $query = Galeri::query()->active();

        // ===== SEARCH =====
        if ($request->filled('q')) {
            $keyword = $request->q;
            $query->where(function ($q) use ($keyword) {
                $q->where('judul', 'like', "%{$keyword}%")
                    ->orWhere('keterangan', 'like', "%{$keyword}%")
                    ->orWhere('deskripsi', 'like', "%{$keyword}%")
                    ->orWhere('kategori', 'like', "%{$keyword}%")
                    ->orWhere('jenis', 'like', "%{$keyword}%");
            });
        }

        // ===== FILTER KATEGORI =====
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        // ===== FILTER JENIS =====
        if ($request->filled('jenis')) {
            $query->where('jenis', $request->jenis);
        }

        // ===== FILTER PRODUK SAJA =====
        if ($request->filled('produk')) {
            $query->where('is_produk', true);
        }

        // ===== SORTING =====
        // Default: urutan asc, lalu terbaru
        $query->orderBy('urutan', 'asc')->latest();

        $galeri = $query->paginate(12)->withQueryString();

        // ===== DATA UNTUK FILTER =====
        $kategoris = Galeri::active()
            ->whereNotNull('kategori')
            ->distinct()
            ->pluck('kategori')
            ->filter()
            ->values();

        $jenisList = Galeri::active()
            ->whereNotNull('jenis')
            ->distinct()
            ->pluck('jenis')
            ->filter()
            ->values();

        return view('galeri.index', compact('galeri', 'kategoris', 'jenisList'));
    }

    /**
     * Halaman detail produk + harga.
     */
    public function show(string $slug)
    {
        $item = Galeri::where('slug', $slug)
            ->active()
            ->firstOrFail();

        // ===== PRODUK TERKAIT (SELALU TERBARU) =====
        // Kategori sama, exclude diri sendiri, limit 4
        $terkait = Galeri::where('id', '!=', $item->id)
            ->active()
            ->where('kategori', $item->kategori)
            ->latest('created_at')
            ->limit(4)
            ->get();

        return view('galeri.show', compact('item', 'terkait'));
    }

    /**
     * AJAX Live Search — rekomendasi saat user mengetik.
     */
    public function search(Request $request)
    {
        $keyword = $request->get('q', '');

        if (strlen($keyword) < 2) {
            return response()->json([
                'results' => [],
                'total'   => 0,
            ]);
        }

        $results = Galeri::active()
            ->where(function ($query) use ($keyword) {
                $query->where('judul', 'like', "%{$keyword}%")
                    ->orWhere('keterangan', 'like', "%{$keyword}%")
                    ->orWhere('deskripsi', 'like', "%{$keyword}%")
                    ->orWhere('kategori', 'like', "%{$keyword}%")
                    ->orWhere('jenis', 'like', "%{$keyword}%");
            })
            ->latest('created_at')
            ->limit(8)
            ->get();

        return response()->json([
            'results' => $results->map(function ($item) {
                return [
                    'id'         => $item->id,
                    'judul'      => $item->judul,
                    'slug'       => $item->slug,
                    'kategori'   => $item->kategori,
                    'jenis'      => $item->jenis,
                    'gambar'     => asset($item->gambar),
                    'harga'      => $item->is_produk ? $item->harga_rupiah : null,
                    'is_produk'  => $item->is_produk,
                    'url'        => route('galeri.detail', $item->slug),
                ];
            }),
            'total' => $results->count(),
        ]);
    }
}
