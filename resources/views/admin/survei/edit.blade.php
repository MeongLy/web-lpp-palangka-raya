@extends('layouts.admin')

@section('title', 'Edit Hasil Survei')

@section('content')
<div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 max-w-3xl mx-auto">
    <!-- Header -->
    <div class="flex items-center justify-between gap-3 mb-6">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-[#FFD700]/10 rounded-xl flex items-center justify-center">
                <i class="fas fa-edit text-[#FFD700]"></i>
            </div>
            <div>
                <h3 class="text-2xl font-bold text-[#0a1638]">Edit Hasil Survei</h3>
                <p class="text-sm text-gray-400">Perbarui data hasil survei</p>
            </div>
        </div>
        <a href="{{ route('admin.survei.index') }}"
           class="text-gray-400 hover:text-[#0a1638] transition text-sm font-semibold flex items-center gap-1">
            <i class="fas fa-times text-lg"></i>
        </a>
    </div>

    <!-- Placeholder -->
    <div class="p-8 bg-gradient-to-br from-[#0a1638]/5 to-[#FFD700]/5 rounded-2xl border-2 border-dashed border-[#FFD700]/30 text-center">
        <div class="w-20 h-20 bg-[#FFD700]/20 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="fas fa-tools text-[#FFD700] text-3xl"></i>
        </div>

        <h4 class="text-xl font-bold text-[#0a1638] mb-2">Form Edit Dalam Pengembangan</h4>
        <p class="text-sm text-gray-500 max-w-md mx-auto mb-6">
            Form untuk mengedit data hasil survei sedang dalam tahap pengembangan.
        </p>

        <a href="{{ route('admin.survei.index') }}"
           class="inline-flex items-center gap-2 bg-gray-100 text-gray-700 px-6 py-3 rounded-xl hover:bg-gray-200 transition text-sm font-semibold">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <!-- Info -->
    <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-xl">
        <p class="text-xs text-blue-800 flex items-start gap-2">
            <i class="fas fa-lightbulb text-blue-500 mt-0.5 flex-shrink-0"></i>
            <span>
                Fitur ini akan segera hadir dengan kemampuan <strong>input data survei</strong>, <strong>upload hasil</strong>, dan <strong>visualisasi grafik</strong>.
            </span>
        </p>
    </div>
</div>
@endsection
