<!-- ===== LAYANAN ===== -->
<section id="layanan" class="py-16 sm:py-20 bg-white">
    <div class="container mx-auto px-4 sm:px-6">

        <!-- Header -->
        <div class="text-center mb-12 fade-in">
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-[#0a1638]">Layanan Kami</h2>
            <div class="section-divider"></div>
        </div>

        <!-- Grid Layanan -->
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($layanan as $item)
            <div class="service-card bg-gray-50 p-6 rounded-xl shadow hover:shadow-xl transition-all duration-300 fade-in text-center border-b-4 border-[#FFD700]">
                <div class="w-16 h-16 bg-[#0a1638] rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas {{ $item->icon }} text-[#FFD700] text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-[#0a1638] mb-2">{{ $item->nama }}</h3>
                <p class="text-sm text-gray-600">{{ $item->deskripsi }}</p>
            </div>
            @empty
            <div class="col-span-3 text-center text-gray-500 py-10">
                <i class="fas fa-hand-holding-heart text-4xl text-gray-300 mb-3 block"></i>
                <p class="text-sm">Belum ada layanan</p>
            </div>
            @endforelse
        </div>
    </div>
</section>
