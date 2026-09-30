<?php

namespace Database\Seeders;

use App\Models\Pejabat;
use Illuminate\Database\Seeder;

class PejabatSeeder extends Seeder
{
    public function run(): void
    {
        $pejabats = [
            [
                'nama' => 'Ibu Hj. Siti Rahmah, S.H., M.H.',
                'jabatan' => 'Kepala Lapas',
                'periode' => '2023 - Sekarang',
                'urutan' => 1,
                'is_active' => true
            ],
            [
                'nama' => 'Ibu Dra. Maria Ulfah, M.Si.',
                'jabatan' => 'Kepala Bidang Pembinaan',
                'periode' => '2023 - Sekarang',
                'urutan' => 2,
                'is_active' => true
            ],
            [
                'nama' => 'Bapak Ahmad Fauzi, S.Sos.',
                'jabatan' => 'Kepala Bidang Keamanan',
                'periode' => '2023 - Sekarang',
                'urutan' => 3,
                'is_active' => true
            ],
            [
                'nama' => 'Ibu Dr. Rina Wati, S.Ked.',
                'jabatan' => 'Kepala Bidang Kesehatan',
                'periode' => '2023 - Sekarang',
                'urutan' => 4,
                'is_active' => true
            ],
            [
                'nama' => 'Bapak Budi Santoso, S.H.',
                'jabatan' => 'Kepala Bidang Hukum',
                'periode' => '2023 - Sekarang',
                'urutan' => 5,
                'is_active' => true
            ],
        ];

        foreach ($pejabats as $pejabat) {
            Pejabat::create($pejabat);
        }
    }
}
