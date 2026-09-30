@extends('layouts.admin')

@section('title', 'Tambah Berita')

@section('content')
<div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 max-w-3xl mx-auto">
    <div class="flex items-center gap-3 mb-6">
        <div class="w-10 h-10 bg-[#FFD700]/10 rounded-xl flex items-center justify-center">
            <i class="fas fa-plus text-[#FFD700]"></i>
        </div>
        <div>
            <h3 class="text-2xl font-bold text-[#0a1638]">Tambah Berita</h3>
            <p class="text-sm text-gray-400">Buat berita baru</p>
        </div>
    </div>

    <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <!-- Judul -->
        <div>
            <label class="block text-sm font-semibold text-[#0a1638] mb-1">Judul <span class="text-red-500">*</span></label>
            <input type="text" name="judul" value="{{ old('judul') }}"
                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#FFD700] focus:border-transparent transition text-sm"
                   placeholder="Masukkan judul berita" required>
            @error('judul')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Upload Multiple Gambar -->
        <div>
            <label class="block text-sm font-semibold text-[#0a1638] mb-1">
                Upload Gambar <span class="text-gray-400 font-normal">(Maks. 3 gambar)</span>
            </label>

            <div class="relative">
                <input type="file" name="gambars[]" id="gambars" accept="image/*" multiple class="hidden">
                <label for="gambars" class="flex flex-col items-center justify-center w-full h-40 border-2 border-dashed border-gray-300 rounded-xl cursor-pointer hover:border-[#FFD700] transition bg-gray-50">
                    <div class="flex flex-col items-center justify-center pt-5 pb-6" id="upload-placeholder">
                        <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                        <p class="text-sm text-gray-500">Klik untuk upload gambar</p>
                        <p class="text-xs text-gray-400">Bisa pilih maksimal 3 gambar • PNG, JPG (Max 2MB/gambar)</p>
                    </div>
                </label>
            </div>

            <!-- Preview Multiple -->
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
                      placeholder="Deskripsi singkat berita" required>{{ old('deskripsi') }}</textarea>
            @error('deskripsi')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Isi -->
        <div>
            <label class="block text-sm font-semibold text-[#0a1638] mb-1">Isi Berita</label>
            <textarea name="isi" rows="8"
                      class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#FFD700] focus:border-transparent transition text-sm"
                      placeholder="Isi lengkap berita">{{ old('isi') }}</textarea>
        </div>

        <!-- Tanggal -->
        <div>
            <label class="block text-sm font-semibold text-[#0a1638] mb-1">Tanggal <span class="text-red-500">*</span></label>
            <input type="date" name="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}"
                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#FFD700] focus:border-transparent transition text-sm"
                   required>
        </div>

        <!-- Status -->
        <div class="flex items-center gap-3">
            <input type="checkbox" name="is_published" id="is_published" checked
                   class="w-5 h-5 text-[#FFD700] rounded border-gray-300 focus:ring-[#FFD700]">
            <label for="is_published" class="text-sm text-gray-700 font-medium">Publikasikan</label>
        </div>

        <!-- Buttons -->
        <div class="flex gap-3 pt-4 border-t border-gray-200">
            <button type="submit" class="bg-[#0a1638] text-white px-8 py-3 rounded-xl hover:bg-[#0f1f4a] transition shadow-lg flex items-center gap-2 text-sm font-semibold">
                <i class="fas fa-save"></i> Simpan
            </button>
            <a href="{{ route('admin.berita.index') }}" class="bg-gray-100 text-gray-700 px-8 py-3 rounded-xl hover:bg-gray-200 transition text-sm font-semibold">
                Batal
            </a>
        </div>
    </form>
</div>

<script>
    document.getElementById('gambars').addEventListener('change', function(e) {
        const files = Array.from(e.target.files);
        const previewContainer = document.getElementById('preview-container');
        const placeholder = document.getElementById('upload-placeholder');

        if (files.length > 3) {
            alert('Maksimal 3 gambar! Hanya 3 gambar pertama yang akan diupload.');
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
                div.className = 'relative aspect-square rounded-xl overflow-hidden border-2 border-[#FFD700]/30';
                div.innerHTML = `
                    <img src="${event.target.result}" class="w-full h-full object-cover">
                    <div class="absolute top-1 left-1 bg-[#FFD700] text-[#0a1638] px-2 py-0.5 rounded-full text-[10px] font-bold">
                        ${index === 0 ? 'Utama' : index + 1}
                    </div>
                `;
                previewContainer.appendChild(div);
            };
            reader.readAsDataURL(file);
        });
    });
</script>
@endsection
