<!-- ===== BERITA ===== -->
<section id="berita" class="py-16 sm:py-20 bg-gray-100">
    <div class="container mx-auto px-4 sm:px-6">

        <!-- Header -->
        <div class="text-center mb-12 fade-in">
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-[#0a1638]">Berita Terkini</h2>
            <div class="section-divider"></div>
        </div>

        <!-- Grid Berita -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($berita as $item)
            @php
                $gambarUtama = $item->gambar;
                if ($item->gambars && is_array($item->gambars) && count($item->gambars) > 0) {
                    $gambarUtama = $item->gambars[0];
                }
            @endphp
            <div class="bg-white rounded-xl shadow-lg overflow-hidden fade-in hover:shadow-2xl transition-all duration-300 group">

                <!-- Image -->
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

                <!-- Content -->
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
            <div class="col-span-3 text-center text-gray-500 py-10">
                <i class="fas fa-newspaper text-4xl text-gray-300 mb-3 block"></i>
                <p class="text-sm">Belum ada berita</p>
            </div>
            @endforelse
        </div>

        <!-- Button -->
        @if($berita->count() > 0)
        <div class="text-center mt-10 fade-in">
            <a href="{{ route('berita.index') }}"
               class="inline-block bg-[#0a1638] text-white px-8 py-3 rounded-full hover:bg-[#0f1f4a] transition shadow-lg hover:shadow-xl text-sm font-semibold">
                <i class="fas fa-newspaper mr-2"></i> Lihat Semua Berita
            </a>
        </div>
        @endif
    </div>
</section>
