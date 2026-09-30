<?php

namespace Database\Seeders;

use App\Models\Galeri;
use Illuminate\Database\Seeder;

class GaleriSeeder extends Seeder
{
    public function run(): void
    {
        $galeris = [
            ['judul' => 'Kegiatan Pembinaan', 'gambar' => 'galeri/galeri1.jpg', 'kategori' => 'kegiatan', 'urutan' => 1],
            ['judul' => 'Pelatihan Keterampilan', 'gambar' => 'galeri/galeri2.jpg', 'kategori' => 'pelatihan', 'urutan' => 2],
            ['judul' => 'Kunjungan Keluarga', 'gambar' => 'galeri/galeri3.jpg', 'kategori' => 'kunjungan', 'urutan' => 3],
            ['judul' => 'Kegiatan Seni', 'gambar' => 'galeri/galeri4.jpg', 'kategori' => 'kegiatan', 'urutan' => 4],
            ['judul' => 'Pelayanan Kesehatan', 'gambar' => 'galeri/galeri5.jpg', 'kategori' => 'kesehatan', 'urutan' => 5],
            ['judul' => 'Upacara Hari Besar', 'gambar' => 'galeri/galeri6.jpg', 'kategori' => 'upacara', 'urutan' => 6],
        ];

        foreach ($galeris as $galeri) {
            Galeri::create($galeri);
        }
    }
}
