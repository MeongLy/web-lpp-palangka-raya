<?php

namespace Database\Seeders;

use App\Models\Profil;
use Illuminate\Database\Seeder;

class ProfilSeeder extends Seeder
{
    public function run(): void
    {
        Profil::create([
            'sejarah' => 'Lapas Perempuan Palangka Raya adalah unit pelaksana teknis di bidang pemasyarakatan yang bertugas membina dan mendidik warga binaan perempuan. Berdiri sejak tahun 2005, kami berkomitmen memberikan pelayanan terbaik dan menciptakan lingkungan yang kondusif untuk proses rehabilitasi.',
            'visi' => 'Menjadi lembaga pemasyarakatan perempuan yang unggul dalam pembinaan, berbasis hak asasi manusia, dan berwawasan lingkungan.',
            'misi' => '1. Menyelenggarakan pembinaan kepribadian dan kemandirian secara terpadu.\n2. Memberikan pelayanan kesehatan dan psikososial yang humanis.\n3. Mengembangkan keterampilan vokasional untuk bekal hidup mandiri.\n4. Membangun kerjasama dengan berbagai pihak untuk mendukung reintegrasi sosial.',
            'tupoksi' => 'Melaksanakan pembinaan, pelayanan, dan pengawasan terhadap warga binaan perempuan sesuai dengan peraturan perundang-undangan yang berlaku.',
            'foto_gedung' => 'images/images4.jpg'
        ]);
    }
}
