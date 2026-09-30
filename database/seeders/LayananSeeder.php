<?php

namespace Database\Seeders;

use App\Models\Layanan;
use Illuminate\Database\Seeder;

class LayananSeeder extends Seeder
{
    public function run(): void
    {
        $layanans = [
            ['nama' => 'Pembinaan Kepribadian', 'deskripsi' => 'Bimbingan mental, spiritual, dan sosial untuk membentuk karakter positif.', 'icon' => 'fa-hand-holding-heart', 'urutan' => 1],
            ['nama' => 'Pelatihan Keterampilan', 'deskripsi' => 'Kursus menjahit, membatik, tata boga, dan kerajinan tangan.', 'icon' => 'fa-laptop-code', 'urutan' => 2],
            ['nama' => 'Layanan Kesehatan', 'deskripsi' => 'Pemeriksaan rutin, konseling, dan dukungan psikologis.', 'icon' => 'fa-heartbeat', 'urutan' => 3],
            ['nama' => 'Bantuan Hukum', 'deskripsi' => 'Pendampingan hukum dan akses keadilan bagi warga binaan.', 'icon' => 'fa-gavel', 'urutan' => 4],
            ['nama' => 'Reintegrasi Sosial', 'deskripsi' => 'Program asimilasi, cuti, dan pembimbingan pasca-bebas.', 'icon' => 'fa-users', 'urutan' => 5],
            ['nama' => 'Kunjungan & Komunikasi', 'deskripsi' => 'Fasilitas kunjungan keluarga dan layanan video call.', 'icon' => 'fa-phone-alt', 'urutan' => 6],
        ];

        foreach ($layanans as $layanan) {
            Layanan::create($layanan);
        }
    }
}
