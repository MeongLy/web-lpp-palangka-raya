<?php

namespace Database\Seeders;

use App\Models\Galeri;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class GaleriProdukSeeder extends Seeder
{
    public function run(): void
    {
        $produk = [
            [
                'judul' => 'Kue Kering Nastar Bawi\'s',
                'kategori' => 'Produk',
                'jenis' => 'Makanan',
                'deskripsi' => "Kue nastar homemade buatan warga binaan Lapas Perempuan Palangka Raya.\n\nTerbuat dari bahan premium, tanpa pengawet, dan dipanggang fresh setiap hari.",
                'harga' => 75000,
                'satuan' => 'box',
                'stok' => 20,
                'is_produk' => true,
            ],
            [
                'judul' => 'Batik Tulis Motif Dayak',
                'kategori' => 'Produk',
                'jenis' => 'Kerajinan',
                'deskripsi' => "Batik tulis dengan motif khas Dayak Kalimantan Tengah.\n\nDibuat dengan teknik tradisional oleh warga binaan.",
                'harga' => 250000,
                'satuan' => 'lembar',
                'stok' => 5,
                'is_produk' => true,
            ],
            [
                'judul' => 'Tas Rajut Handmade',
                'kategori' => 'Produk',
                'jenis' => 'Kerajinan',
                'deskripsi' => 'Tas rajut handmade dengan desain modern dan bahan berkualitas.',
                'harga' => 120000,
                'satuan' => 'pcs',
                'stok' => 10,
                'is_produk' => true,
            ],
            [
                'judul' => 'Kegiatan Pelatihan Menjahit',
                'kategori' => 'Kegiatan',
                'jenis' => 'Pelatihan',
                'deskripsi' => 'Dokumentasi kegiatan pelatihan menjahit untuk warga binaan.',
                'is_produk' => false,
            ],
            [
                'judul' => 'Upacara HUT RI ke-79',
                'kategori' => 'Kegiatan',
                'jenis' => 'Upacara',
                'deskripsi' => 'Dokumentasi upacara peringatan HUT RI ke-79.',
                'is_produk' => false,
            ],
            [
                'judul' => 'Sabun Herbal Bawi\'s',
                'kategori' => 'Produk',
                'jenis' => 'Kesehatan',
                'deskripsi' => 'Sabun herbal alami berbahan dasar minyak kelapa dan ekstrak tumbuhan.',
                'harga' => 35000,
                'satuan' => 'pcs',
                'stok' => 50,
                'is_produk' => true,
            ],
        ];

        foreach ($produk as $p) {
            $p['slug'] = Str::slug($p['judul']);
            $p['gambar'] = 'images/galeri/dummy-' . Str::slug($p['judul']) . '.jpg';

            Galeri::create($p);
        }

        $this->command->info('✓ ' . count($produk) . ' data galeri berhasil dibuat.');
    }
}
