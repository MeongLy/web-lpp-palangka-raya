@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

<!-- ===== WELCOME SECTION ===== -->
<div class="bg-gradient-to-r from-[#0a1638] to-[#1a3270] rounded-2xl shadow-lg p-5 md:p-8 mb-6 text-white">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <div class="flex items-center gap-3">
                <div>
                    <h1 class="text-xl md:text-2xl lg:text-3xl font-bold">
                        Selamat Datang, {{ Auth::user()->name ?? 'Admin' }}!
                    </h1>
                    <p class="text-white/60 text-xs md:text-sm mt-1">
                        Kelola data Lapas Perempuan Palangka Raya
                    </p>
                </div>
            </div>
        </div>
        <div class="flex items-center gap-2 md:gap-3 flex-wrap">
            <span class="px-3 md:px-4 py-2 bg-white/10 rounded-xl text-xs md:text-sm">
                <i class="far fa-calendar-alt mr-1 md:mr-2"></i>
                <span id="realtime-date">{{ now()->format('d F Y') }}</span>
            </span>

            <span class="px-3 md:px-4 py-2 bg-[#FFD700]/20 rounded-xl text-xs md:text-sm">
                <i class="fas fa-clock mr-1 md:mr-2"></i>
                <span id="realtime-clock">{{ now()->format('H:i:s') }}</span> WIB
            </span>
        </div>
    </div>
</div>

<!-- ===== STATISTIK CARD ===== -->
<div class="grid grid-cols-2 lg:grid-cols-5 gap-3 md:gap-5 mb-6">
    <!-- Pejabat -->
    <div class="bg-white rounded-2xl shadow-sm p-4 md:p-5 border border-gray-100 hover:shadow-lg transition-all duration-300 hover:-translate-y-1 group">
        <div class="flex items-start justify-between mb-3">
            <div>
                <p class="text-gray-400 text-[10px] md:text-xs font-semibold uppercase tracking-wider">Pejabat</p>
                <p class="text-[#0a1638] text-2xl md:text-3xl font-bold mt-1">{{ $totalPejabat ?? 0 }}</p>
            </div>
            <div class="w-10 h-10 md:w-12 md:h-12 bg-[#0a1638]/10 rounded-xl flex items-center justify-center group-hover:bg-[#0a1638] transition">
                <i class="fas fa-user-tie text-[#0a1638] text-base md:text-lg group-hover:text-white transition"></i>
            </div>
        </div>
        <div class="w-full h-1 bg-gray-100 rounded-full overflow-hidden">
            <div class="h-full bg-[#0a1638] rounded-full" style="width: 100%"></div>
        </div>
        <p class="text-green-500 text-[10px] md:text-xs mt-2">
            <i class="fas fa-check-circle mr-1"></i> Aktif semua
        </p>
    </div>

    <!-- Berita -->
    <div class="bg-white rounded-2xl shadow-sm p-4 md:p-5 border border-gray-100 hover:shadow-lg transition-all duration-300 hover:-translate-y-1 group">
        <div class="flex items-start justify-between mb-3">
            <div>
                <p class="text-gray-400 text-[10px] md:text-xs font-semibold uppercase tracking-wider">Berita</p>
                <p class="text-[#0a1638] text-2xl md:text-3xl font-bold mt-1">{{ $totalBerita ?? 0 }}</p>
            </div>
            <div class="w-10 h-10 md:w-12 md:h-12 bg-[#FFD700]/10 rounded-xl flex items-center justify-center group-hover:bg-[#FFD700] transition">
                <i class="fas fa-newspaper text-[#FFD700] text-base md:text-lg group-hover:text-white transition"></i>
            </div>
        </div>
        <div class="w-full h-1 bg-gray-100 rounded-full overflow-hidden">
            <div class="h-full bg-[#FFD700] rounded-full" style="width: {{ $totalBerita ? min(($totalBerita / 10) * 100, 100) : 0 }}%"></div>
        </div>
        <p class="text-yellow-500 text-[10px] md:text-xs mt-2">
            <i class="fas fa-clock mr-1"></i> Terbaru
        </p>
    </div>

    <!-- Galeri -->
    <div class="bg-white rounded-2xl shadow-sm p-4 md:p-5 border border-gray-100 hover:shadow-lg transition-all duration-300 hover:-translate-y-1 group">
        <div class="flex items-start justify-between mb-3">
            <div>
                <p class="text-gray-400 text-[10px] md:text-xs font-semibold uppercase tracking-wider">Galeri</p>
                <p class="text-[#0a1638] text-2xl md:text-3xl font-bold mt-1">{{ $totalGaleri ?? 0 }}</p>
            </div>
            <div class="w-10 h-10 md:w-12 md:h-12 bg-purple-50 rounded-xl flex items-center justify-center group-hover:bg-purple-600 transition">
                <i class="fas fa-images text-purple-600 text-base md:text-lg group-hover:text-white transition"></i>
            </div>
        </div>
        <div class="w-full h-1 bg-gray-100 rounded-full overflow-hidden">
            <div class="h-full bg-purple-600 rounded-full" style="width: {{ $totalGaleri ? min(($totalGaleri / 20) * 100, 100) : 0 }}%"></div>
        </div>
        <p class="text-purple-500 text-[10px] md:text-xs mt-2">
            <i class="fas fa-image mr-1"></i> Foto kegiatan
        </p>
    </div>

    <!-- Layanan -->
    <div class="bg-white rounded-2xl shadow-sm p-4 md:p-5 border border-gray-100 hover:shadow-lg transition-all duration-300 hover:-translate-y-1 group">
        <div class="flex items-start justify-between mb-3">
            <div>
                <p class="text-gray-400 text-[10px] md:text-xs font-semibold uppercase tracking-wider">Layanan</p>
                <p class="text-[#0a1638] text-2xl md:text-3xl font-bold mt-1">{{ $totalLayanan ?? 0 }}</p>
            </div>
            <div class="w-10 h-10 md:w-12 md:h-12 bg-green-50 rounded-xl flex items-center justify-center group-hover:bg-green-600 transition">
                <i class="fas fa-hand-holding-heart text-green-600 text-base md:text-lg group-hover:text-white transition"></i>
            </div>
        </div>
        <div class="w-full h-1 bg-gray-100 rounded-full overflow-hidden">
            <div class="h-full bg-green-600 rounded-full" style="width: 100%"></div>
        </div>
        <p class="text-green-500 text-[10px] md:text-xs mt-2">
            <i class="fas fa-check-circle mr-1"></i> Aktif semua
        </p>
    </div>

    <!-- Pengumuman (BARU) -->
    <div class="bg-white rounded-2xl shadow-sm p-4 md:p-5 border border-gray-100 hover:shadow-lg transition-all duration-300 hover:-translate-y-1 group">
        <div class="flex items-start justify-between mb-3">
            <div>
                <p class="text-gray-400 text-[10px] md:text-xs font-semibold uppercase tracking-wider">Pengumuman</p>
                <p class="text-[#0a1638] text-2xl md:text-3xl font-bold mt-1">{{ $totalPengumuman ?? 0 }}</p>
            </div>
            <div class="w-10 h-10 md:w-12 md:h-12 bg-pink-50 rounded-xl flex items-center justify-center group-hover:bg-pink-600 transition">
                <i class="fas fa-bullhorn text-pink-600 text-base md:text-lg group-hover:text-white transition"></i>
            </div>
        </div>
        <div class="w-full h-1 bg-gray-100 rounded-full overflow-hidden">
            <div class="h-full bg-pink-600 rounded-full" style="width: {{ $totalPengumuman ? min(($totalPengumuman / 5) * 100, 100) : 0 }}%"></div>
        </div>
        <p class="text-pink-500 text-[10px] md:text-xs mt-2">
            <i class="fas fa-bullhorn mr-1"></i>
            {{ ($totalPengumumanAktif ?? 0) }} aktif
        </p>
    </div>
</div>

<!-- ===== STATISTIK DETAIL & BERITA TERBARU ===== -->
<div class="grid lg:grid-cols-3 gap-5 mb-6">

    <!-- Total Data -->
    <div class="lg:col-span-1 bg-white rounded-2xl shadow-sm p-5 md:p-6 border border-gray-100">
        <div class="flex items-center gap-2 mb-5">
            <div class="w-8 h-8 bg-[#FFD700]/10 rounded-lg flex items-center justify-center">
                <i class="fas fa-chart-bar text-[#FFD700] text-sm"></i>
            </div>
            <h4 class="text-sm font-bold text-[#0a1638] uppercase tracking-wider">Total Data</h4>
        </div>

        <div class="space-y-4">
            <!-- Pejabat -->
            <div>
                <div class="flex items-center justify-between mb-1.5">
                    <span class="text-xs md:text-sm text-gray-600">Pejabat</span>
                    <span class="text-xs md:text-sm font-bold text-[#0a1638]">{{ $totalPejabat ?? 0 }}</span>
                </div>
                <div class="w-full h-1.5 bg-gray-100 rounded-full overflow-hidden">
                    <div class="h-full bg-[#0a1638] rounded-full transition-all duration-1000"
                        style="width: {{ $totalPejabat ? min(($totalPejabat / 10) * 100, 100) : 0 }}%"></div>
                </div>
            </div>

            <!-- Berita -->
            <div>
                <div class="flex items-center justify-between mb-1.5">
                    <span class="text-xs md:text-sm text-gray-600">Berita</span>
                    <span class="text-xs md:text-sm font-bold text-[#0a1638]">{{ $totalBerita ?? 0 }}</span>
                </div>
                <div class="w-full h-1.5 bg-gray-100 rounded-full overflow-hidden">
                    <div class="h-full bg-[#FFD700] rounded-full transition-all duration-1000"
                        style="width: {{ $totalBerita ? min(($totalBerita / 10) * 100, 100) : 0 }}%"></div>
                </div>
            </div>

            <!-- Galeri -->
            <div>
                <div class="flex items-center justify-between mb-1.5">
                    <span class="text-xs md:text-sm text-gray-600">Galeri</span>
                    <span class="text-xs md:text-sm font-bold text-[#0a1638]">{{ $totalGaleri ?? 0 }}</span>
                </div>
                <div class="w-full h-1.5 bg-gray-100 rounded-full overflow-hidden">
                    <div class="h-full bg-purple-600 rounded-full transition-all duration-1000"
                        style="width: {{ $totalGaleri ? min(($totalGaleri / 20) * 100, 100) : 0 }}%"></div>
                </div>
            </div>

            <!-- Layanan -->
            <div>
                <div class="flex items-center justify-between mb-1.5">
                    <span class="text-xs md:text-sm text-gray-600">Layanan</span>
                    <span class="text-xs md:text-sm font-bold text-[#0a1638]">{{ $totalLayanan ?? 0 }}</span>
                </div>
                <div class="w-full h-1.5 bg-gray-100 rounded-full overflow-hidden">
                    <div class="h-full bg-green-600 rounded-full transition-all duration-1000"
                        style="width: {{ $totalLayanan ? min(($totalLayanan / 6) * 100, 100) : 0 }}%"></div>
                </div>
            </div>

            <!-- Pengumuman (BARU) -->
            <div>
                <div class="flex items-center justify-between mb-1.5">
                    <span class="text-xs md:text-sm text-gray-600">Pengumuman</span>
                    <span class="text-xs md:text-sm font-bold text-[#0a1638]">{{ $totalPengumuman ?? 0 }}</span>
                </div>
                <div class="w-full h-1.5 bg-gray-100 rounded-full overflow-hidden">
                    <div class="h-full bg-pink-600 rounded-full transition-all duration-1000"
                        style="width: {{ $totalPengumuman ? min(($totalPengumuman / 5) * 100, 100) : 0 }}%"></div>
                </div>
            </div>
        </div>

        <!-- Total Keseluruhan -->
        <div class="mt-5 pt-5 border-t border-gray-100">
            <div class="flex items-center justify-between p-3 bg-[#0a1638] rounded-xl">
                <span class="text-xs md:text-sm font-semibold text-white">Total Keseluruhan</span>
                <span class="text-lg md:text-xl font-bold text-[#FFD700]">
                    {{ ($totalPejabat ?? 0) + ($totalBerita ?? 0) + ($totalGaleri ?? 0) + ($totalLayanan ?? 0) + ($totalPengumuman ?? 0) }}
                </span>
            </div>
        </div>
    </div>

    <!-- Berita Terbaru -->
    <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm p-5 md:p-6 border border-gray-100">
        <div class="flex items-center justify-between mb-5">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 bg-[#FFD700]/10 rounded-lg flex items-center justify-center">
                    <i class="fas fa-newspaper text-[#FFD700] text-sm"></i>
                </div>
                <h3 class="text-base md:text-lg font-bold text-[#0a1638]">Berita Terbaru</h3>
            </div>
            <a href="{{ route('admin.berita.index') }}"
                class="text-xs md:text-sm text-[#FFD700] hover:text-[#0a1638] font-semibold transition flex items-center gap-1">
                Lihat Semua <i class="fas fa-arrow-right text-xs"></i>
            </a>
        </div>

        @if(isset($beritaTerbaru) && $beritaTerbaru->isNotEmpty())
        <div class="space-y-2 max-h-80 overflow-y-auto pr-2 custom-scroll">
            @foreach($beritaTerbaru as $item)
            <div class="flex items-center justify-between p-3 rounded-xl hover:bg-gray-50 transition group gap-3">
                <div class="flex-1 min-w-0">
                    <p class="font-semibold text-[#0a1638] text-xs md:text-sm group-hover:text-[#FFD700] transition truncate">
                        {{ $item->judul }}
                    </p>
                    <div class="flex items-center gap-2 mt-1 flex-wrap">
                        <span class="text-[10px] md:text-xs text-gray-400">
                            <i class="far fa-calendar-alt mr-1"></i> {{ $item->tanggal->format('d M Y') }}
                        </span>
                        <span class="px-2 py-0.5 rounded-full text-[10px] font-semibold {{ $item->is_published ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                            {{ $item->is_published ? 'Published' : 'Draft' }}
                        </span>
                    </div>
                </div>

                <div class="flex items-center gap-1.5 flex-shrink-0">
                    <a href="{{ route('admin.berita.edit', $item) }}"
                        class="w-7 h-7 md:w-8 md:h-8 bg-[#FFD700]/10 rounded-lg flex items-center justify-center text-[#FFD700] hover:bg-[#FFD700] hover:text-white transition"
                        title="Edit">
                        <i class="fas fa-edit text-[10px] md:text-xs"></i>
                    </a>

                    <form action="{{ route('admin.berita.destroy', $item) }}" method="POST"
                        onsubmit="event.preventDefault(); showDeleteModal(this, '{{ $item->judul }}');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="w-7 h-7 md:w-8 md:h-8 bg-red-50 rounded-lg flex items-center justify-center text-red-500 hover:bg-red-500 hover:text-white transition"
                            title="Hapus">
                            <i class="fas fa-trash text-[10px] md:text-xs"></i>
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-10">
            <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-3">
                <i class="fas fa-newspaper text-3xl text-gray-300"></i>
            </div>
            <p class="text-gray-400 text-xs md:text-sm">Belum ada berita.</p>
            <a href="{{ route('admin.berita.create') }}"
                class="inline-block mt-2 text-[#FFD700] hover:underline text-xs md:text-sm font-semibold">
                Tambah berita pertama
            </a>
        </div>
        @endif
    </div>
</div>

<!-- ===== PENGUMUMAN AKTIF (BARU) ===== -->
@if(isset($pengumumanAktif) && $pengumumanAktif->isNotEmpty())
<div class="bg-white rounded-2xl shadow-sm p-5 md:p-6 border border-gray-100 mb-6">
    <div class="flex items-center justify-between mb-5">
        <div class="flex items-center gap-3">
            <div class="w-9 h-9 bg-pink-50 rounded-lg flex items-center justify-center">
                <i class="fas fa-bullhorn text-pink-600 text-sm"></i>
            </div>
            <div>
                <h3 class="text-base md:text-lg font-bold text-[#0a1638]">Pengumuman Aktif</h3>
                <p class="text-xs text-gray-400">Pengumuman yang sedang tayang di website</p>
            </div>
        </div>
        <a href="{{ route('admin.pengumuman.index') }}"
            class="text-xs md:text-sm text-pink-600 hover:text-pink-700 font-semibold transition flex items-center gap-1">
            Kelola <i class="fas fa-arrow-right text-xs"></i>
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
        @foreach($pengumumanAktif as $item)
        <div class="p-4 bg-gradient-to-br from-pink-50 to-pink-100/50 rounded-xl border border-pink-200 hover:shadow-lg transition group">
            <div class="flex items-start gap-3">
                @if($item->gambar && file_exists(public_path($item->gambar)))
                <div class="w-12 h-12 rounded-lg overflow-hidden flex-shrink-0 bg-white">
                    <img src="{{ asset($item->gambar) }}" class="w-full h-full object-cover">
                </div>
                @else
                <div class="w-12 h-12 rounded-lg bg-pink-200 flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-bullhorn text-pink-600"></i>
                </div>
                @endif
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-bold text-[#0a1638] truncate group-hover:text-pink-600 transition">
                        {{ $item->judul }}
                    </p>
                    <p class="text-[10px] text-gray-500 mt-1 line-clamp-2">
                        {{ Str::limit($item->isi, 60) }}
                    </p>
                    <div class="flex items-center gap-2 mt-2 flex-wrap">
                        <span class="px-2 py-0.5 rounded-full text-[9px] font-bold bg-[#FFD700] text-[#0a1638] uppercase">
                            {{ $item->tipe }}
                        </span>
                        @if($item->selesai_tayang)
                        <span class="text-[9px] text-gray-500">
                            <i class="far fa-clock"></i>
                            s/d {{ $item->selesai_tayang->format('d/m') }}
                        </span>
                        @endif
                    </div>
                </div>
                <a href="{{ route('admin.pengumuman.edit', $item) }}"
                   class="w-7 h-7 bg-white rounded-lg flex items-center justify-center text-pink-600 hover:bg-pink-600 hover:text-white transition flex-shrink-0"
                   title="Edit">
                    <i class="fas fa-edit text-[10px]"></i>
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif

<!-- ===== QUICK ACTIONS ===== -->
<div class="grid grid-cols-2 md:grid-cols-5 gap-3 md:gap-4 mb-6">
    <a href="{{ route('admin.berita.create') }}"
        class="bg-white rounded-2xl shadow-sm p-4 md:p-5 border border-gray-100 hover:shadow-lg transition-all hover:-translate-y-1 group text-center">
        <div class="w-12 h-12 mx-auto bg-[#FFD700]/10 rounded-xl flex items-center justify-center group-hover:bg-[#FFD700] transition mb-3">
            <i class="fas fa-plus text-[#FFD700] text-lg group-hover:text-white transition"></i>
        </div>
        <p class="text-xs md:text-sm font-semibold text-[#0a1638]">Tambah Berita</p>
        <p class="text-[10px] md:text-xs text-gray-400">Buat berita baru</p>
    </a>

    <a href="{{ route('admin.pejabat.create') }}"
        class="bg-white rounded-2xl shadow-sm p-4 md:p-5 border border-gray-100 hover:shadow-lg transition-all hover:-translate-y-1 group text-center">
        <div class="w-12 h-12 mx-auto bg-[#0a1638]/10 rounded-xl flex items-center justify-center group-hover:bg-[#0a1638] transition mb-3">
            <i class="fas fa-user-plus text-[#0a1638] text-lg group-hover:text-white transition"></i>
        </div>
        <p class="text-xs md:text-sm font-semibold text-[#0a1638]">Tambah Pejabat</p>
        <p class="text-[10px] md:text-xs text-gray-400">Tambah data pejabat</p>
    </a>

    <a href="{{ route('admin.galeri.create') }}"
        class="bg-white rounded-2xl shadow-sm p-4 md:p-5 border border-gray-100 hover:shadow-lg transition-all hover:-translate-y-1 group text-center">
        <div class="w-12 h-12 mx-auto bg-purple-50 rounded-xl flex items-center justify-center group-hover:bg-purple-600 transition mb-3">
            <i class="fas fa-image text-purple-600 text-lg group-hover:text-white transition"></i>
        </div>
        <p class="text-xs md:text-sm font-semibold text-[#0a1638]">Tambah Galeri</p>
        <p class="text-[10px] md:text-xs text-gray-400">Upload foto galeri</p>
    </a>

    <!-- BARU: Tambah Pengumuman -->
    <a href="{{ route('admin.pengumuman.create') }}"
        class="bg-white rounded-2xl shadow-sm p-4 md:p-5 border border-gray-100 hover:shadow-lg transition-all hover:-translate-y-1 group text-center">
        <div class="w-12 h-12 mx-auto bg-pink-50 rounded-xl flex items-center justify-center group-hover:bg-pink-600 transition mb-3">
            <i class="fas fa-bullhorn text-pink-600 text-lg group-hover:text-white transition"></i>
        </div>
        <p class="text-xs md:text-sm font-semibold text-[#0a1638]">Tambah Pengumuman</p>
        <p class="text-[10px] md:text-xs text-gray-400">Buat pengumuman popup</p>
    </a>

    <a href="{{ route('admin.pengaturan.index') }}"
        class="bg-white rounded-2xl shadow-sm p-4 md:p-5 border border-gray-100 hover:shadow-lg transition-all hover:-translate-y-1 group text-center">
        <div class="w-12 h-12 mx-auto bg-gray-50 rounded-xl flex items-center justify-center group-hover:bg-[#0a1638] transition mb-3">
            <i class="fas fa-cog text-gray-600 text-lg group-hover:text-white transition"></i>
        </div>
        <p class="text-xs md:text-sm font-semibold text-[#0a1638]">Pengaturan</p>
        <p class="text-[10px] md:text-xs text-gray-400">Kelola pengaturan</p>
    </a>
</div>

<!-- ===== CUSTOM SCROLL ===== -->
<style>
    .custom-scroll::-webkit-scrollbar {
        width: 4px;
    }

    .custom-scroll::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }

    .custom-scroll::-webkit-scrollbar-thumb {
        background: #FFD700;
        border-radius: 10px;
    }

    .custom-scroll::-webkit-scrollbar-thumb:hover {
        background: #e6c200;
    }

    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>

@push('scripts')
<script>
    // ========================================
    // REALTIME CLOCK & DATE
    // ========================================
    function updateRealtimeClock() {
        const now = new Date();

        const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                       'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        const dayName = days[now.getDay()];
        const day = now.getDate();
        const monthName = months[now.getMonth()];
        const year = now.getFullYear();

        const dateString = `${dayName}, ${day} ${monthName} ${year}`;

        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');
        const timeString = `${hours}:${minutes}:${seconds}`;

        const dateElement = document.getElementById('realtime-date');
        const clockElement = document.getElementById('realtime-clock');

        if (dateElement) dateElement.textContent = dateString;
        if (clockElement) clockElement.textContent = timeString;
    }

    updateRealtimeClock();
    setInterval(updateRealtimeClock, 1000);
</script>
@endpush

@endsection
