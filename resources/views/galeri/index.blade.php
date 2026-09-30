@extends('layouts.app')

@section('content')
<!-- ===== BREADCRUMB ===== -->
<section class="bg-[#0a1638] py-8 sm:py-10 mt-16">
    <div class="container mx-auto px-4 sm:px-6">
        <p class="text-xs sm:text-sm text-white/70">
            <a href="{{ route('home') }}" class="text-[#FFD700] hover:text-[#FFE44D] transition">Beranda</a>
            <span class="text-white/50 mx-2">/</span>
            <span class="text-[#FFD700]">Galeri</span>
        </p>
        <h1 class="text-2xl sm:text-3xl font-bold text-white mt-2">Galeri & Produk</h1>
        <p class="text-sm text-white/70">Dokumentasi kegiatan dan produk warga binaan</p>
    </div>
</section>

<!-- ===== KONTEN ===== -->
<section class="py-10 sm:py-12 bg-gray-50">
    <div class="container mx-auto px-4 sm:px-6">
        <div class="max-w-6xl mx-auto">

            <!-- Tombol Kembali -->
            <a href="{{ route('home') }}#galeri"
               class="inline-flex items-center gap-2 text-[#0a1638] hover:text-[#FFD700] transition mb-5 font-semibold text-sm">
                <i class="fas fa-arrow-left"></i> Kembali ke Beranda
            </a>

            <!-- ===== SEARCH BOX (LIVE SEARCH) ===== -->
            <div class="bg-white rounded-2xl shadow-lg p-4 sm:p-5 mb-4">
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

                    {{-- Pertahankan filter yang sedang aktif --}}
                    @if(request('kategori'))
                    <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                    @endif
                    @if(request('jenis'))
                    <input type="hidden" name="jenis" value="{{ request('jenis') }}">
                    @endif
                    @if(request('produk'))
                    <input type="hidden" name="produk" value="{{ request('produk') }}">
                    @endif

                    <button type="submit"
                            class="px-6 py-3 bg-[#0a1638] text-white rounded-xl hover:bg-[#0f1f4a] transition font-semibold text-sm flex items-center justify-center gap-2">
                        <i class="fas fa-search"></i> Cari
                    </button>

                    @if(request('q'))
                    <a href="{{ route('galeri.index', request()->except('q')) }}"
                       class="px-4 py-3 bg-gray-100 text-gray-600 rounded-xl hover:bg-gray-200 transition font-semibold text-sm flex items-center justify-center gap-2">
                        <i class="fas fa-times"></i> Reset
                    </a>
                    @endif
                </form>

                <!-- Quick Tags -->
                <div class="flex flex-wrap items-center gap-2 mt-3">
                    <span class="text-[10px] font-bold text-gray-400 uppercase">
                        <i class="fas fa-fire text-[#FFD700]"></i> Populer:
                    </span>
                    @foreach(['Produk', 'Makanan', 'Kerajinan', 'Kegiatan'] as $tag)
                    <a href="{{ route('galeri.index', array_merge(request()->except('q'), ['q' => $tag])) }}"
                       class="px-3 py-1 rounded-full text-[10px] font-semibold transition
                              {{ request('q') == $tag ? 'bg-[#0a1638] text-white' : 'bg-gray-100 text-gray-600 hover:bg-[#FFD700]/20 hover:text-[#0a1638]' }}">
                        {{ $tag }}
                    </a>
                    @endforeach
                </div>
            </div>

            <!-- ===== FILTER ===== -->
            <div class="bg-white rounded-2xl shadow-lg p-4 sm:p-6 mb-6">
                <form method="GET" action="{{ route('galeri.index') }}"
                      class="flex flex-wrap gap-2 items-center">

                    <span class="text-xs font-bold text-gray-400 uppercase mr-2">
                        <i class="fas fa-filter"></i> Filter:
                    </span>

                    {{-- Pertahankan search --}}
                    @if(request('q'))
                    <input type="hidden" name="q" value="{{ request('q') }}">
                    @endif

                    <!-- Kategori -->
                    <select name="kategori" onchange="this.form.submit()"
                            class="px-3 py-1.5 rounded-full text-xs font-semibold border-2 border-gray-200 bg-white text-gray-600 focus:border-[#0a1638] focus:outline-none cursor-pointer">
                        <option value="">Semua Kategori</option>
                        @foreach($kategoris as $k)
                        <option value="{{ $k }}" @selected(request('kategori') == $k)>{{ $k }}</option>
                        @endforeach
                    </select>

                    <!-- Jenis -->
                    <select name="jenis" onchange="this.form.submit()"
                            class="px-3 py-1.5 rounded-full text-xs font-semibold border-2 border-gray-200 bg-white text-gray-600 focus:border-[#0a1638] focus:outline-none cursor-pointer">
                        <option value="">Semua Jenis</option>
                        @foreach($jenisList as $j)
                        <option value="{{ $j }}" @selected(request('jenis') == $j)>{{ $j }}</option>
                        @endforeach
                    </select>

                    <!-- Produk Saja -->
                    <label class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-semibold border-2 border-gray-200 bg-white text-gray-600 cursor-pointer hover:border-[#FFD700] transition">
                        <input type="checkbox" name="produk" value="1"
                               @checked(request('produk'))
                               onchange="this.form.submit()"
                               class="rounded text-[#FFD700] focus:ring-[#FFD700]">
                        Produk Saja
                    </label>

                    <!-- Reset -->
                    @if(request()->hasAny(['q', 'kategori', 'jenis', 'produk']))
                    <a href="{{ route('galeri.index') }}"
                       class="px-3 py-1.5 rounded-full text-xs font-semibold bg-red-50 text-red-500 hover:bg-red-500 hover:text-white transition">
                        <i class="fas fa-times"></i> Reset Semua
                    </a>
                    @endif

                    <!-- Info hasil -->
                    <span class="ml-auto text-xs text-gray-400">
                        <i class="fas fa-info-circle"></i>
                        {{ $galeri->total() }} item ditemukan
                    </span>
                </form>
            </div>

            <!-- ===== GRID GALERI ===== -->
            @if($galeri->isNotEmpty())
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach($galeri as $item)
                <a href="{{ route('galeri.detail', $item->slug) }}"
                   class="group overflow-hidden rounded-lg shadow-md hover:shadow-xl transition bg-white block">

                    <div class="relative overflow-hidden aspect-square">
                        <img src="{{ asset($item->gambar) }}"
                             alt="{{ $item->judul }}"
                             class="w-full h-full object-cover group-hover:scale-110 transition duration-500">

                        <!-- Overlay -->
                        <div class="absolute inset-0 bg-[#0a1638] opacity-0 group-hover:opacity-40 transition duration-300"></div>

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

                        <!-- Jenis Badge -->
                        @if($item->jenis)
                        <div class="absolute top-2 right-2 bg-[#FFD700] text-[#0a1638] px-2 py-0.5 rounded-full text-[10px] font-bold">
                            {{ $item->jenis }}
                        </div>
                        @endif

                        <!-- Harga Badge -->
                        @if($item->is_produk && $item->harga)
                        <div class="absolute bottom-2 right-2 bg-[#FFD700] text-[#0a1638] px-2 py-1 rounded-lg text-[10px] font-bold shadow-lg">
                            {{ $item->harga_rupiah }}
                        </div>
                        @endif
                    </div>

                    <!-- Info Bawah -->
                    <div class="p-3">
                        <h3 class="text-xs font-bold text-[#0a1638] truncate">
                            {{ $item->judul }}
                        </h3>
                        @if($item->jenis)
                        <p class="text-[10px] text-gray-400 mt-0.5 truncate">{{ $item->jenis }}</p>
                        @endif

                        @if($item->is_produk && !$item->stok_tersedia)
                        <p class="text-[10px] text-red-500 font-semibold mt-1">
                            <i class="fas fa-times-circle"></i> Stok Habis
                        </p>
                        @endif
                    </div>
                </a>
                @endforeach
            </div>

            <!-- ===== PAGINATION ===== -->
            <div class="mt-8">
                {{ $galeri->withQueryString()->links() }}
            </div>
            @else
            <!-- Empty State -->
            <div class="text-center text-gray-500 py-16 bg-white rounded-2xl shadow-lg">
                <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-search text-gray-300 text-3xl"></i>
                </div>
                <h3 class="text-lg font-bold text-[#0a1638] mb-1">Tidak Ada Hasil</h3>
                <p class="text-sm text-gray-500 mb-4">
                    @if(request('q'))
                    Tidak ada hasil untuk "<strong>{{ request('q') }}</strong>"
                    @else
                    Tidak ada galeri yang cocok dengan filter yang dipilih
                    @endif
                </p>
                <a href="{{ route('galeri.index') }}"
                   class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#0a1638] text-white rounded-full text-sm font-semibold hover:bg-[#0f1f4a] transition">
                    <i class="fas fa-redo"></i> Lihat Semua Galeri
                </a>
            </div>
            @endif

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
