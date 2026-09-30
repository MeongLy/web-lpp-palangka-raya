@extends('layouts.admin')

@section('title', 'Edit Berita')

@section('content')
<div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 max-w-3xl mx-auto">
    <!-- Header -->
    <div class="flex items-center justify-between gap-3 mb-6">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-[#FFD700]/10 rounded-xl flex items-center justify-center">
                <i class="fas fa-edit text-[#FFD700]"></i>
            </div>
            <div>
                <h3 class="text-2xl font-bold text-[#0a1638]">Edit Berita</h3>
                <p class="text-sm text-gray-400">Perbarui data berita</p>
            </div>
        </div>
        <a href="{{ route('admin.berita.index') }}"
           class="text-gray-400 hover:text-[#0a1638] transition text-sm font-semibold flex items-center gap-1">
            <i class="fas fa-times text-lg"></i>
        </a>
    </div>

    @php
        $allGambars = $berita->gambars ?? [];
        if (empty($allGambars) && $berita->gambar) {
            $allGambars = [$berita->gambar];
        }
        $allGambars = array_values(array_filter($allGambars, function($g) {
            return file_exists(public_path($g));
        }));
        $totalGambar = count($allGambars);
    @endphp

    <!-- ===== GAMBAR SAAT INI ===== -->
    @if($totalGambar > 0)
    <div class="mb-5 p-4 bg-gradient-to-br from-[#0a1638]/5 to-[#FFD700]/5 rounded-xl border border-[#FFD700]/20">
        <div class="flex items-center justify-between mb-3">
            <p class="text-sm font-semibold text-[#0a1638] flex items-center gap-2">
                <i class="fas fa-images text-[#FFD700]"></i>
                Gambar Saat Ini
                <span class="px-2 py-0.5 bg-[#0a1638] text-[#FFD700] text-[10px] font-bold rounded-full">
                    {{ $totalGambar }}/3
                </span>
            </p>
        </div>

        <div class="grid grid-cols-3 gap-3">
            @foreach($allGambars as $index => $gambar)
            <div class="relative aspect-square rounded-xl overflow-hidden border-2 {{ $index === 0 ? 'border-[#FFD700]' : 'border-gray-200' }} transition-all duration-300 hover:shadow-lg bg-white">
                <img src="{{ asset($gambar) }}" class="w-full h-full object-cover">

                <!-- Badge Utama -->
                @if($index === 0)
                <div class="absolute top-1 left-1 bg-[#FFD700] text-[#0a1638] px-2 py-0.5 rounded-full text-[10px] font-bold shadow-md">
                    <i class="fas fa-star mr-0.5"></i> Utama
                </div>
                @endif

                <!-- Tombol Hapus -->
                <label class="absolute top-1 right-1 bg-red-500 text-white w-6 h-6 rounded-full flex items-center justify-center cursor-pointer hover:bg-red-600 transition shadow-lg group">
                    <input type="checkbox" name="hapus_gambars[]" value="{{ $gambar }}" class="hidden" onchange="toggleHapus(this)">
                    <i class="fas fa-times text-xs group-hover:rotate-90 transition-transform duration-300"></i>
                </label>

                <!-- Input Hidden Keep Gambar -->
                <input type="hidden" name="keep_gambars[]" value="{{ $gambar }}" id="keep-{{ md5($gambar) }}">

                <!-- Overlay Info Hapus -->
                <div class="absolute inset-x-0 bottom-0 bg-red-500/80 text-white text-[10px] font-semibold text-center py-1 opacity-0 transition-opacity duration-300 pointer-events-none">
                    <i class="fas fa-trash mr-1"></i> Akan Dihapus
                </div>
            </div>
            @endforeach
        </div>

        <p class="text-xs text-gray-500 mt-3 flex items-center gap-1">
            <i class="fas fa-info-circle text-[#FFD700]"></i>
            Klik <span class="text-red-500 font-bold mx-1">×</span> untuk menandai gambar yang akan dihapus. <span class="font-semibold">Gambar pertama = gambar utama.</span>
        </p>
    </div>
    @endif

    <form action="{{ route('admin.berita.update', $berita) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <!-- Judul -->
        <div>
            <label class="block text-sm font-semibold text-[#0a1638] mb-1">Judul <span class="text-red-500">*</span></label>
            <input type="text" name="judul" value="{{ old('judul', $berita->judul) }}"
                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#FFD700] focus:border-transparent transition text-sm"
                   placeholder="Masukkan judul berita"
                   required>
            @error('judul')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Upload Gambar Baru -->
        <div>
            <label class="block text-sm font-semibold text-[#0a1638] mb-1">
                Tambah Gambar Baru <span class="text-gray-400 font-normal">(Total maks. 3)</span>
            </label>
            <div class="relative">
                <input type="file" name="gambars[]" id="gambars" accept="image/*" multiple class="hidden">
                <label for="gambars" class="flex flex-col items-center justify-center w-full h-40 border-2 border-dashed border-gray-300 rounded-xl cursor-pointer hover:border-[#FFD700] hover:bg-[#FFD700]/5 transition bg-gray-50">
                    <div class="flex flex-col items-center justify-center pt-5 pb-6" id="upload-placeholder">
                        <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                        <p class="text-sm text-gray-500">Klik untuk tambah gambar</p>
                        <p class="text-xs text-gray-400">Kosongkan jika tidak ingin menambah gambar</p>
                    </div>
                </label>
            </div>
            <div id="preview-container" class="hidden grid grid-cols-3 gap-3 mt-4"></div>

            @error('gambars')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
            @error('gambars.*')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Deskripsi -->
        <div>
            <label class="block text-sm font-semibold text-[#0a1638] mb-1">Deskripsi <span class="text-red-500">*</span></label>
            <textarea name="deskripsi" rows="3"
                      class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#FFD700] focus:border-transparent transition text-sm"
                      placeholder="Deskripsi singkat berita" required>{{ old('deskripsi', $berita->deskripsi) }}</textarea>
            @error('deskripsi')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Isi -->
        <div>
            <label class="block text-sm font-semibold text-[#0a1638] mb-1">Isi Berita</label>
            <textarea name="isi" rows="8"
                      class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#FFD700] focus:border-transparent transition text-sm"
                      placeholder="Isi lengkap berita">{{ old('isi', $berita->isi) }}</textarea>
        </div>

        <!-- Tanggal -->
        <div>
            <label class="block text-sm font-semibold text-[#0a1638] mb-1">Tanggal <span class="text-red-500">*</span></label>
            <input type="date" name="tanggal" value="{{ old('tanggal', $berita->tanggal->format('Y-m-d')) }}"
                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#FFD700] focus:border-transparent transition text-sm"
                   required>
            @error('tanggal')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Status -->
        <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl border border-gray-200">
            <input type="checkbox" name="is_published" id="is_published" {{ $berita->is_published ? 'checked' : '' }}
                   class="w-5 h-5 text-[#FFD700] rounded border-gray-300 focus:ring-[#FFD700]">
            <label for="is_published" class="text-sm text-gray-700 font-medium cursor-pointer">
                Publikasikan berita ini
            </label>
            <span class="ml-auto px-2 py-0.5 rounded-full text-[10px] font-semibold {{ $berita->is_published ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                {{ $berita->is_published ? 'Published' : 'Draft' }}
            </span>
        </div>

        <!-- Buttons -->
        <div class="flex gap-3 pt-4 border-t border-gray-200">
            <button type="submit" class="bg-[#0a1638] text-white px-8 py-3 rounded-xl hover:bg-[#0f1f4a] transition shadow-lg flex items-center gap-2 text-sm font-semibold">
                <i class="fas fa-save"></i> Update
            </button>
            <a href="{{ route('admin.berita.index') }}" class="bg-gray-100 text-gray-700 px-8 py-3 rounded-xl hover:bg-gray-200 transition text-sm font-semibold">
                Batal
            </a>
        </div>
    </form>
</div>

<script>
    // ========================================
    // TOGGLE HAPUS GAMBAR LAMA
    // ========================================
    function toggleHapus(checkbox) {
        const parent = checkbox.closest('.relative');
        const keepInput = parent.querySelector('input[name="keep_gambars[]"]');
        const overlay = parent.querySelector('.absolute.inset-x-0.bottom-0');

        if (checkbox.checked) {
            parent.classList.add('opacity-40', 'grayscale');
            if (keepInput) keepInput.disabled = true;
            if (overlay) overlay.style.opacity = '1';
        } else {
            parent.classList.remove('opacity-40', 'grayscale');
            if (keepInput) keepInput.disabled = false;
            if (overlay) overlay.style.opacity = '0';
        }
    }

    // ========================================
    // PREVIEW GAMBAR BARU
    // ========================================
    document.getElementById('gambars').addEventListener('change', function(e) {
        const files = Array.from(e.target.files);
        const previewContainer = document.getElementById('preview-container');
        const placeholder = document.getElementById('upload-placeholder');

        if (files.length > 3) {
            alert('Maksimal 3 gambar!');
            const dt = new DataTransfer();
            files.slice(0, 3).forEach(file => dt.items.add(file));
            e.target.files = dt.files;
        }

        previewContainer.innerHTML = '';
        previewContainer.classList.remove('hidden');
        placeholder.classList.add('hidden');

        Array.from(e.target.files).forEach(function(file, index) {
            const reader = new FileReader();
            reader.onload = function(event) {
                const div = document.createElement('div');
                div.className = 'relative aspect-square rounded-xl overflow-hidden border-2 border-[#FFD700]/30 shadow-md';
                div.innerHTML = `
                    <img src="${event.target.result}" class="w-full h-full object-cover">
                    <div class="absolute top-1 left-1 bg-[#FFD700] text-[#0a1638] px-2 py-0.5 rounded-full text-[10px] font-bold shadow">
                        <i class="fas fa-plus mr-0.5"></i> Baru ${index + 1}
                    </div>
                `;
                previewContainer.appendChild(div);
            };
            reader.readAsDataURL(file);
        });
    });
</script>
@endsection
