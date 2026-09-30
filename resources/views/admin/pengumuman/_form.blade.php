@php
    $item = $pengumuman ?? null;
@endphp

<!-- Judul -->
<div class="mb-4">
    <label class="block text-sm font-semibold text-[#0a1638] mb-2">
        Judul <span class="text-red-500">*</span>
    </label>
    <input type="text" name="judul" required
           value="{{ old('judul', $item->judul ?? '') }}"
           placeholder="Contoh: Pengumuman Libur Nasional"
           class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-[#FFD700] focus:outline-none text-sm">
    @error('judul')
    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
    @enderror
</div>

<!-- Isi -->
<div class="mb-4">
    <label class="block text-sm font-semibold text-[#0a1638] mb-2">
        Isi Pengumuman <span class="text-red-500">*</span>
    </label>
    <textarea name="isi" rows="6" required
              placeholder="Tulis isi pengumuman di sini..."
              class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-[#FFD700] focus:outline-none text-sm">{{ old('isi', $item->isi ?? '') }}</textarea>
    @error('isi')
    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
    @enderror
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
    <!-- Link -->
    <div>
        <label class="block text-sm font-semibold text-[#0a1638] mb-2">Link (Opsional)</label>
        <input type="text" name="link"
               value="{{ old('link', $item->link ?? '') }}"
               placeholder="/berita/judul atau https://..."
               class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-[#FFD700] focus:outline-none text-sm">
    </div>

    <!-- Link Label -->
    <div>
        <label class="block text-sm font-semibold text-[#0a1638] mb-2">Label Tombol Link</label>
        <input type="text" name="link_label"
               value="{{ old('link_label', $item->link_label ?? 'Selengkapnya') }}"
               placeholder="Selengkapnya"
               class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-[#FFD700] focus:outline-none text-sm">
    </div>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
    <!-- Tipe -->
    <div>
        <label class="block text-sm font-semibold text-[#0a1638] mb-2">
            Tipe Tampilan <span class="text-red-500">*</span>
        </label>
        <select name="tipe" required
                class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-[#FFD700] focus:outline-none text-sm bg-white">
            <option value="popup" @selected(old('tipe', $item->tipe ?? 'popup') == 'popup')>
                Popup saja
            </option>
            <option value="banner" @selected(old('tipe', $item->tipe ?? '') == 'banner')>
                Banner saja
            </option>
            <option value="keduanya" @selected(old('tipe', $item->tipe ?? '') == 'keduanya')>
                Popup + Banner
            </option>
        </select>
    </div>

    <!-- Prioritas -->
    <div>
        <label class="block text-sm font-semibold text-[#0a1638] mb-2">Prioritas</label>
        <input type="number" name="prioritas" min="0"
               value="{{ old('prioritas', $item->prioritas ?? 0) }}"
               class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-[#FFD700] focus:outline-none text-sm">
        <p class="text-xs text-gray-400 mt-1">Angka lebih tinggi = tampil duluan</p>
    </div>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
    <!-- Mulai Tayang -->
    <div>
        <label class="block text-sm font-semibold text-[#0a1638] mb-2">Mulai Tayang (Opsional)</label>
        <input type="datetime-local" name="mulai_tayang"
               value="{{ old('mulai_tayang', $item?->mulai_tayang?->format('Y-m-d\TH:i')) }}"
               class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-[#FFD700] focus:outline-none text-sm">
        <p class="text-xs text-gray-400 mt-1">Kosongkan untuk tayang langsung</p>
    </div>

    <!-- Selesai Tayang -->
    <div>
        <label class="block text-sm font-semibold text-[#0a1638] mb-2">Selesai Tayang (Opsional)</label>
        <input type="datetime-local" name="selesai_tayang"
               value="{{ old('selesai_tayang', $item?->selesai_tayang?->format('Y-m-d\TH:i')) }}"
               class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-[#FFD700] focus:outline-none text-sm">
        <p class="text-xs text-gray-400 mt-1">Kosongkan untuk tayang selamanya</p>
    </div>
</div>

<!-- Gambar -->
<div class="mb-4">
    <label class="block text-sm font-semibold text-[#0a1638] mb-2">Gambar (Opsional)</label>

    @if($item && $item->gambar && file_exists(public_path($item->gambar)))
    <div class="mb-3">
        <p class="text-xs text-gray-500 mb-1">Gambar saat ini:</p>
        <div class="w-40 h-40 rounded-xl overflow-hidden border-2 border-gray-200">
            <img src="{{ asset($item->gambar) }}" class="w-full h-full object-cover">
        </div>
    </div>
    @endif

    <input type="file" name="gambar" accept="image/*"
           class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-[#FFD700] focus:outline-none text-sm">
    <p class="text-xs text-gray-400 mt-1">JPG, PNG, WEBP (Maks. 3MB)</p>
</div>

<!-- Status Aktif -->
<label class="flex items-center gap-2 p-4 bg-gray-50 rounded-xl border-2 border-gray-200 cursor-pointer hover:border-[#FFD700] transition">
    <input type="checkbox" name="is_active" value="1"
           @checked(old('is_active', $item->is_active ?? true))
           class="rounded text-[#FFD700] focus:ring-[#FFD700] w-5 h-5">
    <span class="text-sm font-semibold text-[#0a1638]">
        Aktifkan pengumuman ini
    </span>
</label>
