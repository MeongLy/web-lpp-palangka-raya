<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pejabat;
use Illuminate\Http\Request;

class PejabatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pejabats = Pejabat::ordered()->get();
        return view('admin.pejabat.index', compact('pejabats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pejabat.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'periode' => 'nullable|string|max:100',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'urutan' => 'nullable|integer',
        ]);

        // Upload foto
        $imagePath = null;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/pejabat'), $filename);
            $imagePath = 'images/pejabat/' . $filename;
        }

        $data = $request->all();
        $data['foto'] = $imagePath;
        $data['is_active'] = $request->has('is_active');

        Pejabat::create($data);

        return redirect()->route('admin.pejabat.index')
            ->with('success', 'Pejabat berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pejabat = Pejabat::findOrFail($id);
        return view('admin.pejabat.show', compact('pejabat'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pejabat = Pejabat::findOrFail($id);
        return view('admin.pejabat.edit', compact('pejabat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'periode' => 'nullable|string|max:100',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'urutan' => 'nullable|integer',
        ]);

        $pejabat = Pejabat::findOrFail($id);

        // Upload foto baru jika ada
        if ($request->hasFile('foto')) {
            // Hapus foto lama
            if ($pejabat->foto && file_exists(public_path($pejabat->foto))) {
                unlink(public_path($pejabat->foto));
            }

            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/pejabat'), $filename);
            $pejabat->foto = 'images/pejabat/' . $filename;
        }

        $pejabat->nama = $request->nama;
        $pejabat->jabatan = $request->jabatan;
        $pejabat->periode = $request->periode;
        $pejabat->urutan = $request->urutan;
        $pejabat->is_active = $request->has('is_active');
        $pejabat->save();

        return redirect()->route('admin.pejabat.index')
            ->with('success', 'Pejabat berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pejabat = Pejabat::findOrFail($id);

        // Hapus foto
        if ($pejabat->foto && file_exists(public_path($pejabat->foto))) {
            unlink(public_path($pejabat->foto));
        }

        $pejabat->delete();

        return redirect()->route('admin.pejabat.index')
            ->with('success', 'Pejabat berhasil dihapus!');
    }
}
