@extends('layouts.admin')

@section('title', 'Edit Struktur Organisasi')

@section('content')
<div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
    <!-- Header -->
    <div class="flex items-center gap-3 mb-6">
        <div class="w-12 h-12 bg-[#0a1638]/10 rounded-xl flex items-center justify-center">
            <i class="fas fa-edit text-[#0a1638] text-xl"></i>
        </div>
        <div>
            <h3 class="text-2xl font-bold text-[#0a1638]">Edit Gambar Struktur</h3>
            <p class="text-sm text-gray-400">Ganti gambar bagan struktur organisasi</p>
        </div>
    </div>

    <!-- Alert Error -->
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

    <form action="{{ route('admin.struktur.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            <!-- Preview Gambar Saat Ini -->
            <div>
                <label class="block text-sm font-semibold text-[#0a1638] mb-3">
                    Gambar Saat Ini
                </label>
                <div class="bg-gray-50 rounded-xl border border-gray-200 p-4">
                    <div class="relative w-full rounded-lg overflow-hidden bg-white border border-gray-200">
                        <img src="{{ asset($strukturGambar) }}"
                             alt="Bagan Struktur Organisasi"
                             class="w-full h-auto object-contain zoomable cursor-pointer">
                    </div>
                    <p class="text-[10px] text-gray-400 mt-2 text-center">
                        <i class="fas fa-info-circle text-[#FFD700]"></i> Klik gambar untuk memperbesar
                    </p>
                </div>
            </div>

            <!-- Upload Gambar Baru -->
            <div>
                <label class="block text-sm font-semibold text-[#0a1638] mb-3">
                    Upload Gambar Baru
                </label>
                <div class="bg-gray-50 rounded-xl border border-gray-200 p-4">
                    <label for="struktur_gambar"
                           class="block w-full aspect-video border-2 border-dashed border-gray-300 rounded-lg cursor-pointer hover:border-[#FFD700] hover:bg-[#FFD700]/5 transition flex flex-col items-center justify-center p-4">
                        <div id="preview-container" class="hidden w-full h-full">
                            <img id="preview-image" src="" alt="Preview" class="w-full h-full object-contain rounded">
                        </div>
                        <div id="placeholder" class="text-center">
                            <div class="w-14 h-14 bg-white rounded-full flex items-center justify-center mx-auto mb-3 shadow-sm">
                                <i class="fas fa-cloud-upload-alt text-[#0a1638] text-xl"></i>
                            </div>
                            <p class="text-sm font-semibold text-[#0a1638]">Klik untuk memilih gambar</p>
                            <p class="text-xs text-gray-400 mt-1">PNG, JPG, JPEG (Maks. 2MB)</p>
                        </div>
                        <input type="file" id="struktur_gambar" name="struktur_gambar"
                               accept="image/png,image/jpeg,image/jpg"
                               class="hidden" onchange="previewImage(event)">
                    </label>

                    <button type="button" id="reset-btn"
                            class="hidden mt-3 w-full text-xs text-red-500 hover:text-red-700 font-semibold"
                            onclick="resetPreview()">
                        <i class="fas fa-times"></i> Batalkan pilihan
                    </button>
                </div>

                <div class="mt-4 p-3 bg-[#FFD700]/10 border border-[#FFD700]/30 rounded-xl flex items-start gap-2">
                    <i class="fas fa-lightbulb text-[#FFD700] mt-0.5"></i>
                    <p class="text-xs text-[#0a1638]/80 leading-relaxed">
                        Gambar lama akan otomatis terhapus saat Anda menyimpan gambar baru.
                    </p>
                </div>
            </div>

        </div>

        <!-- Tombol Aksi -->
        <div class="mt-8 pt-6 border-t border-gray-200 flex flex-col sm:flex-row justify-end gap-3">
            <button type="button"
                    onclick="showDeleteModal()"
                    class="px-6 py-3 bg-red-50 text-red-500 rounded-xl hover:bg-red-500 hover:text-white transition font-semibold text-sm flex items-center justify-center gap-2">
                <i class="fas fa-trash"></i> Hapus Gambar
            </button>

            <a href="{{ route('admin.struktur.index') }}"
               class="px-6 py-3 bg-gray-100 text-gray-600 rounded-xl hover:bg-gray-200 transition font-semibold text-sm flex items-center justify-center gap-2">
                <i class="fas fa-arrow-left"></i> Batal
            </a>

            <button type="submit"
                    class="px-6 py-3 bg-[#0a1638] text-white rounded-xl hover:bg-[#0f1f4a] transition shadow-lg font-semibold text-sm flex items-center justify-center gap-2">
                <i class="fas fa-save"></i> Simpan Perubahan
            </button>
        </div>
    </form>

    <!-- Form Hapus (terpisah) -->
    <form id="delete-form" action="{{ route('admin.struktur.destroy') }}" method="POST" class="hidden">
        @csrf
        @method('DELETE')
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
        document.getElementById('struktur_gambar').value = '';
        document.getElementById('preview-container').classList.add('hidden');
        document.getElementById('placeholder').classList.remove('hidden');
        document.getElementById('reset-btn').classList.add('hidden');
    }

    function showDeleteModal() {
        if (confirm('Yakin ingin menghapus gambar bagan struktur? Tindakan ini tidak dapat dibatalkan.')) {
            document.getElementById('delete-form').submit();
        }
    }
</script>
@endpush
@endsection
