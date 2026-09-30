<?php

namespace Database\Seeders;

use App\Models\Berita;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BeritaSeeder extends Seeder
{
    public function run(): void
    {
        $beritas = [
            [
                'judul' => 'Kunjungan Kerja Kemenkumham ke Lapas Perempuan Palangka Raya',
                'deskripsi' => 'Kunjungan dalam rangka monitoring pelayanan dan pembinaan warga binaan.',
                'tanggal' => now()->subDays(5),
                'is_published' => true
            ],
            [
                'judul' => 'Pelatihan Keterampilan Membatik bagi Warga Binaan',
                'deskripsi' => 'Warga binaan mengikuti pelatihan membatik bersama pengrajin lokal Kalimantan Tengah.',
                'tanggal' => now()->subDays(10),
                'is_published' => true
            ],
            [
                'judul' => 'Peringatan Hari Perempuan Internasional di Lapas',
                'deskripsi' => 'Acara peringatan dengan tema pemberdayaan perempuan dan kesetaraan gender.',
                'tanggal' => now()->subDays(15),
                'is_published' => true
            ],
        ];

        foreach ($beritas as $berita) {
            Berita::create([
                ...$berita,
                'slug' => Str::slug($berita['judul']),
                'isi' => $berita['deskripsi'] . ' Selengkapnya...'
            ]);
        }
    }
}
