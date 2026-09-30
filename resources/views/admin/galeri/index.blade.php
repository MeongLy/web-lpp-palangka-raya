@extends('layouts.admin')

@section('title', 'Galeri')

@section('content')
<div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 bg-purple-50 rounded-xl flex items-center justify-center">
                <i class="fas fa-images text-purple-600 text-xl"></i>
            </div>
            <div>
                <h3 class="text-2xl font-bold text-[#0a1638]">Daftar Galeri</h3>
                <p class="text-sm text-gray-400">Kelola foto galeri & produk Lapas Perempuan</p>
            </div>
        </div>
        <a href="{{ route('admin.galeri.create') }}"
           class="bg-purple-600 text-white px-6 py-3 rounded-xl hover:bg-purple-700 transition shadow-lg hover:shadow-xl flex items-center gap-2 text-sm font-semibold">
            <i class="fas fa-plus"></i> Tambah Galeri
        </a>
    </div>

    <!-- Grid Galeri -->
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
        @forelse($galeris as $item)
        <div class="group relative bg-gray-50 rounded-xl overflow-hidden border border-gray-100 hover:shadow-xl transition duration-300">

            <!-- Gambar -->
            <div class="aspect-square bg-gray-100 flex items-center justify-center overflow-hidden">
                @if($item->gambar && file_exists(public_path($item->gambar)))
                <img src="{{ asset($item->gambar) }}" alt="{{ $item->judul }}"
                     class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                @else
                <div class="w-full h-full bg-gradient-to-br from-purple-50 to-purple-100 flex items-center justify-center">
                    <i class="fas fa-image text-5xl text-purple-300"></i>
                </div>
                @endif
            </div>

            <!-- Overlay Hover -->
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex flex-col justify-end p-3 pointer-events-none">
                <p class="text-white font-semibold text-sm truncate">
                    {{ $item->judul ?? 'Tanpa Judul' }}
                </p>
                <div class="flex items-center gap-2 mt-1 flex-wrap">
                    @if($item->kategori)
                    <span class="text-[10px] bg-[#0a1638] text-white px-2 py-0.5 rounded-full">
                        {{ $item->kategori }}
                    </span>
                    @endif
                    @if($item->jenis)
                    <span class="text-[10px] bg-[#FFD700] text-[#0a1638] px-2 py-0.5 rounded-full font-semibold">
                        {{ $item->jenis }}
                    </span>
                    @endif
                </div>
                @if($item->keterangan)
                <p class="text-white/60 text-[10px] mt-1 line-clamp-2">{{ $item->keterangan }}</p>
                @endif
            </div>

            <!-- Status Badge -->
            <div class="absolute top-2 left-2 z-10 flex flex-col gap-1">
                <span class="px-2 py-0.5 rounded-full text-[10px] font-semibold {{ $item->is_active ? 'bg-green-500 text-white' : 'bg-gray-500 text-white' }}">
                    {{ $item->is_active ? 'Aktif' : 'Nonaktif' }}
                </span>
                @if($item->is_produk)
                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-[#FFD700] text-[#0a1638] shadow">
                    <i class="fas fa-box-open mr-0.5"></i> Produk
                </span>
                @endif
            </div>

            <!-- Tombol Aksi -->
            <div class="absolute top-2 right-2 flex gap-1 z-10">
                <!-- Edit -->
                <a href="{{ route('admin.galeri.edit', $item) }}"
                   class="w-8 h-8 bg-white/90 backdrop-blur rounded-lg flex items-center justify-center text-purple-600 hover:bg-purple-600 hover:text-white transition opacity-0 group-hover:opacity-100"
                   title="Edit">
                    <i class="fas fa-edit text-xs"></i>
                </a>

                <!-- Hapus dengan Modal -->
                <form action="{{ route('admin.galeri.destroy', $item) }}" method="POST"
                      onsubmit="event.preventDefault(); showDeleteModal(this, '{{ $item->judul ?? 'Galeri' }}');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="w-8 h-8 bg-white/90 backdrop-blur rounded-lg flex items-center justify-center text-red-500 hover:bg-red-500 hover:text-white transition opacity-0 group-hover:opacity-100"
                            title="Hapus">
                        <i class="fas fa-trash text-xs"></i>
                    </button>
                </form>
            </div>

            <!-- Info di bawah -->
            <div class="p-2 bg-white border-t border-gray-100">
                <!-- Baris 1: Kategori & Jenis -->
                <div class="flex items-center justify-between gap-1 mb-1">
                    <span class="text-[10px] text-gray-500 truncate">
                        <i class="fas fa-folder text-purple-500 mr-1"></i>{{ $item->kategori ?? '-' }}
                    </span>
                    <span class="text-[10px] text-gray-500 truncate">
                        <i class="fas fa-tag text-[#FFD700] mr-1"></i>{{ $item->jenis ?? '-' }}
                    </span>
                </div>

                <!-- Baris 2: Harga (kalau produk) -->
                @if($item->is_produk)
                <div class="flex items-center justify-between gap-1 pt-1 border-t border-gray-100">
                    @if($item->harga)
                    <span class="text-[11px] font-bold text-[#0a1638] truncate">
                        {{ $item->harga_rupiah }}
                        @if($item->satuan)
                        <span class="text-[9px] text-gray-400 font-normal">/{{ $item->satuan }}</span>
                        @endif
                    </span>
                    @else
                    <span class="text-[10px] text-gray-400 italic">Harga belum diisi</span>
                    @endif

                    @if($item->stok !== null)
                    <span class="text-[10px] font-semibold {{ $item->stok_tersedia ? 'text-green-600' : 'text-red-500' }} truncate">
                        @if($item->stok_tersedia)
                        <i class="fas fa-box mr-0.5"></i>{{ $item->stok }}
                        @else
                        <i class="fas fa-times-circle mr-0.5"></i>Habis
                        @endif
                    </span>
                    @endif
                </div>
                @endif
            </div>

        </div>
        @empty
        <div class="col-span-full py-16 text-center">
            <div class="w-20 h-20 bg-purple-50 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-images text-purple-300 text-3xl"></i>
            </div>
            <p class="text-gray-400 text-sm">Belum ada galeri.</p>
            <a href="{{ route('admin.galeri.create') }}"
               class="text-purple-600 hover:underline text-sm font-semibold mt-2 inline-block">
                Tambah galeri pertama
            </a>
        </div>
        @endforelse
    </div>

    <!-- Footer Info -->
    @if($galeris->isNotEmpty())
    <div class="mt-6 pt-4 border-t border-gray-200 flex flex-wrap justify-between gap-2 text-xs text-gray-400">
        <span>Total: <strong class="text-gray-600">{{ $galeris->count() }}</strong> item</span>
        <span>Aktif: <strong class="text-green-600">{{ $galeris->where('is_active', true)->count() }}</strong> item</span>
        <span>Produk: <strong class="text-[#0a1638]">{{ $galeris->where('is_produk', true)->count() }}</strong> item</span>
        <span>Kategori: <strong class="text-gray-600">{{ $galeris->pluck('kategori')->filter()->unique()->count() }}</strong> jenis</span>
        <span>Jenis: <strong class="text-gray-600">{{ $galeris->pluck('jenis')->filter()->unique()->count() }}</strong> macam</span>
    </div>
    @endif
</div>
@endsection
