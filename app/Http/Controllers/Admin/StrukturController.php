<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaturan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class StrukturController extends Controller
{
    /**
     * Path default gambar bagan struktur.
     */
    private string $defaultPath = 'images/struktur-organisasi.png';

    /**
     * Key untuk disimpan di tabel pengaturan.
     */
    private string $settingKey = 'struktur_gambar';

    /**
     * Ambil path gambar saat ini.
     */
    private function getGambarPath(): ?string
    {
        $path = Pengaturan::get($this->settingKey, $this->defaultPath);

        return ($path && File::exists(public_path($path))) ? $path : null;
    }

    /**
     * Halaman index — menampilkan gambar bagan saat ini.
     */
    public function index()
    {
        return view('admin.struktur.index', [
            'strukturGambar' => $this->getGambarPath(),
        ]);
    }

    /**
     * Halaman create — form upload gambar baru.
     */
    public function create()
    {
        return view('admin.struktur.create', [
            'strukturGambar' => $this->getGambarPath(),
        ]);
    }

    /**
     * Simpan gambar baru (dari halaman create).
     */
    public function store(Request $request)
    {
        $request->validate([
            'struktur_gambar' => 'required|image|mimes:png,jpg,jpeg|max:2048',
        ], [
            'struktur_gambar.required' => 'Gambar bagan struktur wajib diunggah.',
            'struktur_gambar.image'    => 'File harus berupa gambar.',
            'struktur_gambar.mimes'    => 'Format gambar harus PNG, JPG, atau JPEG.',
            'struktur_gambar.max'      => 'Ukuran gambar maksimal 2MB.',
        ]);

        // Hapus gambar lama jika ada
        $this->deleteOldImage();

        // Simpan gambar baru
        $this->saveImage($request->file('struktur_gambar'));

        return redirect()
            ->route('admin.struktur.index')
            ->with('success', 'Gambar bagan struktur berhasil diunggah.');
    }

    /**
     * Halaman edit — form ganti gambar.
     */
    public function edit()
    {
        $gambar = $this->getGambarPath();

        if (!$gambar) {
            return redirect()
                ->route('admin.struktur.create')
                ->with('info', 'Belum ada gambar. Silakan unggah terlebih dahulu.');
        }

        return view('admin.struktur.edit', [
            'strukturGambar' => $gambar,
        ]);
    }

    /**
     * Update gambar (dari halaman edit).
     */
    public function update(Request $request)
    {
        $request->validate([
            'struktur_gambar' => 'required|image|mimes:png,jpg,jpeg|max:2048',
        ], [
            'struktur_gambar.required' => 'Gambar bagan struktur wajib diunggah.',
            'struktur_gambar.image'    => 'File harus berupa gambar.',
            'struktur_gambar.mimes'    => 'Format gambar harus PNG, JPG, atau JPEG.',
            'struktur_gambar.max'      => 'Ukuran gambar maksimal 2MB.',
        ]);

        // Hapus gambar lama
        $this->deleteOldImage();

        // Simpan gambar baru
        $this->saveImage($request->file('struktur_gambar'));

        return redirect()
            ->route('admin.struktur.index')
            ->with('success', 'Gambar bagan struktur berhasil diperbarui.');
    }

    /**
     * Hapus gambar bagan struktur.
     */
    public function destroy()
    {
        if (!$this->getGambarPath()) {
            return redirect()
                ->route('admin.struktur.index')
                ->with('error', 'Tidak ada gambar yang bisa dihapus.');
        }

        $this->deleteOldImage();

        // Hapus setting
        Pengaturan::where('key', $this->settingKey)->delete();

        return redirect()
            ->route('admin.struktur.index')
            ->with('success', 'Gambar bagan struktur berhasil dihapus.');
    }

    /**
     * Simpan file gambar ke public/images.
     */
    private function saveImage($file): void
    {
        $destination = public_path('images');

        if (!File::exists($destination)) {
            File::makeDirectory($destination, 0755, true);
        }

        // Simpan dengan nama tetap agar mudah di-reference
        $file->move($destination, 'struktur-organisasi.png');

        // Simpan path ke tabel pengaturan
        Pengaturan::updateOrCreate(
            ['key' => $this->settingKey],
            ['value' => $this->defaultPath]
        );
    }

    /**
     * Hapus gambar lama dari storage.
     */
    private function deleteOldImage(): void
    {
        $oldPath = Pengaturan::get($this->settingKey, $this->defaultPath);

        if ($oldPath && File::exists(public_path($oldPath))) {
            File::delete(public_path($oldPath));
        }
    }
}
