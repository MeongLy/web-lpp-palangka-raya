@php
    $item = $galeri ?? null;
    $kategoriOptions = config('galeri.kategori', []);
    $jenisOptions = config('galeri.jenis', []);
@endphp

<!-- ===== INFORMASI DASAR ===== -->
<div class="bg-gray-50 rounded-xl p-4 sm:p-6 mb-6">
    <h3 class="text-sm font-bold text-[#0a1638] mb-4 flex items-center gap-2">
        <i class="fas fa-info-circle text-[#FFD700]"></i> Informasi Dasar
    </h3>

    <div class="space-y-4">
        <!-- Judul -->
        <div>
            <label class="block text-sm font-semibold text-[#0a1638] mb-2">
                Judul <span class="text-red-500">*</span>
            </label>
            <input type="text" name="judul" required
                   value="{{ old('judul', $item->judul ?? '') }}"
                   placeholder="Nama kegiatan atau produk"
                   class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-[#FFD700] focus:outline-none text-sm">
            @error('judul')
            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Kategori & Jenis (Dropdown) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold text-[#0a1638] mb-2">
                    Kategori <span class="text-red-500">*</span>
                </label>
                <select name="kategori" required
                        class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-[#FFD700] focus:outline-none text-sm bg-white cursor-pointer">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($kategoriOptions as $opt)
                    <option value="{{ $opt }}" @selected(old('kategori', $item->kategori ?? '') == $opt)>
                        {{ $opt }}
                    </option>
                    @endforeach
                </select>
                @error('kategori')
                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-[#0a1638] mb-2">
                    Jenis <span class="text-red-500">*</span>
                </label>
                <select name="jenis" required
                        class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-[#FFD700] focus:outline-none text-sm bg-white cursor-pointer">
                    <option value="">-- Pilih Jenis --</option>
                    @foreach($jenisOptions as $opt)
                    <option value="{{ $opt }}" @selected(old('jenis', $item->jenis ?? '') == $opt)>
                        {{ $opt }}
                    </option>
                    @endforeach
                </select>
                @error('jenis')
                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Keterangan -->
        <div>
            <label class="block text-sm font-semibold text-[#0a1638] mb-2">
                Keterangan Singkat
            </label>
            <textarea name="keterangan" rows="2"
                      placeholder="Keterangan singkat untuk card galeri (opsional)"
                      class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-[#FFD700] focus:outline-none text-sm">{{ old('keterangan', $item->keterangan ?? '') }}</textarea>
            <p class="text-xs text-gray-400 mt-1">
                <i class="fas fa-info-circle"></i> Tampil di card galeri
            </p>
        </div>
    </div>
</div>

<!-- ===== DETAIL PRODUK ===== -->
<div class="bg-[#FFD700]/5 border-2 border-[#FFD700]/30 rounded-xl p-4 sm:p-6 mb-6">
    <h3 class="text-sm font-bold text-[#0a1638] mb-4 flex items-center gap-2">
        <i class="fas fa-box-open text-[#FFD700]"></i> Detail Produk (Opsional)
    </h3>

    <div class="space-y-4">
        <!-- Checkbox Produk -->
        <label class="flex items-start gap-3 p-3 bg-white rounded-lg border-2 border-gray-200 cursor-pointer hover:border-[#FFD700] transition">
            <input type="checkbox" name="is_produk" value="1"
                   @checked(old('is_produk', $item->is_produk ?? false))
                   class="mt-0.5 rounded text-[#FFD700] focus:ring-[#FFD700] w-5 h-5">
            <div>
                <p class="text-sm font-bold text-[#0a1638]">Tandai sebagai Produk</p>
                <p class="text-xs text-gray-500 mt-0.5">
                    Centang jika item ini punya harga dan bisa dibeli
                </p>
            </div>
        </label>

        <!-- Harga & Satuan -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold text-[#0a1638] mb-2">Harga (Rp)</label>
                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm font-semibold">Rp</span>
                    <input type="number" name="harga" min="0" step="100"
                           value="{{ old('harga', $item->harga ?? '') }}"
                           placeholder="75000"
                           class="w-full pl-12 pr-4 py-3 rounded-xl border-2 border-gray-200 focus:border-[#FFD700] focus:outline-none text-sm">
                </div>
                @error('harga')
                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-[#0a1638] mb-2">Satuan</label>
                <input type="text" name="satuan"
                       value="{{ old('satuan', $item->satuan ?? '') }}"
                       placeholder="pcs / box / kg"
                       class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-[#FFD700] focus:outline-none text-sm">
            </div>
        </div>

        <!-- Stok -->
        <div>
            <label class="block text-sm font-semibold text-[#0a1638] mb-2">Stok</label>
            <input type="number" name="stok" min="0"
                   value="{{ old('stok', $item->stok ?? '') }}"
                   placeholder="Kosongkan jika tidak terbatas"
                   class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-[#FFD700] focus:outline-none text-sm">
            <p class="text-xs text-gray-400 mt-1">
                <i class="fas fa-info-circle"></i> Kosongkan jika stok tidak terbatas
            </p>
        </div>

        <!-- Deskripsi -->
        <div>
            <label class="block text-sm font-semibold text-[#0a1638] mb-2">Deskripsi Lengkap</label>
            <textarea name="deskripsi" rows="5"
                      placeholder="Deskripsi detail produk untuk halaman detail..."
                      class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-[#FFD700] focus:outline-none text-sm">{{ old('deskripsi', $item->deskripsi ?? '') }}</textarea>
            <p class="text-xs text-gray-400 mt-1">
                <i class="fas fa-info-circle"></i> Ditampilkan di halaman detail produk
            </p>
        </div>
    </div>
</div>

<!-- ===== PENGATURAN ===== -->
<div class="bg-gray-50 rounded-xl p-4 sm:p-6 mb-6">
    <h3 class="text-sm font-bold text-[#0a1638] mb-4 flex items-center gap-2">
        <i class="fas fa-cog text-[#FFD700]"></i> Pengaturan
    </h3>

    <div class="grid grid-cols-1 gap-4">
        <!-- Status Aktif -->
        <div>
            <label class="block text-sm font-semibold text-[#0a1638] mb-2">Status</label>
            <label class="flex items-center gap-2 px-4 py-3 rounded-xl border-2 border-gray-200 bg-white cursor-pointer hover:border-[#FFD700] transition">
                <input type="checkbox" name="is_active" value="1"
                       @checked(old('is_active', $item->is_active ?? true))
                       class="rounded text-[#FFD700] focus:ring-[#FFD700] w-5 h-5">
                <span class="text-sm font-semibold text-[#0a1638]">Aktif (tampil di publik)</span>
            </label>
        </div>
    </div>
</div>
