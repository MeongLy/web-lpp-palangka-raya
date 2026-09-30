@extends('layouts.admin')

@section('title', 'Layanan')

@section('content')
<div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 bg-green-50 rounded-xl flex items-center justify-center">
                <i class="fas fa-hand-holding-heart text-green-600 text-xl"></i>
            </div>
            <div>
                <h3 class="text-2xl font-bold text-[#0a1638]">Daftar Layanan</h3>
                <p class="text-sm text-gray-400">Kelola layanan Lapas Perempuan</p>
            </div>
        </div>
        <a href="{{ route('admin.layanan.create') }}"
           class="bg-green-600 text-white px-6 py-3 rounded-xl hover:bg-green-700 transition shadow-lg flex items-center gap-2 text-sm font-semibold">
            <i class="fas fa-plus"></i> Tambah Layanan
        </a>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="border-b-2 border-gray-200">
                    <th class="text-left py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">#</th>
                    <th class="text-left py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Icon</th>
                    <th class="text-left py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Nama</th>
                    <th class="text-left py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Deskripsi</th>
                    <th class="text-left py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Urutan</th>
                    <th class="text-left py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Status</th>
                    <th class="text-left py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($layanans as $item)
                <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                    <td class="py-3 text-sm text-gray-500">{{ $loop->iteration }}</td>
                    <td class="py-3">
                        <div class="w-10 h-10 bg-[#0a1638] rounded-lg flex items-center justify-center">
                            <i class="fas {{ $item->icon }} text-[#FFD700]"></i>
                        </div>
                    </td>
                    <td class="py-3 text-sm font-semibold text-[#0a1638]">{{ $item->nama }}</td>
                    <td class="py-3 text-sm text-gray-600 max-w-xs">
                        <p class="line-clamp-2">{{ $item->deskripsi }}</p>
                    </td>
                    <td class="py-3">
                        <span class="px-2 py-1 rounded-full text-[10px] font-semibold bg-gray-100 text-gray-600">
                            {{ $item->urutan ?? 0 }}
                        </span>
                    </td>
                    <td class="py-3">
                        <span class="px-2 py-1 rounded-full text-[10px] font-semibold {{ $item->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                            {{ $item->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </td>
                    <td class="py-3">
                        <div class="flex items-center gap-2">
                            <a href="{{ route('admin.layanan.edit', $item) }}"
                               class="w-8 h-8 bg-[#FFD700]/10 rounded-lg flex items-center justify-center text-[#FFD700] hover:bg-[#FFD700] hover:text-white transition"
                               title="Edit">
                                <i class="fas fa-edit text-xs"></i>
                            </a>

                            <form action="{{ route('admin.layanan.destroy', $item) }}" method="POST"
                                  onsubmit="event.preventDefault(); showDeleteModal(this, '{{ $item->nama }}');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="w-8 h-8 bg-red-50 rounded-lg flex items-center justify-center text-red-500 hover:bg-red-500 hover:text-white transition"
                                        title="Hapus">
                                    <i class="fas fa-trash text-xs"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="py-12 text-center">
                        <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-hand-holding-heart text-gray-300 text-2xl"></i>
                        </div>
                        <p class="text-gray-400 text-sm mb-3">Belum ada layanan</p>
                        <a href="{{ route('admin.layanan.create') }}" class="text-green-600 hover:underline text-sm font-semibold">
                            Tambah layanan pertama
                        </a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Footer Info -->
    @if($layanans->isNotEmpty())
    <div class="mt-6 pt-4 border-t border-gray-200 flex justify-between text-xs text-gray-400">
        <span>Total: {{ $layanans->count() }} layanan</span>
        <span>Aktif: {{ $layanans->where('is_active', true)->count() }} layanan</span>
    </div>
    @endif
</div>
@endsection

