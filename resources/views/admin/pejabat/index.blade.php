@extends('layouts.admin')

@section('title', 'Pejabat')

@section('content')
<div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 bg-[#0a1638]/10 rounded-xl flex items-center justify-center">
                <i class="fas fa-user-tie text-[#0a1638] text-xl"></i>
            </div>
            <div>
                <h3 class="text-2xl font-bold text-[#0a1638]">Daftar Pejabat</h3>
                <p class="text-sm text-gray-400">Kelola data pejabat Lapas</p>
            </div>
        </div>
        <a href="{{ route('admin.pejabat.create') }}" class="bg-[#0a1638] text-white px-6 py-3 rounded-xl hover:bg-[#0f1f4a] transition shadow-lg flex items-center gap-2 text-sm font-semibold">
            <i class="fas fa-plus"></i> Tambah Pejabat
        </a>
    </div>

    <!-- Grid Pejabat -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        @forelse($pejabats as $item)
        <div class="bg-gray-50 rounded-xl p-4 hover:shadow-lg transition border border-gray-100 group">
            <div class="flex items-center gap-3">
                <!-- Foto -->
                <div class="w-16 h-16 rounded-full overflow-hidden border-2 border-[#FFD700] flex-shrink-0 bg-[#0a1638]">
                    @if($item->foto && file_exists(public_path($item->foto)))
                    <img src="{{ asset($item->foto) }}" alt="{{ $item->nama }}" class="w-full h-full object-cover">
                    @else
                    <div class="w-full h-full flex items-center justify-center">
                        <i class="fas fa-user text-[#FFD700] text-2xl"></i>
                    </div>
                    @endif
                </div>

                <!-- Info -->
                <div class="flex-1 min-w-0">
                    <h4 class="font-bold text-[#0a1638] text-sm truncate">{{ $item->nama }}</h4>
                    <p class="text-xs text-[#FFD700] font-semibold truncate">{{ $item->jabatan }}</p>
                    @if($item->periode)
                    <p class="text-[10px] text-gray-400 mt-0.5">
                        <i class="far fa-calendar-alt mr-1"></i> {{ $item->periode }}
                    </p>
                    @endif
                </div>

                <!-- Status -->
                <span class="px-2 py-0.5 rounded-full text-[10px] font-semibold {{ $item->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                    {{ $item->is_active ? 'Aktif' : 'Nonaktif' }}
                </span>
            </div>

            <!-- Aksi -->
            <div class="flex items-center gap-2 mt-3 pt-3 border-t border-gray-200">
                <!-- Edit -->
                <a href="{{ route('admin.pejabat.edit', $item) }}"
                   class="flex-1 bg-[#FFD700]/10 text-[#FFD700] hover:bg-[#FFD700] hover:text-white transition rounded-lg py-2 flex items-center justify-center gap-1 text-xs font-semibold">
                    <i class="fas fa-edit"></i> Edit
                </a>

                <!-- Hapus dengan Modal -->
                <form action="{{ route('admin.pejabat.destroy', $item) }}" method="POST"
                      onsubmit="event.preventDefault(); showDeleteModal(this, '{{ $item->nama }} - {{ $item->jabatan }}');"
                      class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="w-full bg-red-50 text-red-500 hover:bg-red-500 hover:text-white transition rounded-lg py-2 flex items-center justify-center gap-1 text-xs font-semibold">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
        @empty
        <div class="col-span-3 text-center py-12">
            <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-user-tie text-gray-300 text-3xl"></i>
            </div>
            <p class="text-gray-400 text-sm mb-3">Belum ada data pejabat.</p>
            <a href="{{ route('admin.pejabat.create') }}" class="text-[#FFD700] hover:underline text-sm font-semibold">
                Tambah pejabat pertama
            </a>
        </div>
        @endforelse
    </div>

    @if($pejabats->isNotEmpty())
    <div class="mt-6 pt-4 border-t border-gray-200 flex justify-between text-xs text-gray-400">
        <span>Total: {{ $pejabats->count() }} pejabat</span>
        <span>Aktif: {{ $pejabats->where('is_active', true)->count() }} pejabat</span>
    </div>
    @endif
</div>
@endsection
