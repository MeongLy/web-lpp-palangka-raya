@extends('layouts.app')

@section('content')

@include('landing.partials.hero')

{{-- ===== BANNER PENGUMUMAN (DINAMIS) ===== --}}
<div id="pengumumanBanner" class="hidden"></div>

@include('landing.partials.profil')
@include('landing.partials.visi-misi')
@include('landing.partials.layanan')
@include('landing.partials.berita')
@include('landing.partials.galeri')
@include('landing.partials.kontak')

<!-- ===== POPUP PENGUMUMAN (DINAMIS) ===== -->
<div id="pengumumanPopup" class="hidden fixed inset-0 z-[9999] items-center justify-center p-4"
    style="background-color: rgba(10, 22, 56, 0.8); backdrop-filter: blur(4px);">

    <div class="relative bg-white rounded-2xl shadow-2xl max-w-lg w-full max-h-[90vh] overflow-hidden animate-popup">

        <!-- Header -->
        <div class="bg-gradient-to-r from-[#0a1638] to-[#0f1f4a] p-5 text-white relative">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-[#FFD700] rounded-xl flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-bullhorn text-[#0a1638]"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-[10px] font-bold text-[#FFD700] uppercase tracking-wider">
                        <i class="fas fa-info-circle mr-1"></i> Pengumuman
                    </p>
                    <h3 id="popupTitle" class="text-base sm:text-lg font-bold truncate">Memuat...</h3>
                </div>
            </div>

            <button type="button" onclick="closePengumuman()"
                class="absolute top-4 right-4 w-8 h-8 bg-white/20 hover:bg-white/30 rounded-full flex items-center justify-center text-white transition"
                aria-label="Tutup">
                <i class="fas fa-times text-sm"></i>
            </button>
        </div>

        <!-- Body -->
        <div class="max-h-[60vh] overflow-y-auto">
            <div id="popupImageWrapper" class="hidden w-full aspect-video bg-gray-100">
                <img id="popupImage" src="" alt="" class="w-full h-full object-cover">
            </div>

            <div class="p-5 sm:p-6">
                <div id="popupIsi" class="text-sm text-gray-700 leading-relaxed whitespace-pre-line"></div>

                <div id="popupJadwal"
                    class="hidden mt-4 pt-4 border-t border-gray-100 flex items-center gap-2 text-xs text-gray-500">
                    <i class="fas fa-calendar-alt text-[#FFD700]"></i>
                    <span>Berlaku sampai: <strong id="popupSelesai"></strong></span>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="p-4 sm:p-5 bg-gray-50 border-t border-gray-100 flex flex-col sm:flex-row gap-2">
            <a id="popupLink" href="#"
                class="hidden flex-1 items-center justify-center gap-2 px-5 py-2.5 bg-[#0a1638] text-white rounded-full text-sm font-bold hover:bg-[#0f1f4a] transition">
                <i class="fas fa-arrow-right"></i> <span id="popupLinkLabel">Selengkapnya</span>
            </a>

            <button type="button" onclick="closePengumuman()"
                class="flex-1 inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-gray-200 text-gray-700 rounded-full text-sm font-semibold hover:bg-gray-300 transition">
                <i class="fas fa-times"></i> Tutup
            </button>
        </div>

        <!-- Counter -->
        <div id="popupCounter"
            class="hidden absolute top-4 left-4 bg-[#FFD700] text-[#0a1638] px-2 py-1 rounded-full text-[10px] font-bold shadow-lg">
            <span id="currentIndex">1</span> / <span id="totalCount">1</span>
        </div>

    </div>
</div>

@endsection

@push('styles')
<style>
    @keyframes popupIn {
        from { opacity: 0; transform: scale(0.9) translateY(20px); }
        to   { opacity: 1; transform: scale(1) translateY(0); }
    }

    @keyframes bannerIn {
        from { opacity: 0; transform: translateY(-20px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .animate-popup {
        animation: popupIn 0.3s ease-out;
    }

    .animate-banner {
        animation: bannerIn 0.4s ease-out;
    }

    body.popup-open {
        overflow: hidden;
    }
</style>
@endpush

@push('scripts')
<script>
// ========================================
// BANNER PENGUMUMAN
// ========================================
(function () {
    const bannerContainer = document.getElementById('pengumumanBanner');
    if (!bannerContainer) return;

    fetch('{{ route('pengumuman.banner') }}', {
        headers: {
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
        }
    })
    .then(res => res.json())
    .then(data => {
        if (!data.pengumumans || data.pengumumans.length === 0) return;

        // Filter yang belum di-dismiss
        const banners = data.pengumumans.filter(item => {
            return !localStorage.getItem('banner_dismissed_' + item.id);
        });

        if (banners.length === 0) return;

        renderBanner(banners[0]);
        bannerContainer.classList.remove('hidden');
    })
    .catch(err => console.error('Gagal load banner:', err));

    function renderBanner(item) {
        const hasImage = item.gambar;

        bannerContainer.innerHTML = `
            <div class="relative bg-gradient-to-r from-[#0a1638] via-[#0f1f4a] to-[#14285c] text-white overflow-hidden animate-banner">
                ${hasImage ? `
                <div class="absolute inset-0">
                    <img src="${item.gambar}" alt="" class="w-full h-full object-cover opacity-20">
                </div>
                ` : ''}

                <div class="relative container mx-auto px-4 sm:px-6 py-4">
                    <div class="flex items-center gap-3 sm:gap-4">
                        <!-- Icon -->
                        <div class="w-10 h-10 bg-[#FFD700] rounded-xl flex items-center justify-center flex-shrink-0 animate-pulse">
                            <i class="fas fa-bullhorn text-[#0a1638]"></i>
                        </div>

                        <!-- Text -->
                        <div class="flex-1 min-w-0">
                            <p class="text-[10px] font-bold text-[#FFD700] uppercase tracking-wider mb-0.5">
                                <i class="fas fa-info-circle mr-1"></i> Pengumuman
                            </p>
                            <p class="text-sm sm:text-base font-bold truncate">${escapeHtml(item.judul)}</p>
                            <p class="text-xs text-white/70 truncate hidden sm:block">${escapeHtml(truncate(item.isi, 100))}</p>
                        </div>

                        <!-- CTA -->
                        ${item.link ? `
                        <a href="${item.link}"
                           class="hidden sm:inline-flex items-center gap-2 px-4 py-2 bg-[#FFD700] text-[#0a1638] rounded-full text-xs font-bold hover:bg-[#FFE44D] transition flex-shrink-0">
                            ${escapeHtml(item.link_label || 'Selengkapnya')}
                            <i class="fas fa-arrow-right text-[10px]"></i>
                        </a>
                        ` : ''}

                        <!-- Close -->
                        <button type="button"
                                onclick="closeBanner(${item.id})"
                                class="w-8 h-8 bg-white/10 hover:bg-white/20 rounded-full flex items-center justify-center text-white transition flex-shrink-0"
                                aria-label="Tutup">
                            <i class="fas fa-times text-xs"></i>
                        </button>
                    </div>
                </div>
            </div>
        `;
    }

    function truncate(text, length) {
        return text.length > length ? text.substring(0, length) + '...' : text;
    }

    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    window.closeBanner = function (id) {
        localStorage.setItem('banner_dismissed_' + id, '1');

        bannerContainer.style.transition = 'all 0.3s ease-out';
        bannerContainer.style.opacity = '0';
        bannerContainer.style.transform = 'translateY(-20px)';

        setTimeout(() => {
            bannerContainer.classList.add('hidden');
            bannerContainer.innerHTML = '';
        }, 300);
    };
})();

// ========================================
// POPUP PENGUMUMAN
// ========================================
(function () {
    const popup = document.getElementById('pengumumanPopup');
    if (!popup) return;

    let pengumumans = [];
    let currentIndex = 0;

    fetch('{{ route('pengumuman.popup') }}', {
        headers: {
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
        }
    })
    .then(res => res.json())
    .then(data => {
        if (!data.pengumumans || data.pengumumans.length === 0) return;

        pengumumans = data.pengumumans.filter(item => {
            return !localStorage.getItem('pengumuman_dismissed_' + item.id);
        });

        if (pengumumans.length === 0) return;

        currentIndex = 0;
        showPopup(pengumumans[0]);

        setTimeout(() => {
            popup.classList.remove('hidden');
            popup.classList.add('flex');
            document.body.classList.add('popup-open');
        }, 800);
    })
    .catch(err => console.error('Gagal load pengumuman:', err));

    function showPopup(item) {
        document.getElementById('popupTitle').textContent = item.judul;
        document.getElementById('popupIsi').textContent = item.isi;

        const imgWrapper = document.getElementById('popupImageWrapper');
        if (item.gambar) {
            document.getElementById('popupImage').src = item.gambar;
            document.getElementById('popupImage').alt = item.judul;
            imgWrapper.classList.remove('hidden');
        } else {
            imgWrapper.classList.add('hidden');
        }

        const link = document.getElementById('popupLink');
        if (item.link) {
            link.href = item.link;
            link.classList.remove('hidden');
            link.classList.add('inline-flex');
            document.getElementById('popupLinkLabel').textContent = item.link_label || 'Selengkapnya';
        } else {
            link.classList.add('hidden');
            link.classList.remove('inline-flex');
        }

        const jadwal = document.getElementById('popupJadwal');
        if (item.selesai) {
            document.getElementById('popupSelesai').textContent = item.selesai;
            jadwal.classList.remove('hidden');
        } else {
            jadwal.classList.add('hidden');
        }

        const counter = document.getElementById('popupCounter');
        if (pengumumans.length > 1) {
            counter.classList.remove('hidden');
            document.getElementById('currentIndex').textContent = currentIndex + 1;
            document.getElementById('totalCount').textContent = pengumumans.length;
        } else {
            counter.classList.add('hidden');
        }
    }

    window.closePengumuman = function () {
        const current = pengumumans[currentIndex];
        if (current) {
            localStorage.setItem('pengumuman_dismissed_' + current.id, '1');
        }

        currentIndex++;
        if (currentIndex < pengumumans.length) {
            showPopup(pengumumans[currentIndex]);
        } else {
            popup.classList.add('hidden');
            popup.classList.remove('flex');
            document.body.classList.remove('popup-open');
        }
    };

    popup.addEventListener('click', function (e) {
        if (e.target === popup) closePengumuman();
    });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && !popup.classList.contains('hidden')) {
            closePengumuman();
        }
    });
})();
</script>
@endpush
