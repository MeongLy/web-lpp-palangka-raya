@extends('layouts.admin')

@section('title', 'Pengumuman')

@section('content')
<div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 bg-purple-50 rounded-xl flex items-center justify-center">
                <i class="fas fa-bullhorn text-purple-600 text-xl"></i>
            </div>
            <div>
                <h3 class="text-2xl font-bold text-[#0a1638]">Pengumuman</h3>
                <p class="text-sm text-gray-400">Kelola pengumuman popup website</p>
            </div>
        </div>
        <a href="{{ route('admin.pengumuman.create') }}"
           class="bg-purple-600 text-white px-6 py-3 rounded-xl hover:bg-purple-700 transition shadow-lg flex items-center gap-2 text-sm font-semibold">
            <i class="fas fa-plus"></i> Tambah Pengumuman
        </a>
    </div>

    @if(session('success'))
    <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl flex items-start gap-3">
        <i class="fas fa-check-circle text-green-500 mt-0.5"></i>
        <p class="text-sm text-green-700">{{ session('success') }}</p>
    </div>
    @endif

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="border-b-2 border-gray-200">
                    <th class="text-left py-3 text-xs font-semibold text-gray-400 uppercase">#</th>
                    <th class="text-left py-3 text-xs font-semibold text-gray-400 uppercase">Judul</th>
                    <th class="text-left py-3 text-xs font-semibold text-gray-400 uppercase">Tipe</th>
                    <th class="text-left py-3 text-xs font-semibold text-gray-400 uppercase">Prioritas</th>
                    <th class="text-left py-3 text-xs font-semibold text-gray-400 uppercase">Jadwal</th>
                    <th class="text-left py-3 text-xs font-semibold text-gray-400 uppercase">Status</th>
                    <th class="text-left py-3 text-xs font-semibold text-gray-400 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pengumumans as $item)
                <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                    <td class="py-3 text-sm text-gray-500">{{ $loop->iteration }}</td>
                    <td class="py-3">
                        <div class="flex items-center gap-3">
                            @if($item->gambar && file_exists(public_path($item->gambar)))
                            <div class="w-10 h-10 rounded-lg overflow-hidden bg-gray-100 flex-shrink-0">
                                <img src="{{ asset($item->gambar) }}" class="w-full h-full object-cover">
                            </div>
                            @endif
                            <div class="min-w-0">
                                <p class="text-sm font-bold text-[#0a1638] truncate">{{ $item->judul }}</p>
                                <p class="text-[10px] text-gray-400 truncate">{{ Str::limit($item->isi, 50) }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="py-3">
                        <span class="px-2 py-0.5 rounded-full text-[10px] font-semibold bg-purple-100 text-purple-700 uppercase">
                            {{ $item->tipe }}
                        </span>
                    </td>
                    <td class="py-3 text-sm text-gray-600">{{ $item->prioritas }}</td>
                    <td class="py-3 text-xs text-gray-500">
                        @if($item->mulai_tayang || $item->selesai_tayang)
                            {{ $item->mulai_tayang?->format('d/m/Y') ?? '—' }}
                            →
                            {{ $item->selesai_tayang?->format('d/m/Y') ?? '∞' }}
                        @else
                            <span class="text-gray-400">Tanpa jadwal</span>
                        @endif
                    </td>
                    <td class="py-3">
                        @php
                            $statusColor = match($item->status_label) {
                                'Tayang' => 'bg-green-500',
                                'Terjadwal / Kadaluarsa' => 'bg-yellow-500',
                                default => 'bg-gray-400',
                            };
                        @endphp
                        <span class="px-2 py-0.5 rounded-full text-[10px] font-semibold text-white {{ $statusColor }}">
                            {{ $item->status_label }}
                        </span>
                    </td>
                    <td class="py-3">
                        <div class="flex items-center gap-2">
                            <a href="{{ route('admin.pengumuman.edit', $item) }}"
                               class="w-8 h-8 bg-[#FFD700]/10 rounded-lg flex items-center justify-center text-[#FFD700] hover:bg-[#FFD700] hover:text-white transition"
                               title="Edit">
                                <i class="fas fa-edit text-xs"></i>
                            </a>
                            <form action="{{ route('admin.pengumuman.destroy', $item) }}" method="POST"
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
                    <td colspan="7" class="py-12 text-center">
                        <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-bullhorn text-gray-300 text-2xl"></i>
                        </div>
                        <p class="text-gray-400 text-sm">Belum ada pengumuman</p>
                        <a href="{{ route('admin.pengumuman.create') }}"
                           class="text-purple-600 hover:underline text-sm font-semibold mt-2 inline-block">
                            Tambah pengumuman pertama
                        </a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($pengumumans->isNotEmpty())
    <div class="mt-6 pt-4 border-t border-gray-200">
        {{ $pengumumans->links() }}
    </div>
    @endif
</div>
@endsection
