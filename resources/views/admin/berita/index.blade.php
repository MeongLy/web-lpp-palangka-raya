@extends('layouts.admin')

@section('title', 'Berita')

@section('content')
<div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 bg-[#FFD700]/10 rounded-xl flex items-center justify-center">
                <i class="fas fa-newspaper text-[#FFD700] text-xl"></i>
            </div>
            <div>
                <h3 class="text-2xl font-bold text-[#0a1638]">Daftar Berita</h3>
                <p class="text-sm text-gray-400">Kelola berita Lapas Perempuan</p>
            </div>
        </div>
        <a href="{{ route('admin.berita.create') }}"
           class="bg-[#0a1638] text-white px-6 py-3 rounded-xl hover:bg-[#0f1f4a] transition shadow-lg flex items-center gap-2 text-sm font-semibold">
            <i class="fas fa-plus"></i> Tambah Berita
        </a>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="border-b-2 border-gray-200">
                    <th class="text-left py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">#</th>
                    <th class="text-left py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Gambar</th>
                    <th class="text-left py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Judul</th>
                    <th class="text-left py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Tanggal</th>
                    <th class="text-left py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Status</th>
                    <th class="text-left py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($beritas as $item)
                <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                    <td class="py-3 text-sm text-gray-500">{{ $loop->iteration }}</td>
                    <td class="py-3">
                        @php
                            // Ambil gambar utama saja (index 0)
                            $gambarUtama = null;
                            if ($item->gambars && is_array($item->gambars) && count($item->gambars) > 0) {
                                $gambarUtama = $item->gambars[0];
                            } elseif ($item->gambar) {
                                $gambarUtama = $item->gambar;
                            }
                            $totalGambar = 0;
                            if ($item->gambars && is_array($item->gambars)) {
                                $totalGambar = count($item->gambars);
                            } elseif ($item->gambar) {
                                $totalGambar = 1;
                            }
                        @endphp

                        <div class="relative inline-block">
                            <div class="w-16 h-12 rounded-lg overflow-hidden border-2 border-[#FFD700] bg-gray-100">
                                @if($gambarUtama && file_exists(public_path($gambarUtama)))
                                <img src="{{ asset($gambarUtama) }}" class="w-full h-full object-cover">
                                @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <i class="fas fa-image text-gray-300 text-sm"></i>
                                </div>
                                @endif
                            </div>

                            <!-- Badge Jumlah Gambar -->
                            @if($totalGambar > 1)
                            <div class="absolute -top-1.5 -right-1.5 bg-[#0a1638] text-[#FFD700] w-6 h-6 rounded-full flex items-center justify-center text-[10px] font-bold border-2 border-white shadow-md">
                                {{ $totalGambar }}
                            </div>
                            @endif
                        </div>
                    </td>
                    <td class="py-3">
                        <p class="text-sm font-semibold text-[#0a1638] line-clamp-1">{{ $item->judul }}</p>
                        <p class="text-xs text-gray-400 mt-0.5 line-clamp-1">{{ Str::limit($item->deskripsi, 60) }}</p>
                    </td>
                    <td class="py-3 text-sm text-gray-600">
                        <i class="far fa-calendar-alt mr-1"></i> {{ $item->tanggal->format('d M Y') }}
                    </td>
                    <td class="py-3">
                        <span class="px-2 py-1 rounded-full text-[10px] font-semibold {{ $item->is_published ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                            {{ $item->is_published ? 'Published' : 'Draft' }}
                        </span>
                    </td>
                    <td class="py-3">
                        <div class="flex items-center gap-2">
                            <a href="{{ route('admin.berita.edit', $item) }}"
                               class="w-8 h-8 bg-[#FFD700]/10 rounded-lg flex items-center justify-center text-[#FFD700] hover:bg-[#FFD700] hover:text-white transition"
                               title="Edit">
                                <i class="fas fa-edit text-xs"></i>
                            </a>

                            <form action="{{ route('admin.berita.destroy', $item) }}" method="POST"
                                  onsubmit="event.preventDefault(); showDeleteModal(this, '{{ $item->judul }}');">
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
                    <td colspan="6" class="py-12 text-center">
                        <i class="fas fa-newspaper text-4xl text-gray-200 mb-3 block"></i>
                        <p class="text-sm text-gray-400">Belum ada berita</p>
                        <a href="{{ route('admin.berita.create') }}" class="text-[#FFD700] hover:underline text-sm font-semibold mt-2 inline-block">
                            Tambah berita pertama
                        </a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($beritas->isNotEmpty())
    <div class="mt-6 pt-4 border-t border-gray-200 flex justify-between text-xs text-gray-400">
        <span>Total: {{ $beritas->count() }} berita</span>
        <span>Published: {{ $beritas->where('is_published', true)->count() }}</span>
    </div>
    @endif
</div>
@endsection
