@extends('layouts.admin')

@section('title', 'Edit Profil')

@section('content')
<div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 max-w-3xl mx-auto">
    <div class="flex items-center gap-3 mb-6">
        <div class="w-10 h-10 bg-[#0a1638] rounded-xl flex items-center justify-center">
            <i class="fas fa-edit text-[#FFD700]"></i>
        </div>
        <div>
            <h3 class="text-2xl font-bold text-[#0a1638]">Edit Profil</h3>
            <p class="text-sm text-gray-400">Perbarui data profil Lapas</p>
        </div>
    </div>

    <form action="{{ route('admin.profil.update') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf
        @method('PUT')

        <!-- Foto Gedung -->
        <div>
            <label class="block text-sm font-semibold text-[#0a1638] mb-1">Foto Gedung</label>

            @if($profil && $profil->foto_gedung && file_exists(public_path($profil->foto_gedung)))
            <div class="mb-3">
                <p class="text-xs text-gray-400 mb-2">Foto saat ini:</p>
                <div class="w-40 h-28 rounded-xl overflow-hidden border-2 border-[#FFD700]/30">
                    <img src="{{ asset($profil->foto_gedung) }}" alt="Foto Gedung" class="w-full h-full object-cover">
                </div>
            </div>
            @endif

            <div class="relative">
                <input type="file" name="foto_gedung" id="foto_gedung" accept="image/*" class="hidden">
                <label for="foto_gedung" class="flex flex-col items-center justify-center w-full h-40 border-2 border-dashed border-gray-300 rounded-xl cursor-pointer hover:border-[#FFD700] transition bg-gray-50">
                    <div class="flex flex-col items-center justify-center pt-5 pb-6" id="upload-placeholder">
                        <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                        <p class="text-sm text-gray-500">Klik untuk upload foto gedung</p>
                        <p class="text-xs text-gray-400">PNG, JPG (Max 2MB)</p>
                    </div>
                    <img id="preview-image" class="hidden w-full h-full object-contain rounded-xl p-2" alt="Preview">
                </label>
            </div>
            <p class="text-xs text-gray-400 mt-1">Kosongkan jika tidak ingin mengganti foto</p>
        </div>

        <!-- Sejarah -->
        <div>
            <label class="block text-sm font-semibold text-[#0a1638] mb-1">Sejarah</label>
            <textarea name="sejarah" rows="5"
                      class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#FFD700] focus:border-transparent transition text-sm"
                      placeholder="Masukkan sejarah Lapas">{{ old('sejarah', $profil->sejarah ?? '') }}</textarea>
        </div>

        <!-- Visi -->
        <div>
            <label class="block text-sm font-semibold text-[#0a1638] mb-1">Visi</label>
            <textarea name="visi" rows="3"
                      class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#FFD700] focus:border-transparent transition text-sm"
                      placeholder="Masukkan visi">{{ old('visi', $profil->visi ?? '') }}</textarea>
        </div>

        <!-- Misi -->
        <div>
            <label class="block text-sm font-semibold text-[#0a1638] mb-1">Misi</label>
            <textarea name="misi" rows="5"
                      class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#FFD700] focus:border-transparent transition text-sm"
                      placeholder="Masukkan misi (satu per baris)">{{ old('misi', $profil->misi ?? '') }}</textarea>
            <p class="text-xs text-gray-400 mt-1">Pisahkan setiap misi dengan baris baru (Enter)</p>
        </div>

        <!-- Tupoksi -->
        <div>
            <label class="block text-sm font-semibold text-[#0a1638] mb-1">Tugas Pokok & Fungsi</label>
            <textarea name="tupoksi" rows="4"
                      class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#FFD700] focus:border-transparent transition text-sm"
                      placeholder="Masukkan tugas pokok & fungsi">{{ old('tupoksi', $profil->tupoksi ?? '') }}</textarea>
        </div>

        <!-- Buttons -->
        <div class="flex gap-3 pt-4 border-t border-gray-200">
            <button type="submit" class="bg-[#0a1638] text-white px-8 py-3 rounded-xl hover:bg-[#0f1f4a] transition shadow-lg flex items-center gap-2 text-sm font-semibold">
                <i class="fas fa-save"></i> Simpan
            </button>
            <a href="{{ route('admin.profil.index') }}" class="bg-gray-100 text-gray-700 px-8 py-3 rounded-xl hover:bg-gray-200 transition text-sm font-semibold">
                Batal
            </a>
        </div>
    </form>
</div>

<script>
    document.getElementById('foto_gedung').addEventListener('change', function(e) {
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
