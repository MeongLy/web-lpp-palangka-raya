<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaturan;
use Illuminate\Http\Request;

class SitalawangController extends Controller
{
    /**
     * Tampilkan halaman index (preview konten)
     */
    public function index()
    {
        $pengaturan = Pengaturan::getGroup('sitalawang');
        return view('admin.sitalawang.index', compact('pengaturan'));
    }

    /**
     * Tampilkan form edit
     */
    public function edit()
    {
        $pengaturan = Pengaturan::getGroup('sitalawang');
        return view('admin.sitalawang.edit', compact('pengaturan'));
    }

    /**
     * Update konten SI-Talawang
     */
    public function update(Request $request)
    {
        $request->validate([
            'whatsapp' => 'required|string|max:30',
            'deskripsi' => 'required|string',
            'cara' => 'nullable|string',
            'keunggulan' => 'nullable|string',
            'persyaratan' => 'nullable|string',
        ]);

        // Simpan ke tabel pengaturans dengan group 'sitalawang'
        $fields = [
            'sitalawang_whatsapp' => $request->whatsapp,
            'sitalawang_deskripsi' => $request->deskripsi,
            'sitalawang_cara' => $request->cara ?? '',
            'sitalawang_keunggulan' => $request->keunggulan ?? '',
            'sitalawang_persyaratan' => $request->persyaratan ?? '',
        ];

        foreach ($fields as $key => $value) {
            Pengaturan::set($key, $value, 'sitalawang');
        }

        return redirect()->route('admin.sitalawang.index')
            ->with('success', 'SI-Talawang berhasil diperbarui!');
    }
}
