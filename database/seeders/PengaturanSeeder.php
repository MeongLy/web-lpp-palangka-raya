<?php

namespace Database\Seeders;

use App\Models\Pengaturan;
use Illuminate\Database\Seeder;

class PengaturanSeeder extends Seeder
{
    public function run(): void
    {
        $pengaturans = [
            ['key' => 'nama_lapas', 'value' => 'Lapas Perempuan Palangka Raya', 'group' => 'umum'],
            ['key' => 'alamat', 'value' => 'Jl. Tjilik Riwut No.km. 5, Bukit Tunggal, Kec. Jekan Raya, Kota Palangka Raya, Kalimantan Tengah 74874', 'group' => 'kontak'],
            ['key' => 'telepon', 'value' => '+62 812-3456-7890', 'group' => 'kontak'],
            ['key' => 'telepon_2', 'value' => '+62 853-1234-5678', 'group' => 'kontak'],
            ['key' => 'email', 'value' => 'lapas.perempuan@kemenkumham.go.id', 'group' => 'kontak'],
            ['key' => 'whatsapp', 'value' => '6281234567890', 'group' => 'sosial'],
            ['key' => 'facebook', 'value' => '#', 'group' => 'sosial'],
            ['key' => 'instagram', 'value' => '#', 'group' => 'sosial'],
            ['key' => 'youtube', 'value' => '#', 'group' => 'sosial'],
        ];

        foreach ($pengaturans as $pengaturan) {
            Pengaturan::create($pengaturan);
        }
    }
}
