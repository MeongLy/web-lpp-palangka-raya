<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaturan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class PengaturanController extends Controller
{
    /**
     * Tampilkan halaman pengaturan
     */
    public function index()
    {
        // Ambil semua pengaturan, kecuali group 'sitalawang' (biar tidak bentrok)
        $pengaturan = Pengaturan::whereIn('group', ['umum', 'kontak', 'sosial'])
            ->pluck('value', 'key')
            ->toArray();

        return view('admin.pengaturan.index', compact('pengaturan'));
    }

    /**
     * Update pengaturan
     */
    public function update(Request $request)
    {
        $request->validate([
            // ===== UMUM =====
            'nama_lapas'            => 'nullable|string|max:255',

            // ===== KONTAK =====
            'alamat'                => 'nullable|string',
            'telepon'               => 'nullable|string|max:30',
            'telepon_2'             => 'nullable|string|max:30',
            'email'                 => 'nullable|email|max:255',

            // ===== SOSIAL =====
            'whatsapp'              => 'nullable|string|max:30',
            'facebook'              => 'nullable|string|max:255',
            'instagram'             => 'nullable|string|max:255',
            'youtube'               => 'nullable|string|max:255',
            'twitter'               => 'nullable|string|max:255',

            // ===== HERO =====
            'hero_background'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
            'hero_overlay_opacity'  => 'nullable|integer|min:0|max:100',
        ], [
            'hero_background.image' => 'File harus berupa gambar.',
            'hero_background.mimes' => 'Format gambar harus JPG, PNG, atau WEBP.',
            'hero_background.max'   => 'Ukuran gambar maksimal 3MB.',
        ]);

        // ===== Kelompok berdasarkan key =====
        $groups = [
            'umum'   => ['nama_lapas'],
            'kontak' => ['alamat', 'telepon', 'telepon_2', 'email'],
            'sosial' => ['whatsapp', 'facebook', 'instagram', 'youtube', 'twitter'],
        ];

        foreach ($groups as $group => $keys) {
            foreach ($keys as $key) {
                if ($request->has($key)) {
                    Pengaturan::set($key, $request->input($key), $group);
                }
            }
        }

        // ===== Hero Overlay Opacity =====
        if ($request->filled('hero_overlay_opacity')) {
            Pengaturan::set(
                'hero_overlay_opacity',
                (int) $request->input('hero_overlay_opacity'),
                'kontak'
            );
        }

        // ===== Handle upload hero background =====
        if ($request->hasFile('hero_background')) {
            $file = $request->file('hero_background');

            // Hapus gambar lama kalau ada
            $oldPath = Pengaturan::get('hero_background');
            if ($oldPath && File::exists(public_path($oldPath))) {
                File::delete(public_path($oldPath));
            }

            // Buat folder kalau belum ada
            $destination = public_path('images/hero');
            if (!File::exists($destination)) {
                File::makeDirectory($destination, 0755, true);
            }

            // Simpan dengan nama unik
            $filename = 'hero_' . time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
            $file->move($destination, $filename);

            // Simpan path ke pengaturan
            Pengaturan::set(
                'hero_background',
                'images/hero/' . $filename,
                'kontak'
            );
        }

        return redirect()->route('admin.pengaturan.index')
            ->with('success', 'Pengaturan berhasil diperbarui!');
    }
}
