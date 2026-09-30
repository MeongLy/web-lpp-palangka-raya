@extends('layouts.app')

@section('content')
<!-- ===== BREADCRUMB ===== -->
<section class="bg-[#0a1638] py-8 sm:py-10 mt-16">
    <div class="container mx-auto px-4 sm:px-6">
        <p class="text-xs sm:text-sm text-white/70">
            <a href="{{ route('home') }}" class="text-[#FFD700] hover:text-[#FFE44D] transition">Beranda</a>
            <span class="text-white/50 mx-2">/</span>
            <span class="text-[#FFD700]">Berita</span>
        </p>
        <h1 class="text-2xl sm:text-3xl font-bold text-white mt-2">Berita Terkini</h1>
        <p class="text-sm text-white/70">Informasi dan berita terbaru dari Lapas Perempuan Palangka Raya</p>
    </div>
</section>

<!-- ===== KONTEN ===== -->
<section class="py-10 sm:py-12 bg-gray-50">
    <div class="container mx-auto px-4 sm:px-6">
        <div class="max-w-6xl mx-auto">

            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-[#0a1638] hover:text-[#FFD700] transition mb-5 font-semibold text-sm">
                <i class="fas fa-arrow-left"></i> Kembali ke Beranda
            </a>

            <!-- Grid Berita -->
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($berita as $item)
                @php
                    $gambarUtama = $item->gambar;
                    if ($item->gambars && is_array($item->gambars) && count($item->gambars) > 0) {
                        $gambarUtama = $item->gambars[0];
                    }
                @endphp
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 group">
                    <a href="{{ route('berita.detail', $item->slug) }}" class="block relative overflow-hidden h-48">
                        <img src="{{ asset($gambarUtama ?? 'images/default-berita.jpg') }}"
                             alt="{{ $item->judul }}"
                             class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        <div class="absolute top-0 left-0 bg-[#0a1638] text-white px-3 py-1 m-2 rounded-full text-xs">
                            <i class="far fa-calendar-alt mr-1"></i> {{ $item->tanggal->format('d M Y') }}
                        </div>
                        @if($item->gambars && count($item->gambars) > 1)
                        <div class="absolute top-0 right-0 bg-[#FFD700] text-[#0a1638] px-2 py-1 m-2 rounded-full text-xs font-bold">
                            <i class="fas fa-images mr-1"></i> {{ count($item->gambars) }}
                        </div>
                        @endif
                    </a>
                    <div class="p-5">
                        <h3 class="text-lg font-bold text-[#0a1638] mb-2 line-clamp-2">
                            <a href="{{ route('berita.detail', $item->slug) }}" class="hover:text-[#FFD700] transition">
                                {{ $item->judul }}
                            </a>
                        </h3>
                        <p class="text-sm text-gray-600 mb-3 line-clamp-3">{{ $item->deskripsi }}</p>
                        <a href="{{ route('berita.detail', $item->slug) }}"
                           class="text-[#FFD700] font-semibold hover:text-[#0a1638] transition inline-flex items-center text-sm">
                            Baca Selengkapnya <i class="fas fa-arrow-right ml-1.5 text-xs"></i>
                        </a>
                    </div>
                </div>
                @empty
                <div class="col-span-3 text-center text-gray-500 py-12">
                    <i class="fas fa-newspaper text-4xl text-gray-300 mb-3 block"></i>
                    <p class="text-sm">Belum ada berita</p>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($berita->hasPages())
            <div class="mt-10 flex justify-center">
                {{ $berita->links() }}
            </div>
            @endif
        </div>
    </div>
</section>
@endsection
