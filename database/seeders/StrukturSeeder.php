<?php

namespace Database\Seeders;

use App\Models\Struktur;
use Illuminate\Database\Seeder;

class StrukturSeeder extends Seeder
{
    public function run(): void
    {
        $strukturs = [
            // Pimpinan
            ['nama' => 'Hani Anggraeni', 'jabatan' => 'Kepala Lapas', 'nip' => '1982092006122001', 'level' => 'pimpinan', 'urutan' => 1],

            // KPLP & Kasubag
            ['nama' => 'Yuli Wardina', 'jabatan' => 'Ka. KPLP', 'nip' => '197707082001122001', 'level' => 'kplp', 'urutan' => 2],
            ['nama' => 'Christin Sari', 'jabatan' => 'Kasubag TU', 'nip' => '198006062003122001', 'level' => 'kasubag', 'urutan' => 3],

            // Kaur
            ['nama' => 'Wiwiek T. E. S.', 'jabatan' => 'Kaur Wai dan Keu', 'nip' => '197604302006022002', 'level' => 'kaur', 'urutan' => 4],
            ['nama' => 'Yulianto', 'jabatan' => 'Kaur Umum', 'nip' => '198605152009011001', 'level' => 'kaur', 'urutan' => 5],

            // Kasi
            ['nama' => 'Muslika Dwiyana', 'jabatan' => 'Kasi Binadik', 'nip' => '197905232005012001', 'level' => 'kasi', 'urutan' => 6],
            ['nama' => 'Sri Endah Wulandari', 'jabatan' => 'Kasi Giatja', 'nip' => '198504092009012001', 'level' => 'kasi', 'urutan' => 7],
            ['nama' => 'Idha Sri Hidyana', 'jabatan' => 'Kasi Adm. Kamtib', 'nip' => '197303051993032001', 'level' => 'kasi', 'urutan' => 8],

            // Kasubsi
            ['nama' => 'Holida Hotnan', 'jabatan' => 'Kasubsi Registrasi', 'nip' => '200007072003012001', 'level' => 'kasubsi', 'urutan' => 9],
            ['nama' => 'Agus Syamsu A. R.', 'jabatan' => 'Kasubsi Bimker & Lohaker', 'nip' => '197504252007011001', 'level' => 'kasubsi', 'urutan' => 10],
            ['nama' => 'Chandra Dewi Yulianti', 'jabatan' => 'Kasubsi Keamanan', 'nip' => '197909302006042006', 'level' => 'kasubsi', 'urutan' => 11],
            ['nama' => 'Iin Arjawani', 'jabatan' => 'Kasubsi Sarana Kerja', 'nip' => '198408092009012001', 'level' => 'kasubsi', 'urutan' => 12],
            ['nama' => 'Wulandari Yulpianti', 'jabatan' => 'Kasubsi Bimkemaswat', 'nip' => '198306262006042004', 'level' => 'kasubsi', 'urutan' => 13],
            ['nama' => 'Candra Winarti', 'jabatan' => 'Kasubsi Pelatkatib', 'nip' => '198303053003122003', 'level' => 'kasubsi', 'urutan' => 14],
        ];

        foreach ($strukturs as $struktur) {
            Struktur::create($struktur);
        }
    }
}
