@extends('layouts.app')

@section('content')
@php
    use App\Models\Pengaturan;
    use Illuminate\Support\Facades\File;

    // Ambil path gambar dari pengaturan, fallback ke default
    $strukturGambar = Pengaturan::get('struktur_gambar', 'images/struktur-organisasi.jpeg');

    // Cek apakah file benar-benar ada
    $gambarExists = $strukturGambar && File::exists(public_path($strukturGambar));
@endphp

<!-- ===== BREADCRUMB ===== -->
<section class="bg-[#0a1638] py-8 sm:py-10 mt-16">
    <div class="container mx-auto px-4 sm:px-6">
        <p class="text-xs sm:text-sm text-white/70">
            <a href="{{ route('home') }}" class="text-[#FFD700] hover:text-[#FFE44D] transition">Beranda</a>
            <span class="text-white/50 mx-2">/</span>
            <a href="{{ route('home') }}#profil" class="text-[#FFD700] hover:text-[#FFE44D] transition">Profil</a>
            <span class="text-white/50 mx-2">/</span>
            <span class="text-[#FFD700]">Struktur Organisasi</span>
        </p>
        <h1 class="text-2xl sm:text-3xl font-bold text-white mt-2">Struktur Organisasi</h1>
        <p class="text-sm text-white/70">Struktur Organisasi Lapas Perempuan Kelas IIA Palangka Raya</p>
    </div>
</section>

<!-- ===== KONTEN ===== -->
<section class="py-10 sm:py-12 bg-gray-50">
    <div class="container mx-auto px-4 sm:px-6">
        <div class="max-w-6xl mx-auto">

            <a href="{{ route('home') }}#profil" class="inline-flex items-center gap-2 text-[#0a1638] hover:text-[#FFD700] transition mb-5 font-semibold text-sm">
                <i class="fas fa-arrow-left"></i> Kembali ke Profil
            </a>

            <div class="bg-white rounded-2xl shadow-lg p-5 sm:p-8">

                <!-- Header -->
                <div class="text-center mb-10">
                    <div class="inline-block px-4 py-1.5 bg-[#FFD700]/20 border border-[#FFD700]/40 rounded-full mb-4">
                        <p class="text-[#0a1638] text-xs font-bold uppercase tracking-wider">
                            <i class="fas fa-sitemap mr-1"></i> Bagan Organisasi
                        </p>
                    </div>
                    <h2 class="text-xl sm:text-2xl md:text-3xl font-bold text-[#0a1638]">STRUKTUR ORGANISASI</h2>
                    <p class="text-sm sm:text-base text-[#0a1638]/70 font-semibold mt-1">
                        LEMBAGA PEMASYARAKATAN PEREMPUAN KELAS IIA PALANGKA RAYA
                    </p>
                    <div class="w-20 h-1 bg-[#FFD700] rounded-full mx-auto mt-4"></div>
                </div>

                <!-- ===== GAMBAR STRUKTUR ORGANISASI ===== -->
                <div class="max-w-5xl mx-auto mb-8">
                    @if($gambarExists)
                    <div class="relative w-full rounded-xl overflow-hidden bg-white border border-gray-200 shadow-sm">
                        <img src="{{ asset($strukturGambar) }}"
                             alt="Bagan Struktur Organisasi Lapas Perempuan Kelas IIA Palangka Raya"
                             class="w-full h-auto object-contain zoomable cursor-pointer">
                    </div>

                    <p class="text-[10px] sm:text-xs text-gray-400 mt-3 text-center flex items-center justify-center gap-2">
                        <i class="fas fa-info-circle text-[#FFD700]"></i>
                        Klik gambar untuk memperbesar
                    </p>
                    @else
                    <div class="w-full aspect-video flex flex-col items-center justify-center bg-gray-50 rounded-xl border-2 border-dashed border-gray-200">
                        <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mb-3 shadow-sm">
                            <i class="fas fa-image text-gray-300 text-2xl"></i>
                        </div>
                        <p class="text-gray-400 text-sm font-semibold">Bagan struktur belum tersedia</p>
                        <p class="text-gray-300 text-xs mt-1">Silakan hubungi administrator</p>
                    </div>
                    @endif
                </div>

                <!-- ===== KETERANGAN ===== -->
                <div class="bg-[#0a1638] text-white p-5 rounded-xl">
                    <h3 class="text-[#FFD700] text-sm sm:text-base font-bold flex items-center gap-2">
                        <i class="fas fa-info-circle"></i> Keterangan
                    </h3>
                    <p class="text-white/80 mt-2 text-xs sm:text-sm leading-relaxed">
                        Struktur organisasi ini dapat berubah sesuai dengan kebijakan dan kebutuhan organisasi.
                    </p>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection
