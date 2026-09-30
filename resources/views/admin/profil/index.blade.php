@extends('layouts.admin')

@section('title', 'Profil')

@section('content')
<div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 bg-[#0a1638]/10 rounded-xl flex items-center justify-center">
                <i class="fas fa-building text-[#0a1638] text-xl"></i>
            </div>
            <div>
                <h3 class="text-2xl font-bold text-[#0a1638]">Profil Lapas</h3>
                <p class="text-sm text-gray-400">Kelola profil Lapas Perempuan</p>
            </div>
        </div>
        <a href="{{ route('admin.profil.edit') }}" class="bg-[#0a1638] text-white px-6 py-3 rounded-xl hover:bg-[#0f1f4a] transition shadow-lg flex items-center gap-2 text-sm font-semibold">
            <i class="fas fa-edit"></i> Edit Profil
        </a>
    </div>

    @if($profil)
    <div class="space-y-5">

        <!-- Foto Gedung -->
        @if($profil->foto_gedung && file_exists(public_path($profil->foto_gedung)))
        <div>
            <label class="text-xs font-bold text-gray-400 uppercase tracking-wider">Foto Gedung</label>
            <div class="mt-2 w-48 h-32 rounded-xl overflow-hidden border-2 border-[#FFD700]/30">
                <img src="{{ asset($profil->foto_gedung) }}" alt="Foto Gedung" class="w-full h-full object-cover">
            </div>
        </div>
        @endif

        <!-- Sejarah -->
        <div class="p-4 bg-gray-50 rounded-xl border-l-4 border-[#FFD700]">
            <label class="text-xs font-bold text-[#0a1638] uppercase tracking-wider flex items-center gap-2 mb-2">
                <i class="fas fa-history text-[#FFD700]"></i> Sejarah
            </label>
            <p class="text-sm text-gray-700 leading-relaxed whitespace-pre-line">
                {{ $profil->sejarah ?? 'Belum diisi' }}
            </p>
        </div>

        <!-- Visi -->
        <div class="p-4 bg-gray-50 rounded-xl border-l-4 border-[#FFD700]">
            <label class="text-xs font-bold text-[#0a1638] uppercase tracking-wider flex items-center gap-2 mb-2">
                <i class="fas fa-eye text-[#FFD700]"></i> Visi
            </label>
            <p class="text-sm text-gray-700 leading-relaxed">
                {{ $profil->visi ?? 'Belum diisi' }}
            </p>
        </div>

        <!-- Misi -->
        <div class="p-4 bg-gray-50 rounded-xl border-l-4 border-[#FFD700]">
            <label class="text-xs font-bold text-[#0a1638] uppercase tracking-wider flex items-center gap-2 mb-2">
                <i class="fas fa-bullseye text-[#FFD700]"></i> Misi
            </label>
            <p class="text-sm text-gray-700 leading-relaxed whitespace-pre-line">
                {{ $profil->misi ?? 'Belum diisi' }}
            </p>
        </div>

        <!-- Tupoksi -->
        <div class="p-4 bg-gray-50 rounded-xl border-l-4 border-[#FFD700]">
            <label class="text-xs font-bold text-[#0a1638] uppercase tracking-wider flex items-center gap-2 mb-2">
                <i class="fas fa-tasks text-[#FFD700]"></i> Tugas Pokok & Fungsi
            </label>
            <p class="text-sm text-gray-700 leading-relaxed whitespace-pre-line">
                {{ $profil->tupoksi ?? 'Belum diisi' }}
            </p>
        </div>
    </div>
    @else
    <div class="text-center py-12">
        <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="fas fa-building text-gray-300 text-3xl"></i>
        </div>
        <p class="text-gray-400 text-sm mb-3">Profil belum diisi</p>
        <a href="{{ route('admin.profil.edit') }}" class="inline-block bg-[#0a1638] text-white px-6 py-2 rounded-lg hover:bg-[#0f1f4a] transition text-sm font-semibold">
            <i class="fas fa-plus mr-2"></i> Isi Profil Sekarang
        </a>
    </div>
    @endif
</div>
@endsection
