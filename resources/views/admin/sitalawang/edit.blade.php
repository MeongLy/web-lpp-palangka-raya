@extends('layouts.admin')

@section('title', 'Edit SI-Talawang')

@section('content')
<div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 max-w-3xl mx-auto">
    <!-- Header -->
    <div class="flex items-center justify-between gap-3 mb-6">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-[#FFD700]/10 rounded-xl flex items-center justify-center">
                <i class="fas fa-edit text-[#FFD700]"></i>
            </div>
            <div>
                <h3 class="text-2xl font-bold text-[#0a1638]">Edit SI-Talawang</h3>
                <p class="text-sm text-gray-400">Perbarui konten SI-Talawang</p>
            </div>
        </div>
        <a href="{{ route('admin.sitalawang.index') }}"
           class="text-gray-400 hover:text-[#0a1638] transition text-sm font-semibold flex items-center gap-1">
            <i class="fas fa-times text-lg"></i>
        </a>
    </div>

    <form action="{{ route('admin.sitalawang.update') }}" method="POST" class="space-y-5">
        @csrf
        @method('PUT')

        <!-- Nomor WhatsApp -->
        <div>
            <label class="block text-sm font-semibold text-[#0a1638] mb-1">
                Nomor WhatsApp <span class="text-red-500">*</span>
            </label>
            <div class="relative">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-green-500">
                    <i class="fab fa-whatsapp text-lg"></i>
                </span>
                <input type="text" name="whatsapp"
                       value="{{ old('whatsapp', $pengaturan['sitalawang_whatsapp'] ?? '0813-4349-363') }}"
                       class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#FFD700] focus:border-transparent transition text-sm"
                       placeholder="0813-4349-363"
                       required>
            </div>
            <p class="text-xs text-gray-400 mt-1">
                <i class="fas fa-info-circle mr-1"></i>
                Format: <code class="bg-gray-100 px-1 rounded">0813-4349-363</code> — akan otomatis dikonversi ke link WhatsApp
            </p>
            @error('whatsapp')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Deskripsi -->
        <div>
            <label class="block text-sm font-semibold text-[#0a1638] mb-1">
                Deskripsi SI-Talawang <span class="text-red-500">*</span>
            </label>
            <textarea name="deskripsi" rows="3"
                      class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#FFD700] focus:border-transparent transition text-sm"
                      placeholder="SI-TALAWANG merupakan sistem informasi yang digunakan keluarga WBP untuk..."
                      required>{{ old('deskripsi', $pengaturan['sitalawang_deskripsi'] ?? '') }}</textarea>
            <p class="text-xs text-gray-400 mt-1">
                Tampil di bagian header halaman SI-Talawang
            </p>
            @error('deskripsi')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Cara Menggunakan -->
        <div>
            <label class="block text-sm font-semibold text-[#0a1638] mb-1">
                <i class="fas fa-question-circle text-[#FFD700] mr-1"></i>
                Cara Menggunakan
            </label>
            <textarea name="cara" rows="5"
                      class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#FFD700] focus:border-transparent transition text-sm font-mono"
                      placeholder="Simpan nomor WhatsApp SI-TALAWANG&#10;Kirim pesan dengan format &quot;Halo&quot;&#10;Pilih layanan dengan mengetik angka">{{ old('cara', $pengaturan['sitalawang_cara'] ?? '') }}</textarea>
            <p class="text-xs text-gray-400 mt-1">
                <i class="fas fa-info-circle mr-1"></i>
                Pisahkan setiap langkah dengan <kbd class="bg-gray-100 px-1 rounded text-[10px]">Enter</kbd> (baris baru)
            </p>
        </div>

        <!-- Keunggulan -->
        <div>
            <label class="block text-sm font-semibold text-[#0a1638] mb-1">
                <i class="fas fa-star text-[#FFD700] mr-1"></i>
                Keunggulan
            </label>
            <textarea name="keunggulan" rows="5"
                      class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#FFD700] focus:border-transparent transition text-sm font-mono"
                      placeholder="Informasi 24 Jam|Informasi dapat diakses 24 jam&#10;Memudahkan Keluarga WBP|Memudahkan keluarga WBP memperoleh informasi&#10;Proses Lebih Cepat|Proses lebih cepat dan transparan&#10;Pelayanan Gratis|Tidak dipungut biaya (GRATIS)">{{ old('keunggulan', $pengaturan['sitalawang_keunggulan'] ?? '') }}</textarea>
            <div class="mt-2 p-3 bg-[#FFD700]/10 border border-[#FFD700]/30 rounded-lg">
                <p class="text-xs text-[#0a1638]">
                    <i class="fas fa-lightbulb text-[#FFD700] mr-1"></i>
                    <strong>Format:</strong> <code class="bg-white px-1 rounded">Judul|Deskripsi</code>
                </p>
                <p class="text-xs text-gray-600 mt-1">
                    Pisahkan tiap item dengan <kbd class="bg-white px-1 rounded text-[10px]">Enter</kbd>. Tanda <code class="bg-white px-1 rounded">|</code> memisahkan judul dan deskripsi.
                </p>
            </div>
        </div>

        <!-- Persyaratan -->
        <div>
            <label class="block text-sm font-semibold text-[#0a1638] mb-1">
                <i class="fas fa-file-alt text-[#FFD700] mr-1"></i>
                Persyaratan Dokumen
            </label>
            <textarea name="persyaratan" rows="4"
                      class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#FFD700] focus:border-transparent transition text-sm font-mono"
                      placeholder="KTP Penjamin&#10;Kartu Keluarga Penjamin&#10;Surat Domisili Penjamin (Jika alamat tidak sesuai KTP)">{{ old('persyaratan', $pengaturan['sitalawang_persyaratan'] ?? '') }}</textarea>
            <p class="text-xs text-gray-400 mt-1">
                <i class="fas fa-info-circle mr-1"></i>
                Pisahkan setiap persyaratan dengan <kbd class="bg-gray-100 px-1 rounded text-[10px]">Enter</kbd> (baris baru)
            </p>
        </div>

        <!-- Buttons -->
        <div class="flex flex-col sm:flex-row gap-3 pt-5 border-t border-gray-200">
            <button type="submit"
                    class="bg-[#0a1638] text-white px-8 py-3 rounded-xl hover:bg-[#0f1f4a] transition shadow-lg flex items-center justify-center gap-2 text-sm font-semibold">
                <i class="fas fa-save"></i> Simpan Perubahan
            </button>
            <a href="{{ route('admin.sitalawang.index') }}"
               class="bg-gray-100 text-gray-700 px-8 py-3 rounded-xl hover:bg-gray-200 transition text-sm font-semibold text-center">
                <i class="fas fa-times mr-1"></i> Batal
            </a>
        </div>
    </form>

    <!-- Info Reset -->
    <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-xl">
        <p class="text-xs text-blue-800 flex items-start gap-2">
            <i class="fas fa-info-circle text-blue-500 mt-0.5 flex-shrink-0"></i>
            <span>
                Kosongkan field <strong>Cara</strong>, <strong>Keunggulan</strong>, atau <strong>Persyaratan</strong> jika ingin menghapus isinya.
                Konten akan tampil kosong di halaman publik.
            </span>
        </p>
    </div>
</div>
@endsection
