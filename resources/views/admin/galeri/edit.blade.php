@extends('layouts.admin')

@section('title', 'Edit Galeri')

@section('content')
<div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">

    <!-- Header -->
    <div class="flex items-center gap-3 mb-6">
        <div class="w-12 h-12 bg-[#0a1638]/10 rounded-xl flex items-center justify-center">
            <i class="fas fa-edit text-[#0a1638] text-xl"></i>
        </div>
        <div>
            <h3 class="text-2xl font-bold text-[#0a1638]">Edit Galeri</h3>
            <p class="text-sm text-gray-400">{{ $galeri->judul }}</p>
        </div>
    </div>

    <!-- Error Alert -->
    @if($errors->any())
    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl flex items-start gap-3">
        <i class="fas fa-exclamation-circle text-red-500 mt-0.5"></i>
        <ul class="text-sm text-red-700 list-disc list-inside">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.galeri.update', $galeri) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Gambar -->
        <div class="bg-gray-50 rounded-xl p-4 sm:p-6 mb-6">
            <h3 class="text-sm font-bold text-[#0a1638] mb-4 flex items-center gap-2">
                <i class="fas fa-image text-[#FFD700]"></i> Gambar
            </h3>

            <!-- Preview Gambar Saat Ini -->
            @if($galeri->gambar)
            <div class="mb-4">
                <p class="text-xs font-semibold text-gray-500 mb-2">Gambar Saat Ini:</p>
                <div class="w-40 h-40 rounded-xl overflow-hidden border-2 border-gray-200">
                    <img src="{{ asset($galeri->gambar) }}" alt="{{ $galeri->judul }}"
                         class="w-full h-full object-cover">
                </div>
            </div>
            @endif

            <!-- Upload Baru -->
            <label for="gambar"
                   class="block w-full max-w-md aspect-video border-2 border-dashed border-gray-300 rounded-xl cursor-pointer hover:border-[#FFD700] hover:bg-[#FFD700]/5 transition flex flex-col items-center justify-center p-4">
                <div id="preview-container" class="hidden w-full h-full">
                    <img id="preview-image" src="" alt="Preview"
                         class="w-full h-full object-contain rounded-lg">
                </div>
                <div id="placeholder" class="text-center">
                    <div class="w-14 h-14 bg-white rounded-full flex items-center justify-center mx-auto mb-3 shadow-sm">
                        <i class="fas fa-cloud-upload-alt text-[#0a1638] text-xl"></i>
                    </div>
                    <p class="text-sm font-semibold text-[#0a1638]">Klik untuk memilih gambar baru</p>
                    <p class="text-xs text-gray-400 mt-1">Kosongkan jika tidak ingin mengganti</p>
                </div>
                <input type="file" id="gambar" name="gambar"
                       accept="image/*"
                       class="hidden" onchange="previewImage(event)">
            </label>

            <button type="button" id="reset-btn"
                    class="hidden mt-3 text-xs text-red-500 hover:text-red-700 font-semibold"
                    onclick="resetPreview()">
                <i class="fas fa-times"></i> Batalkan pilihan
            </button>
        </div>

        {{-- Include partial, kirim $galeri --}}
        @include('admin.galeri._form', ['galeri' => $galeri])

        <!-- Tombol -->
        <div class="flex flex-col sm:flex-row justify-end gap-3 pt-6 border-t border-gray-200">
            <a href="{{ route('admin.galeri.index') }}"
               class="px-6 py-3 bg-gray-100 text-gray-600 rounded-xl hover:bg-gray-200 transition font-semibold text-sm flex items-center justify-center gap-2">
                <i class="fas fa-arrow-left"></i> Batal
            </a>
            <button type="submit"
                    class="px-6 py-3 bg-[#0a1638] text-white rounded-xl hover:bg-[#0f1f4a] transition shadow-lg font-semibold text-sm flex items-center justify-center gap-2">
                <i class="fas fa-save"></i> Simpan Perubahan
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
    function previewImage(event) {
        const file = event.target.files[0];
        if (!file) return;

        if (file.size > 2 * 1024 * 1024) {
            alert('Ukuran file maksimal 2MB');
            event.target.value = '';
            return;
        }

        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview-image').src = e.target.result;
            document.getElementById('preview-container').classList.remove('hidden');
            document.getElementById('placeholder').classList.add('hidden');
            document.getElementById('reset-btn').classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    }

    function resetPreview() {
        document.getElementById('gambar').value = '';
        document.getElementById('preview-container').classList.add('hidden');
        document.getElementById('placeholder').classList.remove('hidden');
        document.getElementById('reset-btn').classList.add('hidden');
    }
</script>
@endpush
@endsection
