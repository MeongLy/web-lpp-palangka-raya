@extends('layouts.admin')

@section('title', 'SI-Talawang')

@section('content')
<div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 bg-[#0a1638]/10 rounded-xl flex items-center justify-center">
                <i class="fas fa-balance-scale text-[#0a1638] text-xl"></i>
            </div>
            <div>
                <h3 class="text-2xl font-bold text-[#0a1638]">SI-Talawang</h3>
                <p class="text-sm text-gray-400">Kelola konten SI-Talawang</p>
            </div>
        </div>
        <a href="{{ route('admin.sitalawang.edit') }}"
           class="bg-[#0a1638] text-white px-6 py-3 rounded-xl hover:bg-[#0f1f4a] transition shadow-lg flex items-center gap-2 text-sm font-semibold">
            <i class="fas fa-edit"></i> Edit Konten
        </a>
    </div>

    @php
        $whatsapp = $pengaturan['sitalawang_whatsapp'] ?? '-';
        $deskripsi = $pengaturan['sitalawang_deskripsi'] ?? 'Belum diisi';
        $cara = $pengaturan['sitalawang_cara'] ?? '';
        $keunggulan = $pengaturan['sitalawang_keunggulan'] ?? '';
        $persyaratan = $pengaturan['sitalawang_persyaratan'] ?? '';

        $caraList = array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $cara)));
        $keunggulanList = array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $keunggulan)));
        $persyaratanList = array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $persyaratan)));
    @endphp

    <!-- Preview Konten -->
    <div class="space-y-5">

        <!-- WhatsApp -->
        <div class="p-5 bg-gradient-to-br from-[#0a1638] to-[#0f1f4a] rounded-xl text-white relative overflow-hidden">
            <div class="absolute -top-10 -right-10 w-32 h-32 bg-[#FFD700]/10 rounded-full"></div>
            <div class="relative z-10">
                <label class="text-xs font-bold text-[#FFD700] uppercase tracking-wider flex items-center gap-2 mb-2">
                    <i class="fab fa-whatsapp"></i> Nomor WhatsApp
                </label>
                <p class="text-2xl font-bold">{{ $whatsapp }}</p>
                <p class="text-xs text-white/60 mt-1">
                    <i class="fas fa-info-circle mr-1"></i>
                    Nomor ini digunakan untuk tombol chat SI-Talawang
                </p>
            </div>
        </div>

        <!-- Deskripsi -->
        <div class="p-5 bg-gray-50 rounded-xl border-l-4 border-[#FFD700]">
            <div class="flex items-center justify-between mb-2">
                <label class="text-xs font-bold text-[#0a1638] uppercase tracking-wider flex items-center gap-2">
                    <i class="fas fa-info-circle text-[#FFD700]"></i> Deskripsi
                </label>
                <span class="text-[10px] text-gray-400">{{ strlen($deskripsi) }} karakter</span>
            </div>
            <p class="text-sm text-gray-700 leading-relaxed">
                {{ $deskripsi }}
            </p>
        </div>

        <!-- Cara Menggunakan -->
        <div class="p-5 bg-gray-50 rounded-xl border-l-4 border-[#FFD700]">
            <div class="flex items-center justify-between mb-3">
                <label class="text-xs font-bold text-[#0a1638] uppercase tracking-wider flex items-center gap-2">
                    <i class="fas fa-question-circle text-[#FFD700]"></i> Cara Menggunakan
                </label>
                <span class="px-2 py-0.5 bg-[#0a1638] text-[#FFD700] text-[10px] font-bold rounded-full">
                    {{ count($caraList) }} langkah
                </span>
            </div>
            @if(count($caraList) > 0)
            <ul class="space-y-2">
                @foreach($caraList as $index => $item)
                <li class="flex items-start gap-2 text-sm text-gray-700">
                    <span class="w-5 h-5 bg-[#0a1638] text-white rounded-full flex items-center justify-center text-[10px] font-bold flex-shrink-0 mt-0.5">
                        {{ $index + 1 }}
                    </span>
                    <span>{{ $item }}</span>
                </li>
                @endforeach
            </ul>
            @else
            <p class="text-sm text-gray-400 italic">Belum diisi</p>
            @endif
        </div>

        <!-- Keunggulan -->
        <div class="p-5 bg-gray-50 rounded-xl border-l-4 border-[#FFD700]">
            <div class="flex items-center justify-between mb-3">
                <label class="text-xs font-bold text-[#0a1638] uppercase tracking-wider flex items-center gap-2">
                    <i class="fas fa-star text-[#FFD700]"></i> Keunggulan
                </label>
                <span class="px-2 py-0.5 bg-[#0a1638] text-[#FFD700] text-[10px] font-bold rounded-full">
                    {{ count($keunggulanList) }} item
                </span>
            </div>
            @if(count($keunggulanList) > 0)
            <ul class="space-y-2">
                @foreach($keunggulanList as $item)
                    @php
                        $parts = explode('|', $item);
                        $judul = $parts[0] ?? $item;
                        $sub = $parts[1] ?? '';
                    @endphp
                    <li class="flex items-start gap-2 text-sm text-gray-700 p-2 bg-white rounded-lg border border-gray-100">
                        <i class="fas fa-check-circle text-[#FFD700] mt-0.5 flex-shrink-0"></i>
                        <div>
                            <span class="font-semibold">{{ $judul }}</span>
                            @if($sub)
                            <p class="text-xs text-gray-500 mt-0.5">{{ $sub }}</p>
                            @endif
                        </div>
                    </li>
                @endforeach
            </ul>
            @else
            <p class="text-sm text-gray-400 italic">Belum diisi</p>
            @endif
        </div>

        <!-- Persyaratan -->
        <div class="p-5 bg-gray-50 rounded-xl border-l-4 border-[#FFD700]">
            <div class="flex items-center justify-between mb-3">
                <label class="text-xs font-bold text-[#0a1638] uppercase tracking-wider flex items-center gap-2">
                    <i class="fas fa-file-alt text-[#FFD700]"></i> Persyaratan Dokumen
                </label>
                <span class="px-2 py-0.5 bg-[#0a1638] text-[#FFD700] text-[10px] font-bold rounded-full">
                    {{ count($persyaratanList) }} syarat
                </span>
            </div>
            @if(count($persyaratanList) > 0)
            <ol class="space-y-2">
                @foreach($persyaratanList as $index => $item)
                <li class="flex items-start gap-2 text-sm text-gray-700">
                    <span class="w-5 h-5 bg-[#0a1638] text-white rounded-full flex items-center justify-center text-[10px] font-bold flex-shrink-0 mt-0.5">
                        {{ $index + 1 }}
                    </span>
                    <span>{{ $item }}</span>
                </li>
                @endforeach
            </ol>
            @else
            <p class="text-sm text-gray-400 italic">Belum diisi</p>
            @endif
        </div>

    </div>

    <!-- Info -->
    <div class="mt-6 p-4 bg-[#FFD700]/10 border border-[#FFD700]/30 rounded-xl">
        <p class="text-xs text-[#0a1638] flex items-start gap-2">
            <i class="fas fa-lightbulb text-[#FFD700] mt-0.5 flex-shrink-0"></i>
            <span>
                Konten ini akan tampil di halaman <strong>SI-Talawang</strong> publik. Setiap perubahan langsung terlihat oleh pengunjung.
            </span>
        </p>
    </div>
</div>
@endsection
