@extends('layouts.admin')

@section('title', 'Struktur Organisasi')

@section('content')
<div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 bg-[#0a1638]/10 rounded-xl flex items-center justify-center">
                <i class="fas fa-sitemap text-[#0a1638] text-xl"></i>
            </div>
            <div>
                <h3 class="text-2xl font-bold text-[#0a1638]">Struktur Organisasi</h3>
                <p class="text-sm text-gray-400">Kelola gambar bagan struktur organisasi</p>
            </div>
        </div>
        @if($strukturGambar)
        <a href="{{ route('admin.struktur.edit') }}"
           class="bg-[#0a1638] text-white px-6 py-3 rounded-xl hover:bg-[#0f1f4a] transition shadow-lg flex items-center gap-2 text-sm font-semibold">
            <i class="fas fa-edit"></i> Ganti Gambar
        </a>
        @else
        <a href="{{ route('admin.struktur.create') }}"
           class="bg-[#0a1638] text-white px-6 py-3 rounded-xl hover:bg-[#0f1f4a] transition shadow-lg flex items-center gap-2 text-sm font-semibold">
            <i class="fas fa-plus"></i> Tambah Gambar
        </a>
        @endif
    </div>

    <!-- Alert -->
    @if(session('success'))
    <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl flex items-start gap-3">
        <i class="fas fa-check-circle text-green-500 mt-0.5"></i>
        <p class="text-sm text-green-700">{{ session('success') }}</p>
    </div>
    @endif

    @if(session('error'))
    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl flex items-start gap-3">
        <i class="fas fa-exclamation-circle text-red-500 mt-0.5"></i>
        <p class="text-sm text-red-700">{{ session('error') }}</p>
    </div>
    @endif

    <!-- Preview -->
    <div class="bg-gray-50 rounded-xl border border-gray-200 p-6">
        @if($strukturGambar)
        <div class="relative w-full max-w-3xl mx-auto rounded-lg overflow-hidden bg-white border border-gray-200">
            <img src="{{ asset($strukturGambar) }}"
                 alt="Bagan Struktur Organisasi"
                 class="w-full h-auto object-contain zoomable cursor-pointer">
        </div>
        <p class="text-[10px] text-gray-400 mt-3 text-center">
            <i class="fas fa-info-circle text-[#FFD700]"></i> Klik gambar untuk memperbesar
        </p>
        @else
        <div class="w-full aspect-video flex flex-col items-center justify-center">
            <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mb-3 shadow-sm">
                <i class="fas fa-image text-gray-300 text-2xl"></i>
            </div>
            <p class="text-gray-400 text-sm">Belum ada gambar bagan struktur</p>
            <a href="{{ route('admin.struktur.create') }}"
               class="text-[#FFD700] hover:underline text-sm font-semibold mt-2 inline-block">
                Unggah gambar pertama
            </a>
        </div>
        @endif
    </div>
</div>
@endsection
