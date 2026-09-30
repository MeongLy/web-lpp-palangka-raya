@php
    use App\Models\Pengaturan;

    // Ambil pengaturan (group kontak — tempat hero disimpan)
    $st = Pengaturan::getGroup('kontak');

    // Hero background + cek file ada
    $heroBg = $st['hero_background'] ?? 'images/images3.jpeg';
    $heroBgExists = $heroBg && file_exists(public_path($heroBg));

    // Overlay opacity (default 70 kalau belum di-set)
    $heroOverlay = (int) ($st['hero_overlay_opacity'] ?? 70);
@endphp

<!-- ===== BERANDA (HERO) ===== -->
<section id="beranda" class="min-h-screen flex items-center relative overflow-hidden">

    <!-- Background Image -->
    <div class="absolute inset-0 z-0">
        @if($heroBgExists)
        <img src="{{ asset($heroBg) }}"
             alt="Background"
             class="w-full h-full object-cover">
        @else
        {{-- Fallback: gradient kalau tidak ada gambar --}}
        <div class="w-full h-full bg-gradient-to-br from-[#0a1638] via-[#0f1f4a] to-[#14285c]"></div>
        @endif

        <!-- Overlay Biru Tua (dinamis dari pengaturan) -->
        <div class="absolute inset-0 bg-[#0a1638]"
             style="opacity: {{ $heroOverlay / 100 }};"></div>
    </div>

    <!-- Content -->
    <div class="container mx-auto px-6 sm:px-8 relative z-10">
        <div class="flex flex-col items-center text-center max-w-3xl mx-auto">

            <!-- Heading -->
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold leading-tight text-white drop-shadow-lg">
                Lapas Perempuan
                <br>
                <span class="text-[#FFD700]">
                    Kelas IIA Palangka Raya
                </span>
            </h1>

            <!-- Divider -->
            <div class="w-16 h-1 bg-[#FFD700] rounded-full my-7"></div>

            <!-- Description -->
            <p class="text-sm sm:text-base md:text-lg text-white/90 max-w-xl leading-relaxed">
                Tempat pembinaan dan rehabilitasi bagi warga binaan perempuan dengan pendekatan humanis dan profesional.
            </p>

            <!-- Motto -->
            <p class="text-[#FFD700] font-medium mt-6 text-xs sm:text-sm md:text-base tracking-wide">
                "Melayani dengan Hati, Membina dengan Profesionalisme"
            </p>

            <!-- Buttons -->
            <!-- <div class="mt-12 flex flex-wrap gap-3 justify-center">
                <a href="#profil"
                   class="bg-[#FFD700] text-[#0a1638] font-semibold px-7 py-3 md:px-9 md:py-3.5 rounded-full hover:bg-[#FFE44D] transition shadow-lg hover:shadow-xl inline-flex items-center gap-2 text-sm md:text-base">
                    <i class="fas fa-info-circle"></i>
                    Pelajari Lebih Lanjut
                </a>
                <a href="#kontak"
                   class="border-2 border-white/80 text-white px-7 py-3 md:px-9 md:py-3.5 rounded-full hover:bg-white hover:text-[#0a1638] transition inline-flex items-center gap-2 text-sm md:text-base">
                    <i class="fas fa-phone"></i>
                    Hubungi Kami
                </a>
            </div> -->

        </div>
    </div>

</section>
