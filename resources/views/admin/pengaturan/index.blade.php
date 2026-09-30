@extends('layouts.admin')

@section('title', 'Pengaturan')

@section('content')
<div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
    <!-- Header -->
    <div class="flex items-center gap-3 mb-6">
        <div class="w-12 h-12 bg-[#0a1638]/10 rounded-xl flex items-center justify-center">
            <i class="fas fa-cog text-[#0a1638] text-xl"></i>
        </div>
        <div>
            <h3 class="text-2xl font-bold text-[#0a1638]">Pengaturan</h3>
            <p class="text-sm text-gray-400">Kelola informasi umum, kontak, dan sosial media</p>
        </div>
    </div>

    @if(session('success'))
    <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl flex items-start gap-3">
        <i class="fas fa-check-circle text-green-500 mt-0.5"></i>
        <p class="text-sm text-green-700">{{ session('success') }}</p>
    </div>
    @endif

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

    <form action="{{ route('admin.pengaturan.update') }}" method="POST"
          enctype="multipart/form-data" class="space-y-8">
        @csrf

        <!-- ======================================== -->
        <!-- INFORMASI UMUM                           -->
        <!-- ======================================== -->
        <div>
            <div class="flex items-center gap-2 mb-4 pb-3 border-b-2 border-[#FFD700]/30">
                <div class="w-8 h-8 bg-[#0a1638] rounded-lg flex items-center justify-center">
                    <i class="fas fa-info-circle text-[#FFD700] text-sm"></i>
                </div>
                <h4 class="text-lg font-bold text-[#0a1638]">Informasi Umum</h4>
            </div>

            <div>
                <label class="block text-sm font-semibold text-[#0a1638] mb-1">
                    Nama Instansi
                </label>
                <input type="text" name="nama_lapas"
                       value="{{ $pengaturan['nama_lapas'] ?? 'Lapas Perempuan Palangka Raya' }}"
                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#FFD700] focus:border-transparent transition text-sm"
                       placeholder="Lapas Perempuan Palangka Raya">
            </div>
        </div>

        <!-- ======================================== -->
        <!-- HERO BACKGROUND                          -->
        <!-- ======================================== -->
        <div>
            <div class="flex items-center gap-2 mb-4 pb-3 border-b-2 border-[#FFD700]/30">
                <div class="w-8 h-8 bg-[#0a1638] rounded-lg flex items-center justify-center">
                    <i class="fas fa-image text-[#FFD700] text-sm"></i>
                </div>
                <h4 class="text-lg font-bold text-[#0a1638]">Hero Background</h4>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                <!-- Preview -->
                <div>
                    <p class="text-sm font-semibold text-[#0a1638] mb-2">Preview</p>
                    @php
                        $heroPath = $pengaturan['hero_background'] ?? 'images/hero/default.jpg';
                        $heroExists = $heroPath && file_exists(public_path($heroPath));
                    @endphp

                    @if($heroExists)
                    <div class="relative w-full aspect-video rounded-xl overflow-hidden border-2 border-gray-200 bg-gray-100">
                        <img src="{{ asset($heroPath) }}?v={{ time() }}"
                             alt="Hero Background"
                             class="w-full h-full object-cover">
                    </div>
                    @else
                    <div class="w-full aspect-video rounded-xl border-2 border-dashed border-gray-300 bg-gray-50 flex flex-col items-center justify-center">
                        <i class="fas fa-image text-gray-300 text-3xl mb-2"></i>
                        <p class="text-xs text-gray-400">Belum ada gambar</p>
                    </div>
                    @endif

                    <p class="text-xs text-gray-400 mt-2">
                        <i class="fas fa-info-circle"></i> Rekomendasi: 1920x1080px, maks 3MB
                    </p>
                </div>

                <!-- Upload -->
                <div>
                    <p class="text-sm font-semibold text-[#0a1638] mb-2">Upload Gambar Baru</p>

                    <label for="hero_background"
                           class="block w-full aspect-video border-2 border-dashed border-gray-300 rounded-xl cursor-pointer hover:border-[#FFD700] hover:bg-[#FFD700]/5 transition flex flex-col items-center justify-center p-4">
                        <div id="hero-preview-container" class="hidden w-full h-full">
                            <img id="hero-preview-image" src="" alt="Preview"
                                 class="w-full h-full object-contain rounded-lg">
                        </div>
                        <div id="hero-placeholder" class="text-center">
                            <div class="w-14 h-14 bg-white rounded-full flex items-center justify-center mx-auto mb-3 shadow-sm">
                                <i class="fas fa-cloud-upload-alt text-[#0a1638] text-xl"></i>
                            </div>
                            <p class="text-sm font-semibold text-[#0a1638]">Klik untuk memilih gambar</p>
                            <p class="text-xs text-gray-400 mt-1">JPG, PNG, WEBP (Maks. 3MB)</p>
                        </div>
                        <input type="file" id="hero_background" name="hero_background"
                               accept="image/jpeg,image/png,image/webp"
                               class="hidden" onchange="previewHero(event)">
                    </label>

                    <button type="button" id="hero-reset-btn"
                            class="hidden mt-3 text-xs text-red-500 hover:text-red-700 font-semibold"
                            onclick="resetHeroPreview()">
                        <i class="fas fa-times"></i> Batalkan pilihan
                    </button>

                    <!-- Input Overlay Opacity -->
                    <div class="mt-4">
                        <label class="block text-sm font-semibold text-[#0a1638] mb-1">
                            Tingkat Kegelapan Overlay
                        </label>
                        <div class="flex items-center gap-3">
                            <input type="range" name="hero_overlay_opacity"
                                   min="0" max="100" step="5"
                                   value="{{ $pengaturan['hero_overlay_opacity'] ?? 60 }}"
                                   oninput="document.getElementById('opacityValue').textContent = this.value + '%'"
                                   class="flex-1 accent-[#FFD700]">
                            <span id="opacityValue" class="text-sm font-bold text-[#0a1638] w-12 text-right">
                                {{ $pengaturan['hero_overlay_opacity'] ?? 60 }}%
                            </span>
                        </div>
                        <p class="text-xs text-gray-400 mt-1">
                            Semakin tinggi, semakin gelap (agar teks lebih terbaca)
                        </p>
                    </div>
                </div>

            </div>
        </div>

        <!-- ======================================== -->
        <!-- KONTAK                                   -->
        <!-- ======================================== -->
        <div>
            <div class="flex items-center gap-2 mb-4 pb-3 border-b-2 border-[#FFD700]/30">
                <div class="w-8 h-8 bg-[#0a1638] rounded-lg flex items-center justify-center">
                    <i class="fas fa-address-book text-[#FFD700] text-sm"></i>
                </div>
                <h4 class="text-lg font-bold text-[#0a1638]">Kontak</h4>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Alamat -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-[#0a1638] mb-1">
                        <i class="fas fa-map-marker-alt text-[#FFD700] mr-1"></i> Alamat
                    </label>
                    <textarea name="alamat" rows="2"
                              class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#FFD700] focus:border-transparent transition text-sm"
                              placeholder="Jl. Tjilik Riwut No.km. 5, Bukit Tunggal...">{{ $pengaturan['alamat'] ?? '' }}</textarea>
                </div>

                <!-- Telepon -->
                <div>
                    <label class="block text-sm font-semibold text-[#0a1638] mb-1">
                        <i class="fas fa-phone text-[#FFD700] mr-1"></i> Telepon 1
                    </label>
                    <input type="text" name="telepon"
                           value="{{ $pengaturan['telepon'] ?? '' }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#FFD700] focus:border-transparent transition text-sm"
                           placeholder="+62 812-3456-7890">
                </div>

                <!-- Telepon 2 -->
                <div>
                    <label class="block text-sm font-semibold text-[#0a1638] mb-1">
                        <i class="fas fa-phone text-[#FFD700] mr-1"></i> Telepon 2
                    </label>
                    <input type="text" name="telepon_2"
                           value="{{ $pengaturan['telepon_2'] ?? '' }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#FFD700] focus:border-transparent transition text-sm"
                           placeholder="+62 853-1234-5678">
                </div>

                <!-- Email -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-[#0a1638] mb-1">
                        <i class="fas fa-envelope text-[#FFD700] mr-1"></i> Email
                    </label>
                    <input type="email" name="email"
                           value="{{ $pengaturan['email'] ?? '' }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#FFD700] focus:border-transparent transition text-sm"
                           placeholder="lapas.perempuan@kemenkumham.go.id">
                </div>
            </div>
        </div>

        <!-- ======================================== -->
        <!-- SOSIAL MEDIA                             -->
        <!-- ======================================== -->
        <div>
            <div class="flex items-center gap-2 mb-4 pb-3 border-b-2 border-[#FFD700]/30">
                <div class="w-8 h-8 bg-[#0a1638] rounded-lg flex items-center justify-center">
                    <i class="fas fa-share-alt text-[#FFD700] text-sm"></i>
                </div>
                <h4 class="text-lg font-bold text-[#0a1638]">Sosial Media</h4>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- WhatsApp -->
                <div>
                    <label class="block text-sm font-semibold text-[#0a1638] mb-1">
                        <i class="fab fa-whatsapp text-green-500 mr-1"></i> WhatsApp
                    </label>
                    <input type="text" name="whatsapp"
                           value="{{ $pengaturan['whatsapp'] ?? '' }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#FFD700] focus:border-transparent transition text-sm"
                           placeholder="6281234567890">
                    <p class="text-xs text-gray-400 mt-1">
                        Format internasional tanpa <code class="bg-gray-100 px-1 rounded">+</code>: <code class="bg-gray-100 px-1 rounded">6281234567890</code>
                    </p>
                </div>

                <!-- Facebook -->
                <div>
                    <label class="block text-sm font-semibold text-[#0a1638] mb-1">
                        <i class="fab fa-facebook text-blue-600 mr-1"></i> Facebook
                    </label>
                    <input type="text" name="facebook"
                           value="{{ $pengaturan['facebook'] ?? '' }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#FFD700] focus:border-transparent transition text-sm"
                           placeholder="https://facebook.com/...">
                </div>

                <!-- Instagram -->
                <div>
                    <label class="block text-sm font-semibold text-[#0a1638] mb-1">
                        <i class="fab fa-instagram text-pink-500 mr-1"></i> Instagram
                    </label>
                    <input type="text" name="instagram"
                           value="{{ $pengaturan['instagram'] ?? '' }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#FFD700] focus:border-transparent transition text-sm"
                           placeholder="https://instagram.com/...">
                </div>

                <!-- YouTube -->
                <div>
                    <label class="block text-sm font-semibold text-[#0a1638] mb-1">
                        <i class="fab fa-youtube text-red-600 mr-1"></i> YouTube
                    </label>
                    <input type="text" name="youtube"
                           value="{{ $pengaturan['youtube'] ?? '' }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#FFD700] focus:border-transparent transition text-sm"
                           placeholder="https://youtube.com/...">
                </div>

                <!-- X / Twitter -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-[#0a1638] mb-1">
                        <i class="fab fa-x-twitter text-black mr-1"></i> X (Twitter)
                    </label>
                    <input type="text" name="twitter"
                           value="{{ $pengaturan['twitter'] ?? '' }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#FFD700] focus:border-transparent transition text-sm"
                           placeholder="https://x.com/...">
                </div>
            </div>
        </div>

        <!-- ======================================== -->
        <!-- TOMBOL SIMPAN                            -->
        <!-- ======================================== -->
        <div class="flex flex-col sm:flex-row gap-3 pt-5 border-t border-gray-200">
            <button type="submit"
                    class="bg-[#0a1638] text-white px-8 py-3 rounded-xl hover:bg-[#0f1f4a] transition shadow-lg flex items-center justify-center gap-2 text-sm font-semibold">
                <i class="fas fa-save"></i> Simpan Pengaturan
            </button>
            <a href="{{ route('admin.dashboard') }}"
               class="bg-gray-100 text-gray-700 px-8 py-3 rounded-xl hover:bg-gray-200 transition text-sm font-semibold text-center">
                <i class="fas fa-times mr-1"></i> Batal
            </a>
        </div>
    </form>

    <!-- Info -->
    <div class="mt-6 p-4 bg-[#FFD700]/10 border border-[#FFD700]/30 rounded-xl">
        <p class="text-xs text-[#0a1638] flex items-start gap-2">
            <i class="fas fa-lightbulb text-[#FFD700] mt-0.5 flex-shrink-0"></i>
            <span>
                Pengaturan ini akan digunakan di <strong>footer</strong>, <strong>halaman kontak</strong>, dan <strong>tombol WhatsApp</strong> di seluruh halaman website.
            </p>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function previewHero(event) {
        const file = event.target.files[0];
        if (!file) return;

        if (file.size > 3 * 1024 * 1024) {
            alert('Ukuran file maksimal 3MB');
            event.target.value = '';
            return;
        }

        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('hero-preview-image').src = e.target.result;
            document.getElementById('hero-preview-container').classList.remove('hidden');
            document.getElementById('hero-placeholder').classList.add('hidden');
            document.getElementById('hero-reset-btn').classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    }

    function resetHeroPreview() {
        document.getElementById('hero_background').value = '';
        document.getElementById('hero-preview-container').classList.add('hidden');
        document.getElementById('hero-placeholder').classList.remove('hidden');
        document.getElementById('hero-reset-btn').classList.add('hidden');
    }
</script>
@endpush
@endsection
