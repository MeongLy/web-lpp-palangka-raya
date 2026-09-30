<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::orderBy('tanggal', 'desc')->get();
        return view('admin.berita.index', compact('beritas'));
    }

    public function create()
    {
        return view('admin.berita.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'isi' => 'nullable|string',
            'tanggal' => 'required|date',
            'gambars' => 'nullable|array|max:3',
            'gambars.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'gambars.max' => 'Maksimal 3 gambar yang boleh diupload.',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->judul) . '-' . time();
        $data['is_published'] = $request->has('is_published');

        // Upload multiple gambar (max 3)
        $gambarPaths = [];
        if ($request->hasFile('gambars')) {
            foreach ($request->file('gambars') as $file) {
                if (count($gambarPaths) >= 3) break; // Batas 3 gambar

                $filename = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
                $file->move(public_path('images/berita'), $filename);
                $gambarPaths[] = 'images/berita/' . $filename;
            }
        }

        $data['gambars'] = $gambarPaths;
        $data['gambar'] = $gambarPaths[0] ?? null; // Gambar utama = gambar pertama

        Berita::create($data);

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        return view('admin.berita.edit', compact('berita'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'isi' => 'nullable|string',
            'tanggal' => 'required|date',
            'gambars' => 'nullable|array|max:3',
            'gambars.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'gambars.max' => 'Maksimal 3 gambar yang boleh diupload.',
        ]);

        $berita = Berita::findOrFail($id);
        $data = $request->all();
        $data['is_published'] = $request->has('is_published');

        // Update slug jika judul berubah
        if ($request->judul !== $berita->judul) {
            $data['slug'] = Str::slug($request->judul) . '-' . time();
        }

        // Gambar lama yang dipertahankan
        $existingGambars = $berita->gambars ?? [];
        $keepGambars = $request->input('keep_gambars', []); // Gambar yang dicentang untuk dipertahankan

        // Filter gambar lama yang tidak dipertahankan → hapus
        foreach ($existingGambars as $gambar) {
            if (!in_array($gambar, $keepGambars)) {
                if (file_exists(public_path($gambar))) {
                    unlink(public_path($gambar));
                }
            }
        }

        // Sisa gambar lama yang dipertahankan
        $gambarPaths = array_values(array_filter($existingGambars, function($g) use ($keepGambars) {
            return in_array($g, $keepGambars);
        }));

        // Upload gambar baru
        if ($request->hasFile('gambars')) {
            foreach ($request->file('gambars') as $file) {
                if (count($gambarPaths) >= 3) break;

                $filename = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
                $file->move(public_path('images/berita'), $filename);
                $gambarPaths[] = 'images/berita/' . $filename;
            }
        }

        $data['gambars'] = $gambarPaths;
        $data['gambar'] = $gambarPaths[0] ?? null;

        $berita->update($data);

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);

        // Hapus semua gambar
        $gambars = $berita->gambars ?? [];
        if ($berita->gambar) {
            $gambars[] = $berita->gambar;
        }

        foreach (array_unique($gambars) as $gambar) {
            if ($gambar && file_exists(public_path($gambar))) {
                unlink(public_path($gambar));
            }
        }

        $berita->delete();

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil dihapus!');
    }
}
