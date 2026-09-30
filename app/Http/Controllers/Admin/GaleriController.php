<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galeris = Galeri::ordered()->get();
        return view('admin.galeri.index', compact('galeris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.galeri.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            // ===== FIELD LAMA =====
            'judul'      => 'nullable|string|max:255',
            'gambar'     => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'keterangan' => 'nullable|string',
            'kategori'   => 'required|string|max:100',
            'jenis'      => 'required|string|max:100',
            'is_active'  => 'nullable|boolean',

            // ===== FIELD BARU =====
            'deskripsi'  => 'nullable|string',
            'harga'      => 'nullable|numeric|min:0',
            'is_produk'  => 'nullable|boolean',
            'satuan'     => 'nullable|string|max:50',
            'stok'       => 'nullable|integer|min:0',
        ]);

        // Upload gambar
        $imagePath = null;
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/galeri'), $filename);
            $imagePath = 'images/galeri/' . $filename;
        }

        $data = $request->except('gambar');
        $data['gambar']    = $imagePath;
        $data['is_active'] = $request->has('is_active');
        $data['is_produk'] = $request->has('is_produk');

        // ===== AUTO URUTAN =====
        // Ambil urutan terbesar, +1
        $data['urutan'] = (Galeri::max('urutan') ?? 0) + 1;

        Galeri::create($data);

        return redirect()->route('admin.galeri.index')
            ->with('success', 'Galeri berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $galeri = Galeri::findOrFail($id);
        return view('admin.galeri.show', compact('galeri'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $galeri = Galeri::findOrFail($id);
        return view('admin.galeri.edit', compact('galeri'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            // ===== FIELD LAMA =====
            'judul'      => 'nullable|string|max:255',
            'gambar'     => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'keterangan' => 'nullable|string',
            'kategori'   => 'required|string|max:100',
            'jenis'      => 'required|string|max:100',
            'is_active'  => 'nullable|boolean',

            // ===== FIELD BARU =====
            'deskripsi'  => 'nullable|string',
            'harga'      => 'nullable|numeric|min:0',
            'is_produk'  => 'nullable|boolean',
            'satuan'     => 'nullable|string|max:50',
            'stok'       => 'nullable|integer|min:0',
        ]);

        $galeri = Galeri::findOrFail($id);

        // Upload gambar baru jika ada
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($galeri->gambar && file_exists(public_path($galeri->gambar))) {
                unlink(public_path($galeri->gambar));
            }

            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/galeri'), $filename);
            $galeri->gambar = 'images/galeri/' . $filename;
        }

        // ===== FIELD LAMA =====
        $galeri->judul      = $request->judul;
        $galeri->keterangan = $request->keterangan;
        $galeri->kategori   = $request->kategori;
        $galeri->jenis      = $request->jenis;
        $galeri->is_active  = $request->has('is_active');
        // ⚠️ `urutan` TIDAK diupdate — biarkan otomatis

        // ===== FIELD BARU =====
        $galeri->deskripsi  = $request->deskripsi;
        $galeri->harga      = $request->harga;
        $galeri->is_produk  = $request->has('is_produk');
        $galeri->satuan     = $request->satuan;
        $galeri->stok       = $request->stok;

        $galeri->save();

        return redirect()->route('admin.galeri.index')
            ->with('success', 'Galeri berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $galeri = Galeri::findOrFail($id);

        // Hapus file gambar
        if ($galeri->gambar && file_exists(public_path($galeri->gambar))) {
            unlink(public_path($galeri->gambar));
        }

        $galeri->delete();

        return redirect()->route('admin.galeri.index')
            ->with('success', 'Galeri berhasil dihapus!');
    }
}
