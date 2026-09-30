<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class PengumumanController extends Controller
{
    public function index()
    {
        $pengumumans = Pengumuman::prioritas()->paginate(15);
        return view('admin.pengumuman.index', compact('pengumumans'));
    }

    public function create()
    {
        return view('admin.pengumuman.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul'          => 'required|string|max:255',
            'isi'            => 'required|string',
            'gambar'         => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
            'link'           => 'nullable|string|max:255',
            'link_label'     => 'nullable|string|max:50',
            'tipe'           => 'required|in:popup,banner,keduanya',
            'prioritas'      => 'nullable|integer|min:0',
            'mulai_tayang'   => 'nullable|date',
            'selesai_tayang' => 'nullable|date|after_or_equal:mulai_tayang',
        ]);

        // Default values
        $validated['prioritas'] = $request->input('prioritas', 0);
        $validated['link_label'] = $request->input('link_label', 'Selengkapnya');
        $validated['is_active'] = $request->has('is_active');

        // Upload gambar
        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $this->uploadGambar($request->file('gambar'));
        }

        Pengumuman::create($validated);

        return redirect()
            ->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman berhasil ditambahkan!');
    }

    public function show(Pengumuman $pengumuman)
    {
        return view('admin.pengumuman.show', compact('pengumuman'));
    }

    public function edit(Pengumuman $pengumuman)
    {
        return view('admin.pengumuman.edit', compact('pengumuman'));
    }

    public function update(Request $request, Pengumuman $pengumuman)
    {
        $validated = $request->validate([
            'judul'          => 'required|string|max:255',
            'isi'            => 'required|string',
            'gambar'         => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
            'link'           => 'nullable|string|max:255',
            'link_label'     => 'nullable|string|max:50',
            'tipe'           => 'required|in:popup,banner,keduanya',
            'prioritas'      => 'nullable|integer|min:0',
            'mulai_tayang'   => 'nullable|date',
            'selesai_tayang' => 'nullable|date|after_or_equal:mulai_tayang',
        ]);

        $validated['prioritas'] = $request->input('prioritas', 0);
        $validated['link_label'] = $request->input('link_label', 'Selengkapnya');
        $validated['is_active'] = $request->has('is_active');

        // Upload gambar baru
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if ($pengumuman->gambar && File::exists(public_path($pengumuman->gambar))) {
                File::delete(public_path($pengumuman->gambar));
            }

            $validated['gambar'] = $this->uploadGambar($request->file('gambar'));
        }

        $pengumuman->update($validated);

        return redirect()
            ->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman berhasil diperbarui!');
    }

    public function destroy(Pengumuman $pengumuman)
    {
        // Hapus gambar
        if ($pengumuman->gambar && File::exists(public_path($pengumuman->gambar))) {
            File::delete(public_path($pengumuman->gambar));
        }

        $pengumuman->delete();

        return redirect()
            ->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman berhasil dihapus!');
    }

    // ========================================
    // HELPER
    // ========================================

    private function uploadGambar($file): string
    {
        $destination = public_path('images/pengumuman');

        if (!File::exists($destination)) {
            File::makeDirectory($destination, 0755, true);
        }

        $filename = 'pengumuman_' . time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
        $file->move($destination, $filename);

        return 'images/pengumuman/' . $filename;
    }
}
