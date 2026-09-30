@extends('layouts.admin')

@section('title', 'Tambah Layanan')

@section('content')
<div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-lg font-bold text-[#0a1638]">Tambah Layanan</h3>
        <a href="{{ route('admin.layanan.index') }}" class="text-gray-500 hover:text-[#0a1638] transition text-sm">
            <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>
    </div>

    <form action="{{ route('admin.layanan.store') }}" method="POST">
        @csrf

        <div class="space-y-4">
            <div>
                <label class="block text-sm font-semibold text-[#0a1638] mb-1">Nama <span class="text-red-500">*</span></label>
                <input type="text" name="nama" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#FFD700] focus:border-transparent transition" required>
            </div>
            <div>
                <label class="block text-sm font-semibold text-[#0a1638] mb-1">Deskripsi <span class="text-red-500">*</span></label>
                <textarea name="deskripsi" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#FFD700] focus:border-transparent transition" required></textarea>
            </div>
            <div>
                <label class="block text-sm font-semibold text-[#0a1638] mb-1">Icon <span class="text-red-500">*</span></label>
                <input type="text" name="icon" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#FFD700] focus:border-transparent transition" placeholder="fa-hand-holding-heart" required>
                <p class="text-xs text-gray-400 mt-1">Icon Font Awesome (contoh: fa-hand-holding-heart)</p>
            </div>
            <div>
                <label class="block text-sm font-semibold text-[#0a1638] mb-1">Urutan</label>
                <input type="number" name="urutan" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#FFD700] focus:border-transparent transition" value="0">
            </div>
            <div class="flex items-center gap-2">
                <input type="checkbox" name="is_active" id="is_active" checked class="w-4 h-4 text-[#FFD700] rounded border-gray-300 focus:ring-[#FFD700]">
                <label for="is_active" class="text-sm text-gray-700">Aktif</label>
            </div>
        </div>

        <div class="mt-6 flex gap-3">
            <button type="submit" class="bg-[#0a1638] text-white px-6 py-2 rounded-lg hover:bg-[#0f1f4a] transition">
                <i class="fas fa-save mr-2"></i> Simpan
            </button>
            <a href="{{ route('admin.layanan.index') }}" class="bg-gray-200 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-300 transition">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
