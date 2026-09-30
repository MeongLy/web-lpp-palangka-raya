@extends('layouts.admin')

@section('title', 'Tambah Pengumuman')

@section('content')
<div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
    <div class="flex items-center gap-3 mb-6">
        <div class="w-12 h-12 bg-purple-50 rounded-xl flex items-center justify-center">
            <i class="fas fa-plus text-purple-600 text-xl"></i>
        </div>
        <div>
            <h3 class="text-2xl font-bold text-[#0a1638]">Tambah Pengumuman</h3>
            <p class="text-sm text-gray-400">Buat pengumuman baru</p>
        </div>
    </div>

    @if($errors->any())
    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl">
        <ul class="text-sm text-red-700 list-disc list-inside">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.pengumuman.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('admin.pengumuman._form')

        <div class="flex flex-col sm:flex-row justify-end gap-3 pt-6 mt-6 border-t border-gray-200">
            <a href="{{ route('admin.pengumuman.index') }}"
               class="px-6 py-3 bg-gray-100 text-gray-600 rounded-xl hover:bg-gray-200 transition font-semibold text-sm">
                Batal
            </a>
            <button type="submit"
                    class="px-6 py-3 bg-[#0a1638] text-white rounded-xl hover:bg-[#0f1f4a] transition shadow-lg font-semibold text-sm flex items-center gap-2">
                <i class="fas fa-save"></i> Simpan
            </button>
        </div>
    </form>
</div>
@endsection
