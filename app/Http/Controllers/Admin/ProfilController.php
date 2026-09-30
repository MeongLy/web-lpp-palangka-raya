<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profil;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    /**
     * Display profil.
     */
    public function index()
    {
        $profil = Profil::first();
        return view('admin.profil.index', compact('profil'));
    }

    /**
     * Show the form for editing profil.
     */
    public function edit()
    {
        $profil = Profil::first();

        if (!$profil) {
            $profil = new Profil();
        }

        return view('admin.profil.edit', compact('profil'));
    }

    /**
     * Update profil.
     */
    public function update(Request $request)
    {
        $request->validate([
            'sejarah' => 'nullable|string',
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',
            'tupoksi' => 'nullable|string',
            'foto_gedung' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $profil = Profil::first();

        if (!$profil) {
            $profil = new Profil();
        }

        // Upload foto gedung
        if ($request->hasFile('foto_gedung')) {
            if ($profil->foto_gedung && file_exists(public_path($profil->foto_gedung))) {
                unlink(public_path($profil->foto_gedung));
            }

            $file = $request->file('foto_gedung');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/profil'), $filename);
            $profil->foto_gedung = 'images/profil/' . $filename;
        }

        $profil->sejarah = $request->sejarah;
        $profil->visi = $request->visi;
        $profil->misi = $request->misi;
        $profil->tupoksi = $request->tupoksi;
        $profil->save();

        return redirect()->route('admin.profil.index')
            ->with('success', 'Profil berhasil diperbarui!');
    }
}
