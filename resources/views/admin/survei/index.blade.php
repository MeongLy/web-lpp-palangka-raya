@extends('layouts.admin')

@section('title', 'Hasil Survei')

@section('content')
<div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 bg-[#0a1638]/10 rounded-xl flex items-center justify-center">
                <i class="fas fa-poll text-[#0a1638] text-xl"></i>
            </div>
            <div>
                <h3 class="text-2xl font-bold text-[#0a1638]">Hasil Survei</h3>
                <p class="text-sm text-gray-400">Kelola data hasil survei</p>
            </div>
        </div>
        <a href="{{ route('admin.survei.edit') }}"
           class="bg-[#0a1638] text-white px-6 py-3 rounded-xl hover:bg-[#0f1f4a] transition shadow-lg flex items-center gap-2 text-sm font-semibold">
            <i class="fas fa-edit"></i> Edit Konten
        </a>
    </div>

    <!-- Placeholder: Dalam Pengembangan -->
    <div class="p-10 bg-gradient-to-br from-[#0a1638]/5 to-[#FFD700]/5 rounded-2xl border-2 border-dashed border-[#FFD700]/30 text-center">
        <!-- Icon -->
        <div class="w-24 h-24 bg-[#FFD700]/20 rounded-full flex items-center justify-center mx-auto mb-5 relative">
            <div class="absolute inset-0 bg-[#FFD700]/30 rounded-full animate-ping"></div>
            <i class="fas fa-tools text-[#FFD700] text-4xl relative z-10"></i>
        </div>

        <!-- Text -->
        <h4 class="text-2xl font-bold text-[#0a1638] mb-2">Dalam Pengembangan</h4>
        <p class="text-sm text-gray-500 max-w-md mx-auto leading-relaxed mb-6">
            Halaman <strong>Hasil Survei</strong> sedang dalam tahap pengembangan. Fitur ini akan segera tersedia untuk mengelola data hasil survei kepuasan masyarakat.
        </p>

        <!-- Badge -->
        <div class="inline-flex items-center gap-2 px-4 py-2 bg-[#0a1638] text-[#FFD700] rounded-full text-xs font-semibold">
            <i class="fas fa-hourglass-half"></i> Coming Soon
        </div>
    </div>

    <!-- Info -->
    <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-xl">
        <p class="text-xs text-blue-800 flex items-start gap-2">
            <i class="fas fa-info-circle text-blue-500 mt-0.5 flex-shrink-0"></i>
            <span>
                Halaman ini akan menampilkan <strong>data hasil survei kepuasan masyarakat</strong> terhadap layanan Lapas Perempuan Palangka Raya. Fitur akan mencakup input data, grafik statistik, dan laporan hasil survei.
            </span>
        </p>
    </div>
</div>
@endsection
