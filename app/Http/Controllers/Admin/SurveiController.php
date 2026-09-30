<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SurveiController extends Controller
{
    /**
     * Tampilkan halaman index (dalam pengembangan)
     */
    public function index()
    {
        return view('admin.survei.index');
    }

    /**
     * Tampilkan form edit (dalam pengembangan)
     */
    public function edit()
    {
        return view('admin.survei.edit');
    }

    /**
     * Update hasil survei (dalam pengembangan)
     */
    public function update(Request $request)
    {
        return redirect()->route('admin.survei.index')
            ->with('success', 'Hasil Survei berhasil diperbarui!');
    }
}
