@extends('layouts.app')

@section('content')
<!-- ===== BREADCRUMB ===== -->
<section class="bg-[#0a1638] py-8 sm:py-10 mt-16">
    <div class="container mx-auto px-4 sm:px-6">
        <p class="text-xs sm:text-sm text-white/70">
            <a href="{{ route('home') }}" class="text-[#FFD700] hover:text-[#FFE44D] transition">Beranda</a>
            <span class="text-white/50 mx-2">/</span>
            <a href="{{ route('home') }}#layanan" class="text-[#FFD700] hover:text-[#FFE44D] transition">Layanan</a>
            <span class="text-white/50 mx-2">/</span>
            <span class="text-[#FFD700]">Hasil Survei</span>
        </p>
        <h1 class="text-2xl sm:text-3xl font-bold text-white mt-2">Hasil Survei</h1>
        <p class="text-sm text-white/70">Survei Kepuasan Masyarakat</p>
    </div>
</section>

<!-- ===== KONTEN ===== -->
<section class="py-10 sm:py-12 bg-gray-50">
    <div class="container mx-auto px-4 sm:px-6">
        <div class="max-w-4xl mx-auto">

            <!-- Tombol Kembali -->
            <a href="{{ route('home') }}#layanan"
               class="inline-flex items-center gap-2 text-[#0a1638] hover:text-[#FFD700] transition mb-5 font-semibold text-sm">
                <i class="fas fa-arrow-left"></i> Kembali ke Layanan
            </a>

            <!-- Card Coming Soon -->
            <div class="bg-white rounded-2xl shadow-lg p-10 sm:p-16 text-center">
                <!-- Icon Animasi -->
                <div class="w-28 h-28 bg-[#FFD700]/20 rounded-full flex items-center justify-center mx-auto mb-6 relative">
                    <div class="absolute inset-0 bg-[#FFD700]/30 rounded-full animate-ping"></div>
                    <i class="fas fa-poll text-[#FFD700] text-5xl relative z-10"></i>
                </div>

                <!-- Title -->
                <h2 class="text-2xl sm:text-3xl font-bold text-[#0a1638] mb-3">
                    Halaman Dalam Pengembangan
                </h2>
                <p class="text-base text-gray-600 max-w-lg mx-auto leading-relaxed mb-8">
                    Halaman <strong>Hasil Survei</strong> sedang dalam tahap pengembangan.
                    Kami sedang menyiapkan fitur untuk menampilkan hasil survei kepuasan masyarakat terhadap layanan Lapas Perempuan Palangka Raya.
                </p>

                <!-- Badge -->
                <div class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#0a1638] text-[#FFD700] rounded-full text-sm font-bold shadow-lg">
                    <i class="fas fa-hourglass-half"></i> Coming Soon
                </div>

                <!-- Divider -->
                <div class="w-20 h-1 bg-[#FFD700] rounded-full mx-auto my-8"></div>

                <!-- Info Box -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 max-w-2xl mx-auto">
                    <div class="p-4 bg-gray-50 rounded-xl border border-gray-200">
                        <i class="fas fa-chart-bar text-[#FFD700] text-2xl mb-2"></i>
                        <p class="text-xs font-semibold text-[#0a1638]">Data Statistik</p>
                        <p class="text-[10px] text-gray-500 mt-1">Visualisasi hasil survei</p>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-xl border border-gray-200">
                        <i class="fas fa-file-alt text-[#FFD700] text-2xl mb-2"></i>
                        <p class="text-xs font-semibold text-[#0a1638]">Laporan Lengkap</p>
                        <p class="text-[10px] text-gray-500 mt-1">Unduh laporan PDF</p>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-xl border border-gray-200">
                        <i class="fas fa-users text-[#FFD700] text-2xl mb-2"></i>
                        <p class="text-xs font-semibold text-[#0a1638]">Responden</p>
                        <p class="text-[10px] text-gray-500 mt-1">Data partisipasi publik</p>
                    </div>
                </div>

                <!-- Notifikasi -->
                <div class="mt-10 p-4 bg-blue-50 border border-blue-200 rounded-xl max-w-lg mx-auto">
                    <p class="text-xs text-blue-800 flex items-start gap-2 text-left">
                        <i class="fas fa-bell text-blue-500 mt-0.5 flex-shrink-0"></i>
                        <span>
                            Halaman ini akan segera tersedia. Silakan kembali lagi nanti untuk melihat hasil survei kepuasan masyarakat.
                        </span>
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection
