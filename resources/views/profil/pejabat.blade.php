@extends('layouts.app')

@section('content')
<!-- ===== BREADCRUMB ===== -->
<section class="bg-[#0a1638] py-8 sm:py-10 mt-16">
    <div class="container mx-auto px-4 sm:px-6">
        <div class="flex flex-col">
            <p class="text-xs sm:text-sm text-white/70">
                <a href="{{ route('home') }}" class="text-[#FFD700] hover:text-[#FFE44D] transition">Beranda</a>
                <span class="text-white/50 mx-2">/</span>
                <a href="{{ route('home') }}#profil" class="text-[#FFD700] hover:text-[#FFE44D] transition">Profil</a>
                <span class="text-white/50 mx-2">/</span>
                <span class="text-[#FFD700]">Profil Pejabat</span>
            </p>
            <h1 class="text-2xl sm:text-3xl font-bold text-white mt-2">Profil Pejabat</h1>
            <p class="text-sm text-white/70">Daftar Pejabat Lapas Perempuan Palangka Raya</p>
        </div>
    </div>
</section>

<!-- ===== KONTEN ===== -->
<section class="py-10 sm:py-12 bg-gray-50">
    <div class="container mx-auto px-4 sm:px-6">
        <div class="max-w-5xl mx-auto">

            <!-- Tombol Kembali -->
            <a href="{{ route('home') }}#profil"
               class="inline-flex items-center gap-2 text-[#0a1638] hover:text-[#FFD700] transition mb-5 font-semibold text-sm">
                <i class="fas fa-arrow-left"></i> Kembali ke Profil
            </a>

            <!-- Card Utama -->
            <div class="bg-white rounded-xl shadow-lg p-5 sm:p-8">

                <!-- Header -->
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-10 h-10 bg-[#0a1638] rounded-lg flex items-center justify-center">
                        <i class="fas fa-user-tie text-[#FFD700]"></i>
                    </div>
                    <h2 class="text-xl sm:text-2xl font-bold text-[#0a1638]">Pejabat Lapas Perempuan Palangka Raya</h2>
                </div>
                <div class="w-14 h-1 bg-[#FFD700] rounded-full mb-8"></div>

                @php
                    // Pisahkan Kepala Lapas dari yang lain
                    $kepalaLapas = $pejabat->first(function($p) {
                        return stripos($p->jabatan, 'kepala lapas') !== false
                            || stripos($p->jabatan, 'kalapas') !== false;
                    });

                    // Pejabat lainnya (tanpa Kepala Lapas)
                    $pejabatLain = $pejabat->filter(function($p) use ($kepalaLapas) {
                        return !$kepalaLapas || $p->id !== $kepalaLapas->id;
                    });
                @endphp

                <!-- ===== KEPALA LAPAS (PALING ATAS) ===== -->
                @if($kepalaLapas)
                <div class="mb-10">
                    <div class="bg-gradient-to-br from-[#0a1638] to-[#1a3270] rounded-2xl p-6 sm:p-8 text-center relative overflow-hidden">
                        <!-- Dekorasi -->
                        <div class="absolute -top-10 -right-10 w-40 h-40 bg-[#FFD700]/10 rounded-full"></div>
                        <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-[#FFD700]/10 rounded-full"></div>

                        <div class="relative z-10">
                            <!-- Badge -->
                            <div class="inline-block px-4 py-1.5 bg-[#FFD700] rounded-full mb-4">
                                <p class="text-[#0a1638] text-xs font-bold uppercase tracking-wider">
                                     Kepala Lapas
                                </p>
                            </div>

                            <!-- Foto -->
                            <div class="w-28 h-28 sm:w-32 sm:h-32 rounded-full overflow-hidden border-4 border-[#FFD700] mx-auto mb-4 bg-white shadow-2xl">
                                @if($kepalaLapas->foto && file_exists(public_path($kepalaLapas->foto)))
                                <img src="{{ asset($kepalaLapas->foto) }}"
                                     alt="{{ $kepalaLapas->nama }}"
                                     class="zoomable w-full h-full object-cover cursor-pointer">
                                @else
                                <div class="w-full h-full bg-[#0a1638] flex items-center justify-center">
                                    <i class="fas fa-user text-[#FFD700] text-5xl"></i>
                                </div>
                                @endif
                            </div>

                            <!-- Info -->
                            <h3 class="text-xl sm:text-2xl font-bold text-white">{{ $kepalaLapas->nama }}</h3>
                            <p class="text-[#FFD700] font-semibold text-sm mt-1">{{ $kepalaLapas->jabatan }}</p>
                            @if($kepalaLapas->periode)
                            <p class="text-white/70 text-xs mt-2">
                                <i class="far fa-calendar-alt mr-1"></i> {{ $kepalaLapas->periode }}
                            </p>
                            @endif
                        </div>
                    </div>
                </div>
                @endif

                <!-- ===== PEJABAT LAINNYA ===== -->
                @if($pejabatLain->count() > 0)
                <div class="mb-4">
                    <h3 class="text-sm font-bold text-[#0a1638] uppercase tracking-wider flex items-center gap-2">
                        <span class="w-1 h-5 bg-[#FFD700] rounded-full"></span>
                        Pejabat Lainnya
                    </h3>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach($pejabatLain as $item)
                    <div class="bg-gray-50 rounded-xl p-4 hover:shadow-lg hover:border-[#FFD700] transition duration-300 border border-gray-200 text-center group">

                        <!-- Foto Pejabat -->
                        <div class="w-20 h-20 rounded-full overflow-hidden border-2 border-[#FFD700] mx-auto mb-3 bg-[#0a1638] group-hover:scale-105 transition duration-300">
                            @if($item->foto && file_exists(public_path($item->foto)))
                                <img src="{{ asset($item->foto) }}"
                                     alt="{{ $item->nama }}"
                                     class="zoomable w-full h-full object-cover cursor-pointer">
                            @else
                                <div class="w-full h-full bg-[#0a1638] flex items-center justify-center">
                                    <i class="fas fa-user text-[#FFD700] text-2xl"></i>
                                </div>
                            @endif
                        </div>

                        <!-- Info Pejabat -->
                        <div>
                            <h3 class="text-xs sm:text-sm font-bold text-[#0a1638] leading-tight">{{ $item->nama }}</h3>
                            <p class="text-[#FFD700] font-semibold text-[10px] sm:text-xs mt-1">{{ $item->jabatan }}</p>
                            @if($item->periode)
                            <p class="text-gray-500 text-[10px] mt-1">
                                <i class="far fa-calendar-alt mr-1"></i> {{ $item->periode }}
                            </p>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif

                <!-- Jika Kosong -->
                @if(!$kepalaLapas && $pejabatLain->count() === 0)
                <div class="text-center text-gray-500 py-10">
                    <i class="fas fa-user-tie text-4xl text-gray-300 mb-3 block"></i>
                    <p class="text-sm">Belum ada data pejabat</p>
                </div>
                @endif

                <!-- Informasi -->
                <div class="bg-[#0a1638] text-white p-5 rounded-xl mt-8">
                    <h3 class="text-[#FFD700] text-sm sm:text-base font-bold flex items-center gap-2">
                        <i class="fas fa-info-circle"></i> Informasi
                    </h3>
                    <p class="text-white/80 mt-2 text-xs sm:text-sm leading-relaxed">
                        Untuk informasi lebih lanjut mengenai pejabat Lapas Perempuan Palangka Raya, silahkan menghubungi bagian kepegawaian.
                    </p>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection
