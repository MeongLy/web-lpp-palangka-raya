<!-- ===== GALERI ===== -->
<section id="galeri" class="py-16 sm:py-20 bg-white">
    <div class="container mx-auto px-4 sm:px-6">

        <!-- Header -->
        <div class="text-center mb-10 fade-in">
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-[#0a1638]">
                Galeri Kegiatan & Produk Bawi's
            </h2>
            <div class="section-divider"></div>
            <p class="text-sm text-gray-500 mt-2">
                Dokumentasi kegiatan dan produk warga binaan Lapas Perempuan Palangka Raya
            </p>
        </div>

        @if($galeri->isNotEmpty())

        <!-- ===== GRID GALERI (HANYA 5) ===== -->
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4 mb-10">
            @foreach($galeri as $item)
            <a href="{{ route('galeri.detail', $item->slug) }}"
               class="group overflow-hidden rounded-lg shadow-md hover:shadow-xl transition bg-white block fade-in">

                <div class="relative overflow-hidden aspect-square">
                    <img src="{{ asset($item->gambar) }}"
                         alt="{{ $item->judul }}"
                         class="w-full h-full object-cover group-hover:scale-110 transition duration-500">

                    <!-- Overlay -->
                    <div class="absolute inset-0 bg-[#0a1638] opacity-0 group-hover:opacity-50 transition duration-300"></div>

                    <!-- Icon -->
                    <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
                        <i class="fas fa-eye text-white text-2xl"></i>
                    </div>

                    <!-- Kategori Badge -->
                    @if($item->kategori)
                    <div class="absolute top-2 left-2 bg-[#0a1638] text-white px-2 py-0.5 rounded-full text-[10px] font-bold uppercase">
                        {{ $item->kategori }}
                    </div>
                    @endif

                    <!-- Judul (muncul saat hover) -->
                    @if($item->judul)
                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/80 to-transparent p-2 opacity-0 group-hover:opacity-100 transition duration-300">
                        <p class="text-white text-xs font-medium truncate">{{ $item->judul }}</p>
                    </div>
                    @endif
                </div>
            </a>
            @endforeach
        </div>

        <!-- ===== TOMBOL LIHAT LEBIH BANYAK ===== -->
        @if($galeriTotal > 5)
        <div class="text-center">
            <a href="{{ route('galeri.index') }}"
               class="inline-flex items-center gap-2 px-8 py-3 bg-[#0a1638] text-white rounded-full font-semibold hover:bg-[#FFD700] hover:text-[#0a1638] transition shadow-lg hover:shadow-xl">
                <i class="fas fa-images"></i>
                Lihat Lebih Banyak
            </a>
        </div>
        @endif

        @else
        <!-- Empty State -->
        <div class="text-center text-gray-500 py-12">
            <i class="fas fa-images text-4xl text-gray-300 mb-3 block"></i>
            <p class="text-sm">Belum ada galeri</p>
        </div>
        @endif

    </div>
</section>
