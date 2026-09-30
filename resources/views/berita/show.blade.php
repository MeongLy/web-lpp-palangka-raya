@extends('layouts.app')

@section('content')
<!-- ===== BREADCRUMB ===== -->
<section class="bg-[#0a1638] py-8 sm:py-10 mt-16">
    <div class="container mx-auto px-4 sm:px-6">
        <p class="text-xs sm:text-sm text-white/70">
            <a href="{{ route('home') }}" class="text-[#FFD700] hover:text-[#FFE44D] transition">Beranda</a>
            <span class="text-white/50 mx-2">/</span>
            <a href="{{ route('berita.index') }}" class="text-[#FFD700] hover:text-[#FFE44D] transition">Berita</a>
            <span class="text-white/50 mx-2">/</span>
            <span class="text-[#FFD700]">Detail</span>
        </p>
        <h1 class="text-xl sm:text-2xl md:text-3xl font-bold text-white mt-2 leading-tight">{{ $berita->judul }}</h1>
        <p class="text-sm text-white/70 mt-2">
            <i class="far fa-calendar-alt mr-1"></i> {{ $berita->tanggal->format('d F Y') }}
        </p>
    </div>
</section>

<!-- ===== KONTEN ===== -->
<section class="py-10 sm:py-12 bg-gray-50">
    <div class="container mx-auto px-4 sm:px-6">
        <div class="max-w-4xl mx-auto">

            <a href="{{ route('berita.index') }}" class="inline-flex items-center gap-2 text-[#0a1638] hover:text-[#FFD700] transition mb-5 font-semibold text-sm">
                <i class="fas fa-arrow-left"></i> Kembali ke Berita
            </a>

            <article class="bg-white rounded-2xl shadow-lg overflow-hidden">

                @php
                    $allGambars = $berita->gambars ?? [];
                    if (empty($allGambars) && $berita->gambar) {
                        $allGambars = [$berita->gambar];
                    }
                    $allGambars = array_values(array_filter($allGambars, function($g) {
                        return file_exists(public_path($g));
                    }));
                @endphp

                @if(count($allGambars) > 0)
                <!-- ===== SLIDER GAMBAR (UKURAN TETAP) ===== -->
                <div class="relative group/slider">
                    <!-- Slides Container -->
                    <div class="overflow-hidden">
                        <div class="flex transition-transform duration-500 ease-in-out" id="beritaSlider">
                            @foreach($allGambars as $index => $gambar)
                            <div class="min-w-full flex-shrink-0">
                                <div class="relative overflow-hidden h-64 sm:h-80 md:h-96">
                                    <img src="{{ asset($gambar) }}"
                                         alt="{{ $berita->judul }} - Gambar {{ $index + 1 }}"
                                         class="zoomable w-full h-full object-cover cursor-pointer">

                                    @if($index === 0 && count($allGambars) > 1)
                                    <div class="absolute top-3 left-3 bg-[#FFD700] text-[#0a1638] px-3 py-1 rounded-full text-xs font-bold uppercase shadow-lg">
                                        <i class="fas fa-star mr-1"></i> Utama
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    @if(count($allGambars) > 1)
                    <!-- Tombol Prev -->
                    <button type="button" id="prevBtn"
                            class="absolute left-3 top-1/2 -translate-y-1/2 w-10 h-10 bg-black/50 backdrop-blur text-white rounded-full flex items-center justify-center hover:bg-[#FFD700] hover:text-[#0a1638] transition opacity-0 group-hover/slider:opacity-100 z-10">
                        <i class="fas fa-chevron-left"></i>
                    </button>

                    <!-- Tombol Next -->
                    <button type="button" id="nextBtn"
                            class="absolute right-3 top-1/2 -translate-y-1/2 w-10 h-10 bg-black/50 backdrop-blur text-white rounded-full flex items-center justify-center hover:bg-[#FFD700] hover:text-[#0a1638] transition opacity-0 group-hover/slider:opacity-100 z-10">
                        <i class="fas fa-chevron-right"></i>
                    </button>

                    <!-- Counter -->
                    <div class="absolute top-3 right-3 bg-black/60 backdrop-blur text-white px-3 py-1 rounded-full text-xs font-semibold shadow-lg">
                        <i class="fas fa-camera mr-1"></i>
                        <span id="currentSlide">1</span> / {{ count($allGambars) }}
                    </div>

                    <!-- Dots Indicator -->
                    <div class="absolute bottom-3 left-1/2 -translate-x-1/2 flex gap-1.5 z-10" id="sliderDots">
                        @foreach($allGambars as $index => $gambar)
                        <button type="button"
                                class="slider-dot w-2 h-2 rounded-full transition-all duration-300 {{ $index === 0 ? 'bg-[#FFD700] w-6' : 'bg-white/50 hover:bg-white' }}"
                                data-index="{{ $index }}">
                        </button>
                        @endforeach
                    </div>
                    @endif
                </div>
                @endif

                <div class="p-6 sm:p-10">
                    <!-- Meta -->
                    <div class="flex flex-wrap items-center gap-4 mb-6 pb-6 border-b border-gray-200">
                        <div class="flex items-center gap-2 text-sm text-gray-500">
                            <i class="far fa-calendar-alt text-[#FFD700]"></i>
                            <span>{{ $berita->tanggal->format('d F Y') }}</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm text-gray-500">
                            <i class="far fa-clock text-[#FFD700]"></i>
                            <span>{{ $berita->created_at->format('H:i') }} WIB</span>
                        </div>
                        @if(count($allGambars) > 1)
                        <div class="flex items-center gap-2 text-sm text-gray-500">
                            <i class="fas fa-images text-[#FFD700]"></i>
                            <span>{{ count($allGambars) }} Foto</span>
                        </div>
                        @endif
                    </div>

                    <!-- Judul -->
                    <h2 class="text-2xl sm:text-3xl font-bold text-[#0a1638] mb-4 leading-tight">
                        {{ $berita->judul }}
                    </h2>

                    <!-- Deskripsi -->
                    <p class="text-base font-semibold text-[#0a1638] mb-6 leading-relaxed border-l-4 border-[#FFD700] pl-4">
                        {{ $berita->deskripsi }}
                    </p>

                    <!-- Isi -->
                    <div class="text-sm sm:text-base text-gray-700 leading-relaxed space-y-4">
                        {!! nl2br(e($berita->isi ?? $berita->deskripsi)) !!}
                    </div>

                    <!-- Share -->
                    <div class="mt-10 pt-6 border-t border-gray-200">
                        <p class="text-sm font-semibold text-[#0a1638] mb-3">Bagikan Berita:</p>
                        <div class="flex flex-wrap gap-2">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}"
                               target="_blank"
                               class="inline-flex items-center gap-2 px-4 py-2 bg-[#1877F2] text-white rounded-lg text-xs font-semibold hover:opacity-90 transition">
                                <i class="fab fa-facebook-f"></i> Facebook
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($berita->judul) }}"
                               target="_blank"
                               class="inline-flex items-center gap-2 px-4 py-2 bg-black text-white rounded-lg text-xs font-semibold hover:opacity-90 transition">
                                <i class="fab fa-x-twitter"></i> X
                            </a>
                            <a href="https://wa.me/?text={{ urlencode($berita->judul . ' ' . request()->url()) }}"
                               target="_blank"
                               class="inline-flex items-center gap-2 px-4 py-2 bg-[#25D366] text-white rounded-lg text-xs font-semibold hover:opacity-90 transition">
                                <i class="fab fa-whatsapp"></i> WhatsApp
                            </a>
                        </div>
                    </div>
                </div>
            </article>

            <!-- Berita Lainnya -->
            @if($beritaLain->count() > 0)
            <div class="mt-12">
                <h3 class="text-xl sm:text-2xl font-bold text-[#0a1638] mb-6 flex items-center gap-3">
                    <span class="w-1 h-6 bg-[#FFD700] rounded-full"></span>
                    Berita Lainnya
                </h3>

                <div class="grid md:grid-cols-3 gap-6">
                    @foreach($beritaLain as $item)
                    @php
                        $gambarLain = $item->gambar;
                        if ($item->gambars && is_array($item->gambars) && count($item->gambars) > 0) {
                            $gambarLain = $item->gambars[0];
                        }
                    @endphp
                    <a href="{{ route('berita.detail', $item->slug) }}"
                       class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition group">
                        <div class="h-40 overflow-hidden">
                            <img src="{{ asset($gambarLain ?? 'images/default-berita.jpg') }}"
                                 alt="{{ $item->judul }}"
                                 class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        </div>
                        <div class="p-4">
                            <p class="text-xs text-gray-400 mb-1">
                                <i class="far fa-calendar-alt mr-1"></i> {{ $item->tanggal->format('d M Y') }}
                            </p>
                            <h4 class="text-sm font-bold text-[#0a1638] line-clamp-2 group-hover:text-[#FFD700] transition">
                                {{ $item->judul }}
                            </h4>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif

        </div>
    </div>
</section>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var slider = document.getElementById('beritaSlider');
        if (!slider) return;

        var prevBtn = document.getElementById('prevBtn');
        var nextBtn = document.getElementById('nextBtn');
        var currentSlideEl = document.getElementById('currentSlide');
        var dots = document.querySelectorAll('.slider-dot');
        var totalSlides = {{ count($allGambars) }};
        var currentSlide = 0;
        var autoSlideInterval = null;

        // Fungsi update slider
        function updateSlider(index) {
            if (index < 0) index = totalSlides - 1;
            if (index >= totalSlides) index = 0;
            currentSlide = index;

            var translateX = -currentSlide * 100;
            slider.style.transform = 'translateX(' + translateX + '%)';

            if (currentSlideEl) currentSlideEl.textContent = currentSlide + 1;

            dots.forEach(function(dot, i) {
                if (i === currentSlide) {
                    dot.classList.add('bg-[#FFD700]', 'w-6');
                    dot.classList.remove('bg-white/50', 'w-2');
                } else {
                    dot.classList.remove('bg-[#FFD700]', 'w-6');
                    dot.classList.add('bg-white/50', 'w-2');
                }
            });
        }

        // ===== AUTO SLIDE 2 DETIK =====
        function startAutoSlide() {
            if (totalSlides > 1) {
                autoSlideInterval = setInterval(function() {
                    updateSlider(currentSlide + 1);
                }, 5000);
            }
        }

        function stopAutoSlide() {
            if (autoSlideInterval) {
                clearInterval(autoSlideInterval);
                autoSlideInterval = null;
            }
        }

        // Mulai auto slide
        startAutoSlide();

        // Pause auto slide saat hover (desktop)
        var sliderContainer = slider.closest('.group\\/slider');
        if (sliderContainer) {
            sliderContainer.addEventListener('mouseenter', stopAutoSlide);
            sliderContainer.addEventListener('mouseleave', startAutoSlide);
        }

        // Navigasi Prev
        if (prevBtn) {
            prevBtn.addEventListener('click', function() {
                stopAutoSlide();
                updateSlider(currentSlide - 1);
                startAutoSlide();
            });
        }

        // Navigasi Next
        if (nextBtn) {
            nextBtn.addEventListener('click', function() {
                stopAutoSlide();
                updateSlider(currentSlide + 1);
                startAutoSlide();
            });
        }

        // Navigasi Dots
        dots.forEach(function(dot) {
            dot.addEventListener('click', function() {
                stopAutoSlide();
                var index = parseInt(this.dataset.index);
                updateSlider(index);
                startAutoSlide();
            });
        });

        // Keyboard Navigation
        document.addEventListener('keydown', function(e) {
            if (e.key === 'ArrowLeft') {
                stopAutoSlide();
                updateSlider(currentSlide - 1);
                startAutoSlide();
            }
            if (e.key === 'ArrowRight') {
                stopAutoSlide();
                updateSlider(currentSlide + 1);
                startAutoSlide();
            }
        });

        // ===== TOUCH SWIPE SUPPORT =====
        var touchStartX = 0;
        var touchEndX = 0;

        slider.addEventListener('touchstart', function(e) {
            touchStartX = e.changedTouches[0].screenX;
            stopAutoSlide();
        }, { passive: true });

        slider.addEventListener('touchend', function(e) {
            touchEndX = e.changedTouches[0].screenX;
            var diff = touchStartX - touchEndX;
            if (Math.abs(diff) > 50) {
                if (diff > 0) updateSlider(currentSlide + 1);
                else updateSlider(currentSlide - 1);
            }
            startAutoSlide();
        }, { passive: true });

        // Pause saat tab tidak aktif (hemat resource)
        document.addEventListener('visibilitychange', function() {
            if (document.hidden) {
                stopAutoSlide();
            } else {
                startAutoSlide();
            }
        });
    });
</script>
@endpush
@endsection
