@extends('layouts.app')

@section('content')
@php
    use App\Models\Pengaturan;

    // WhatsApp (fallback ke nomor sitalawang)
    $st = Pengaturan::getGroup('sitalawang');
    $whatsapp = $st['sitalawang_whatsapp'] ?? '0813-4349-363';
    $whatsappClean = preg_replace('/[^0-9]/', '', $whatsapp);
    if (substr($whatsappClean, 0, 1) === '0') {
        $whatsappClean = '62' . substr($whatsappClean, 1);
    } elseif (substr($whatsappClean, 0, 2) !== '62') {
        $whatsappClean = '62' . $whatsappClean;
    }

    // Pesan WA otomatis
    $waMessage = urlencode('Halo, saya tertarik dengan produk: ' . $item->judul);
    $waLink = 'https://wa.me/' . $whatsappClean . '?text=' . $waMessage;

    // Deskripsi: pakai `deskripsi`, fallback ke `keterangan`
    $deskripsi = $item->deskripsi ?: $item->keterangan;
@endphp

<!-- ===== BREADCRUMB ===== -->
<section class="bg-[#0a1638] py-8 sm:py-10 mt-16">
    <div class="container mx-auto px-4 sm:px-6">
        <p class="text-xs sm:text-sm text-white/70">
            <a href="{{ route('home') }}" class="text-[#FFD700] hover:text-[#FFE44D] transition">Beranda</a>
            <span class="text-white/50 mx-2">/</span>
            <a href="{{ route('galeri.index') }}" class="text-[#FFD700] hover:text-[#FFE44D] transition">Galeri</a>
            <span class="text-white/50 mx-2">/</span>
            <span class="text-[#FFD700] truncate">{{ Str::limit($item->judul, 40) }}</span>
        </p>
        <h1 class="text-2xl sm:text-3xl font-bold text-white mt-2">{{ $item->judul }}</h1>
        <p class="text-sm text-white/70">
            {{ $item->kategori }}
            @if($item->jenis) • {{ $item->jenis }} @endif
        </p>
    </div>
</section>

<!-- ===== KONTEN ===== -->
<section class="py-10 sm:py-12 bg-gray-50">
    <div class="container mx-auto px-4 sm:px-6">
        <div class="max-w-6xl mx-auto">

            <!-- ===== SEARCH BOX (LIVE SEARCH) ===== -->
            <div class="bg-white rounded-2xl shadow-lg p-4 sm:p-5 mb-6">
                <form method="GET" action="{{ route('galeri.index') }}"
                      class="flex flex-col sm:flex-row gap-3"
                      id="searchForm">

                    <div class="relative flex-1">
                        <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                        <input type="text" name="q"
                               id="liveSearchInput"
                               value="{{ request('q') }}"
                               placeholder="Cari produk atau galeri... (ketik untuk rekomendasi)"
                               autocomplete="off"
                               class="w-full pl-11 pr-4 py-3 rounded-xl border-2 border-gray-200 focus:border-[#FFD700] focus:outline-none text-sm">

                        <!-- Loading Spinner -->
                        <div id="searchLoading"
                             class="hidden absolute right-4 top-1/2 -translate-y-1/2">
                            <i class="fas fa-spinner fa-spin text-[#FFD700]"></i>
                        </div>

                        <!-- Dropdown Rekomendasi -->
                        <div id="searchResults"
                             class="hidden absolute top-full left-0 right-0 mt-2 bg-white rounded-xl shadow-2xl border border-gray-200 max-h-96 overflow-y-auto z-50">
                        </div>
                    </div>

                    @if($item->kategori)
                    <input type="hidden" name="kategori" value="{{ $item->kategori }}">
                    @endif

                    <button type="submit"
                            class="px-6 py-3 bg-[#0a1638] text-white rounded-xl hover:bg-[#0f1f4a] transition font-semibold text-sm flex items-center justify-center gap-2">
                        <i class="fas fa-search"></i> Cari
                    </button>
                </form>

                <!-- Quick Tags -->
                <div class="flex flex-wrap items-center gap-2 mt-3">
                    <span class="text-[10px] font-bold text-gray-400 uppercase">
                        <i class="fas fa-fire text-[#FFD700]"></i> Populer:
                    </span>
                    @foreach(['Produk', 'Makanan', 'Kerajinan', 'Kegiatan'] as $tag)
                    <a href="{{ route('galeri.index', ['q' => $tag]) }}"
                       class="px-3 py-1 rounded-full text-[10px] font-semibold transition
                              {{ request('q') == $tag ? 'bg-[#0a1638] text-white' : 'bg-gray-100 text-gray-600 hover:bg-[#FFD700]/20 hover:text-[#0a1638]' }}">
                        {{ $tag }}
                    </a>
                    @endforeach
                </div>
            </div>

            <!-- Tombol Kembali -->
            <a href="{{ route('galeri.index') }}"
               class="inline-flex items-center gap-2 text-[#0a1638] hover:text-[#FFD700] transition mb-5 font-semibold text-sm">
                <i class="fas fa-arrow-left"></i> Kembali ke Galeri
            </a>

            <!-- ===== KARTU DETAIL ===== -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="grid grid-cols-1 lg:grid-cols-2">

                    <!-- ===== GAMBAR ===== -->
                    <div class="relative bg-gray-100">
                        <div class="aspect-square lg:aspect-auto lg:h-full lg:min-h-[500px]">
                            <img src="{{ asset($item->gambar) }}"
                                 alt="{{ $item->judul }}"
                                 class="zoomable w-full h-full object-cover cursor-pointer">
                        </div>

                        <!-- Kategori Badge -->
                        @if($item->kategori)
                        <div class="absolute top-4 left-4 bg-[#0a1638] text-white px-3 py-1 rounded-full text-xs font-bold uppercase shadow-lg">
                            {{ $item->kategori }}
                        </div>
                        @endif

                        <!-- Produk Badge -->
                        @if($item->is_produk)
                        <div class="absolute top-4 right-4 bg-[#FFD700] text-[#0a1638] px-3 py-1 rounded-full text-xs font-bold shadow-lg">
                            <i class="fas fa-box-open mr-1"></i> Produk
                        </div>
                        @endif

                        <!-- Zoom Hint -->
                        <div class="absolute bottom-4 right-4 bg-black/60 text-white px-3 py-1.5 rounded-full text-[10px] font-semibold backdrop-blur-sm">
                            <i class="fas fa-search-plus mr-1"></i> Klik untuk zoom
                        </div>
                    </div>

                    <!-- ===== INFO ===== -->
                    <div class="p-6 sm:p-8 flex flex-col">

                        <!-- Jenis -->
                        @if($item->jenis)
                        <span class="inline-block px-3 py-1 bg-[#FFD700]/20 border border-[#FFD700]/40 rounded-full text-xs font-semibold text-[#0a1638] w-fit mb-3">
                            <i class="fas fa-tag mr-1"></i> {{ $item->jenis }}
                        </span>
                        @endif

                        <!-- Judul -->
                        <h2 class="text-2xl sm:text-3xl font-bold text-[#0a1638] mb-3 leading-tight">
                            {{ $item->judul }}
                        </h2>

                        <!-- ===== HARGA (kalau produk) ===== -->
                        @if($item->is_produk && $item->harga)
                        <div class="mb-5 p-4 bg-gradient-to-br from-[#0a1638] to-[#0f1f4a] rounded-xl shadow-lg">
                            <p class="text-xs text-[#FFD700] font-bold uppercase tracking-wider mb-1">
                                <i class="fas fa-tag mr-1"></i> Harga
                            </p>
                            <div class="flex items-baseline gap-2 flex-wrap">
                                <p class="text-3xl sm:text-4xl font-bold text-white">
                                    {{ $item->harga_rupiah }}
                                </p>
                                @if($item->satuan)
                                <span class="text-sm text-white/60">/ {{ $item->satuan }}</span>
                                @endif
                            </div>

                            @if($item->stok !== null)
                            <div class="mt-3 pt-3 border-t border-white/10">
                                @if($item->stok_tersedia)
                                <p class="text-xs text-white/80">
                                    <i class="fas fa-check-circle text-green-400 mr-1"></i>
                                    Stok tersedia: <span class="font-bold text-[#FFD700]">{{ $item->stok }}</span>
                                    {{ $item->satuan ?? 'unit' }}
                                </p>
                                @else
                                <p class="text-xs text-red-400 font-bold">
                                    <i class="fas fa-times-circle mr-1"></i> Stok Habis
                                </p>
                                @endif
                            </div>
                            @endif
                        </div>
                        @endif

                        <!-- ===== DESKRIPSI ===== -->
                        @if($deskripsi)
                        <div class="mb-6">
                            <h3 class="text-sm font-bold text-[#0a1638] mb-2 flex items-center gap-2">
                                <i class="fas fa-align-left text-[#FFD700]"></i> Deskripsi
                            </h3>
                            <div class="text-sm text-gray-600 leading-relaxed whitespace-pre-line">
                                {{ $deskripsi }}
                            </div>
                        </div>
                        @endif

                        <!-- ===== CTA ===== -->
                        <div class="mt-auto pt-6 border-t border-gray-200 flex flex-col sm:flex-row gap-3">
                            @if($item->is_produk && $item->stok_tersedia)
                            <a href="{{ $waLink }}"
                               target="_blank" rel="noopener noreferrer"
                               class="flex-1 inline-flex items-center justify-center gap-2 px-6 py-3 bg-[#25D366] text-white rounded-full font-bold hover:bg-[#1eb855] transition shadow-lg hover:shadow-xl">
                                <i class="fab fa-whatsapp text-lg"></i> Tanya via WhatsApp
                            </a>
                            @elseif($item->is_produk && !$item->stok_tersedia)
                            <button disabled
                                    class="flex-1 inline-flex items-center justify-center gap-2 px-6 py-3 bg-gray-300 text-gray-500 rounded-full font-bold cursor-not-allowed">
                                <i class="fas fa-times-circle"></i> Stok Habis
                            </button>
                            @endif

                            <a href="{{ route('galeri.index') }}"
                               class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-gray-100 text-gray-600 rounded-full font-semibold hover:bg-gray-200 transition">
                                <i class="fas fa-images"></i> Galeri Lain
                            </a>
                        </div>

                    </div>
                </div>
            </div>

            <!-- ===== PRODUK TERKAIT (SELALU TERBARU) ===== -->
            @if($terkait->isNotEmpty())
            <div class="mt-10">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-bold text-[#0a1638]">
                        <i class="fas fa-th text-[#FFD700] mr-2"></i>
                        {{ $item->is_produk ? 'Produk Terbaru' : 'Galeri Terbaru' }}
                    </h3>
                    <a href="{{ route('galeri.index', ['kategori' => $item->kategori]) }}"
                       class="text-xs text-[#0a1638] hover:text-[#FFD700] font-semibold transition">
                        Lihat semua <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                    @foreach($terkait as $t)
                    <a href="{{ route('galeri.detail', $t->slug) }}"
                       class="group overflow-hidden rounded-lg shadow-md hover:shadow-xl transition bg-white block">

                        <div class="relative overflow-hidden aspect-square">
                            <img src="{{ asset($t->gambar) }}"
                                 alt="{{ $t->judul }}"
                                 class="w-full h-full object-cover group-hover:scale-110 transition duration-500">

                            <div class="absolute inset-0 bg-[#0a1638] opacity-0 group-hover:opacity-40 transition"></div>

                            @if($t->is_produk && $t->harga)
                            <div class="absolute bottom-2 right-2 bg-[#FFD700] text-[#0a1638] px-2 py-0.5 rounded text-[10px] font-bold shadow">
                                {{ $t->harga_rupiah }}
                            </div>
                            @endif
                        </div>

                        <div class="p-2">
                            <p class="text-xs font-bold text-[#0a1638] truncate">{{ $t->judul }}</p>
                            @if($t->jenis)
                            <p class="text-[10px] text-gray-400 truncate">{{ $t->jenis }}</p>
                            @endif
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- ===== INFO TAMBAHAN ===== -->
            <div class="mt-8 p-4 bg-[#0a1638] text-white rounded-xl flex items-start gap-3">
                <i class="fas fa-info-circle text-[#FFD700] text-lg mt-0.5"></i>
                <div>
                    <p class="text-sm font-bold text-[#FFD700] mb-1">Informasi</p>
                    <p class="text-xs text-white/80 leading-relaxed">
                        Semua produk yang ditampilkan adalah hasil karya warga binaan Lapas Perempuan Kelas IIA Palangka Raya.
                        Pembelian dapat dilakukan melalui WhatsApp atau langsung di Lapas.
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('liveSearchInput');
    const resultsBox = document.getElementById('searchResults');
    const loading = document.getElementById('searchLoading');

    if (!input || !resultsBox) return;

    let debounceTimer = null;
    let currentRequest = null;

    // ===== INPUT HANDLER =====
    input.addEventListener('input', function () {
        const keyword = this.value.trim();

        clearTimeout(debounceTimer);

        if (keyword.length < 2) {
            hideResults();
            return;
        }

        debounceTimer = setTimeout(() => {
            fetchResults(keyword);
        }, 300);
    });

    // ===== FETCH RESULTS =====
    function fetchResults(keyword) {
        if (currentRequest) currentRequest.abort();

        loading.classList.remove('hidden');

        const controller = new AbortController();
        currentRequest = controller;

        fetch(`{{ route('galeri.search') }}?q=${encodeURIComponent(keyword)}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            },
            signal: controller.signal,
        })
        .then(res => res.json())
        .then(data => {
            loading.classList.add('hidden');
            renderResults(data.results, keyword);
        })
        .catch(err => {
            if (err.name !== 'AbortError') {
                loading.classList.add('hidden');
                console.error('Search error:', err);
            }
        });
    }

    // ===== RENDER RESULTS =====
    function renderResults(results, keyword) {
        if (!results || results.length === 0) {
            resultsBox.innerHTML = `
                <div class="p-4 text-center">
                    <i class="fas fa-search text-gray-300 text-2xl mb-2"></i>
                    <p class="text-sm text-gray-500">Tidak ada hasil untuk "<strong>${escapeHtml(keyword)}</strong>"</p>
                    <p class="text-xs text-gray-400 mt-1">Coba kata kunci lain</p>
                </div>
            `;
            resultsBox.classList.remove('hidden');
            return;
        }

        let html = '<div class="py-2">';

        results.forEach(item => {
            const hargaBadge = item.harga
                ? `<span class="ml-auto text-[10px] font-bold text-[#0a1638] bg-[#FFD700] px-2 py-0.5 rounded-full flex-shrink-0">${escapeHtml(item.harga)}</span>`
                : '';

            const produkBadge = item.is_produk
                ? '<span class="text-[9px] font-bold text-[#FFD700] bg-[#0a1638] px-1.5 py-0.5 rounded">PRODUK</span>'
                : '';

            html += `
                <a href="${item.url}"
                   class="flex items-center gap-3 px-4 py-2.5 hover:bg-[#FFD700]/10 transition group">
                    <div class="w-12 h-12 rounded-lg overflow-hidden bg-gray-100 flex-shrink-0 border border-gray-200">
                        <img src="${item.gambar}" alt="${escapeHtml(item.judul)}"
                             class="w-full h-full object-cover"
                             onerror="this.parentElement.innerHTML='<div class=&quot;w-full h-full flex items-center justify-center&quot;><i class=&quot;fas fa-image text-gray-300&quot;></i></div>'">
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-bold text-[#0a1638] truncate">${escapeHtml(item.judul)}</p>
                        <div class="flex items-center gap-1.5 mt-0.5 flex-wrap">
                            ${produkBadge}
                            ${item.kategori ? `<span class="text-[10px] text-gray-500">${escapeHtml(item.kategori)}</span>` : ''}
                            ${item.jenis ? `<span class="text-[10px] text-gray-400">• ${escapeHtml(item.jenis)}</span>` : ''}
                        </div>
                    </div>
                    ${hargaBadge}
                </a>
            `;
        });

        html += `
            <a href="{{ route('galeri.index') }}?q=${encodeURIComponent(keyword)}"
               class="block px-4 py-3 text-center text-xs font-bold text-[#0a1638] bg-gray-50 hover:bg-[#FFD700]/20 border-t border-gray-100 transition">
                Lihat semua hasil untuk "<strong>${escapeHtml(keyword)}</strong>"
                <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>`;

        resultsBox.innerHTML = html;
        resultsBox.classList.remove('hidden');
    }

    // ===== HIDE RESULTS =====
    function hideResults() {
        resultsBox.classList.add('hidden');
        resultsBox.innerHTML = '';
    }

    // ===== ESCAPE HTML =====
    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    // ===== CLOSE ON CLICK OUTSIDE =====
    document.addEventListener('click', function (e) {
        if (!input.contains(e.target) && !resultsBox.contains(e.target)) {
            hideResults();
        }
    });

    // ===== CLOSE ON ESC =====
    input.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            hideResults();
            input.blur();
        }
    });

    // ===== RE-OPEN ON FOCUS =====
    input.addEventListener('focus', function () {
        if (this.value.trim().length >= 2) {
            fetchResults(this.value.trim());
        }
    });
});
</script>
@endpush
@endsection
