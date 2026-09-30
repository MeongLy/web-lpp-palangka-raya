@extends('layouts.admin')

@section('title', 'Tambah Pejabat')

@section('content')
<div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 max-w-3xl mx-auto">
    <div class="flex items-center gap-3 mb-6">
        <div class="w-10 h-10 bg-[#0a1638] rounded-xl flex items-center justify-center">
            <i class="fas fa-plus text-[#FFD700]"></i>
        </div>
        <div>
            <h3 class="text-2xl font-bold text-[#0a1638]">Tambah Pejabat</h3>
            <p class="text-sm text-gray-400">Tambahkan data pejabat baru</p>
        </div>
    </div>

    <form action="{{ route('admin.pejabat.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <!-- Upload Foto -->
        <div>
            <label class="block text-sm font-semibold text-[#0a1638] mb-1">Foto Pejabat</label>
            <div class="relative">
                <input type="file" name="foto" id="foto" accept="image/*" class="hidden">
                <label for="foto" class="flex flex-col items-center justify-center w-full h-40 border-2 border-dashed border-gray-300 rounded-xl cursor-pointer hover:border-[#FFD700] transition bg-gray-50">
                    <div class="flex flex-col items-center justify-center pt-5 pb-6" id="upload-placeholder">
                        <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                        <p class="text-sm text-gray-500">Klik untuk upload foto</p>
                        <p class="text-xs text-gray-400">PNG, JPG (Max 2MB)</p>
                    </div>
                    <img id="preview-image" class="hidden w-full h-full object-contain rounded-xl p-2" alt="Preview">
                </label>
            </div>
        </div>

        <!-- Nama -->
        <div>
            <label class="block text-sm font-semibold text-[#0a1638] mb-1">Nama <span class="text-red-500">*</span></label>
            <input type="text" name="nama" value="{{ old('nama') }}"
                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#FFD700] focus:border-transparent transition text-sm"
                   required>
        </div>

        <!-- Jabatan -->
        <div>
            <label class="block text-sm font-semibold text-[#0a1638] mb-1">Jabatan <span class="text-red-500">*</span></label>
            <input type="text" name="jabatan" value="{{ old('jabatan') }}"
                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#FFD700] focus:border-transparent transition text-sm"
                   required>
        </div>

        <!-- Periode -->
        <div>
            <label class="block text-sm font-semibold text-[#0a1638] mb-1">Periode</label>
            <input type="text" name="periode" value="{{ old('periode') }}"
                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#FFD700] focus:border-transparent transition text-sm"
                   placeholder="Contoh: 2023 - Sekarang">
        </div>

        <!-- Urutan -->
        <div>
            <label class="block text-sm font-semibold text-[#0a1638] mb-1">Urutan</label>
            <input type="number" name="urutan" value="{{ old('urutan', 0) }}"
                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#FFD700] focus:border-transparent transition text-sm">
        </div>

        <!-- Status Aktif -->
        <div class="flex items-center gap-3">
            <input type="checkbox" name="is_active" id="is_active" checked
                   class="w-5 h-5 text-[#FFD700] rounded border-gray-300 focus:ring-[#FFD700]">
            <label for="is_active" class="text-sm text-gray-700 font-medium">Aktif</label>
        </div>

        <!-- Buttons -->
        <div class="flex gap-3 pt-4 border-t border-gray-200">
            <button type="submit" class="bg-[#0a1638] text-white px-8 py-3 rounded-xl hover:bg-[#0f1f4a] transition shadow-lg flex items-center gap-2 text-sm font-semibold">
                <i class="fas fa-save"></i> Simpan
            </button>
            <a href="{{ route('admin.pejabat.index') }}" class="bg-gray-100 text-gray-700 px-8 py-3 rounded-xl hover:bg-gray-200 transition text-sm font-semibold">
                Batal
            </a>
        </div>
    </form>
</div>

<script>
    document.getElementById('foto').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                const preview = document.getElementById('preview-image');
                const placeholder = document.getElementById('upload-placeholder');
                preview.src = event.target.result;
                preview.classList.remove('hidden');
                placeholder.classList.add('hidden');
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection
