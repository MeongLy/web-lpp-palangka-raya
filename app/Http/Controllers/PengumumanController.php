<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;

class PengumumanController extends Controller
{
    public function popup(Request $request)
    {
        $pengumumans = Pengumuman::active()
            ->tayang()
            ->whereIn('tipe', ['popup', 'keduanya'])   // ← eksplisit, sama seperti banner
            ->prioritas()
            ->get();

        return response()->json([
            'pengumumans' => $pengumumans->map(function ($item) {
                return [
                    'id'         => $item->id,
                    'judul'      => $item->judul,
                    'slug'       => $item->slug,
                    'isi'        => $item->isi,
                    'gambar'     => $item->gambar ? asset($item->gambar) : null,
                    'link'       => $item->link,
                    'link_label' => $item->link_label,
                    'tipe'       => $item->tipe,
                    'prioritas'  => $item->prioritas,
                    'mulai'      => $item->mulai_tayang?->format('d M Y'),
                    'selesai'    => $item->selesai_tayang?->format('d M Y'),
                ];
            }),
        ]);
    }

    /**
     * API: Ambil pengumuman banner yang aktif.
     */
    public function banner(Request $request)
    {
        $pengumumans = Pengumuman::active()
            ->tayang()
            ->whereIn('tipe', ['banner', 'keduanya'])
            ->prioritas()
            ->get();

        return response()->json([
            'pengumumans' => $pengumumans->map(function ($item) {
                return [
                    'id'         => $item->id,
                    'judul'      => $item->judul,
                    'slug'       => $item->slug,
                    'isi'        => $item->isi,
                    'gambar'     => $item->gambar ? asset($item->gambar) : null,
                    'link'       => $item->link,
                    'link_label' => $item->link_label,
                    'tipe'       => $item->tipe,
                    'prioritas'  => $item->prioritas,
                ];
            }),
        ]);
    }

    /**
     * Halaman detail pengumuman (opsional).
     */
    public function show(string $slug)
    {
        $pengumuman = Pengumuman::where('slug', $slug)
            ->active()
            ->firstOrFail();

        return view('pengumuman.show', compact('pengumuman'));
    }
}
