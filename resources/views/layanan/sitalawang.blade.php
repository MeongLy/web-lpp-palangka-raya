@extends('layouts.app')

@section('content')
@php
    use App\Models\Pengaturan;
    use Illuminate\Support\Str;

    $st = Pengaturan::getGroup('sitalawang');

    // ===== WhatsApp =====
    $whatsapp = $st['sitalawang_whatsapp'] ?? '0813-4349-363';
    $whatsappClean = preg_replace('/[^0-9]/', '', $whatsapp);
    if (substr($whatsappClean, 0, 1) === '0') {
        $whatsappClean = '62' . substr($whatsappClean, 1);
    } elseif (substr($whatsappClean, 0, 2) !== '62') {
        $whatsappClean = '62' . $whatsappClean;
    }
    $whatsappLink = 'https://wa.me/' . $whatsappClean;

    // ===== Deskripsi =====
    $deskripsi = $st['sitalawang_deskripsi']
        ?? 'SI-TALAWANG merupakan sistem informasi yang digunakan keluarga WBP untuk mendapatkan informasi terkait status usulan integrasi, penerimaan dokumen, maupun dokumentasi penerimaan.';

    // ===== Cara Menggunakan (array per baris) =====
    $caraRaw = $st['sitalawang_cara'] ?? '';
    $caraList = $caraRaw
        ? array_values(array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $caraRaw))))
        : [
            'Simpan nomor WhatsApp SI-TALAWANG',
            'Kirim pesan dengan format "Halo"',
            'Pilih layanan dengan mengetik angka',
        ];

    // ===== Keunggulan =====
    $keunggulanRaw = $st['sitalawang_keunggulan'] ?? '';
    $keunggulanList = $keunggulanRaw
        ? array_values(array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $keunggulanRaw))))
        : [
            'Informasi 24 Jam|Informasi dapat diakses 24 jam, kapan saja & di mana saja',
            'Memudahkan Keluarga WBP|Memudahkan keluarga WBP memperoleh informasi',
            'Proses Lebih Cepat|Proses lebih cepat dan transparan',
            'Pelayanan Gratis|Tidak dipungut biaya (GRATIS)',
        ];

    $keunggulanIcons = [
        'fa-clock',
        'fa-users',
        'fa-bolt',
        'fa-hand-holding-usd',
        'fa-shield-alt',
        'fa-star',
        'fa-check-circle',
        'fa-thumbs-up',
    ];

    // ===== Persyaratan =====
    $persyaratanRaw = $st['sitalawang_persyaratan'] ?? '';
    $persyaratanList = $persyaratanRaw
        ? array_values(array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $persyaratanRaw))))
        : [
            'KTP Penjamin',
            'Kartu Keluarga Penjamin',
            'Surat Domisili Penjamin (Jika alamat tidak sesuai KTP)',
        ];
@endphp

<!-- ===== BREADCRUMB ===== -->
<section class="bg-[#0a1638] py-8 sm:py-10 mt-16">
    <div class="container mx-auto px-4 sm:px-6">
        <p class="text-xs sm:text-sm text-white/70">
            <a href="{{ route('home') }}" class="text-[#FFD700] hover:text-[#FFE44D] transition">Beranda</a>
            <span class="text-white/50 mx-2">/</span>
            <a href="{{ route('home') }}#layanan" class="text-[#FFD700] hover:text-[#FFE44D] transition">Layanan</a>
            <span class="text-white/50 mx-2">/</span>
            <span class="text-[#FFD700]">SI-Talawang</span>
        </p>
        <h1 class="text-2xl sm:text-3xl font-bold text-white mt-2">SI-Talawang</h1>
        <p class="text-sm text-white/70">Sistem Informasi Tata Kelola Layanan Warga Binaan Program Integrasi</p>
    </div>
</section>

<!-- ===== KONTEN ===== -->
<section class="py-10 sm:py-12 bg-gray-50">
    <div class="container mx-auto px-4 sm:px-6">
        <div class="max-w-4xl mx-auto">

            <!-- Tombol Kembali -->
            <a href="{{ route('home') }}#layanan"
                class="inline-flex items-center gap-2 text-[#0a1638] hover:text-[#FFD700] transition mb-5 font-semibold text-sm">
                <i class="fas fa-arrow-left"></i> Kembali ke Layanan
            </a>

            <!-- ===== HEADER ===== -->
            <div class="bg-gradient-to-br from-[#0a1638] via-[#0f1f4a] to-[#14285c] rounded-2xl shadow-xl p-6 sm:p-10 text-white mb-8">
                <div class="flex flex-col sm:flex-row items-center gap-4 mb-4">
                    <div class="w-16 h-16 bg-[#FFD700] rounded-2xl flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-balance-scale text-[#0a1638] text-3xl"></i>
                    </div>
                    <div class="text-center sm:text-left">
                        <h2 class="text-2xl sm:text-3xl font-bold">SI-TALAWANG</h2>
                        <p class="text-sm text-[#FFD700] font-semibold">
                            Sistem Informasi Tata Kelola Layanan Warga Binaan Program Integrasi
                        </p>
                    </div>
                </div>
                <p class="text-sm sm:text-base text-white/80 leading-relaxed">
                    {{ $deskripsi }}
                </p>
                <div class="mt-6 flex flex-wrap gap-3">
                    <span class="px-4 py-2 bg-[#FFD700]/20 border border-[#FFD700]/40 rounded-full text-xs font-semibold">
                        <i class="fas fa-clock mr-1"></i> Mudah
                    </span>
                    <span class="px-4 py-2 bg-[#FFD700]/20 border border-[#FFD700]/40 rounded-full text-xs font-semibold">
                        <i class="fas fa-bolt mr-1"></i> Cepat
                    </span>
                    <span class="px-4 py-2 bg-[#FFD700]/20 border border-[#FFD700]/40 rounded-full text-xs font-semibold">
                        <i class="fas fa-lock mr-1"></i> Aman
                    </span>
                    <span class="px-4 py-2 bg-[#FFD700]/20 border border-[#FFD700]/40 rounded-full text-xs font-semibold">
                        <i class="fas fa-sitemap mr-1"></i> Terstruktur
                    </span>
                </div>
            </div>

             <!-- ===== VIDEO TUTORIAL ===== -->
            <div class="bg-white rounded-2xl shadow-lg p-6 sm:p-8 mb-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 bg-[#FF0000] rounded-xl flex items-center justify-center">
                        <i class="fab fa-youtube text-white text-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-xl sm:text-2xl font-bold text-[#0a1638]">Video Tutorial</h3>
                        <p class="text-xs sm:text-sm text-gray-500 mt-0.5">Panduan penggunaan SI-TALAWANG</p>
                    </div>
                </div>
                <div class="w-14 h-1 bg-[#FFD700] rounded-full mb-6"></div>

                <div class="relative w-full rounded-xl overflow-hidden shadow-lg bg-black" style="aspect-ratio: 16/9;">
                    <iframe
                        src="https://www.youtube.com/embed/yKpjnFR0QNQ"
                        title="Video Tutorial SI-TALAWANG"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin"
                        allowfullscreen
                        class="absolute inset-0 w-full h-full">
                    </iframe>
                </div>

                <div class="mt-5 flex flex-col sm:flex-row items-center justify-between gap-4 p-4 bg-gray-50 rounded-xl border border-gray-200">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-[#FF0000] rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fab fa-youtube text-white"></i>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-[#0a1638]">SI TALAWANG Hadir untuk Pelayanan yang Lebih Baik</p>
                            <p class="text-xs text-gray-500">Tonton video tutorial lengkapnya di YouTube</p>
                        </div>
                    </div>
                    <a href="https://youtu.be/yKpjnFR0QNQ?si=RoXC9yH7V8oIyUux"
                        target="_blank" rel="noopener noreferrer"
                        class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#FF0000] text-white rounded-full text-sm font-semibold hover:bg-[#cc0000] transition shadow-lg hover:shadow-xl flex-shrink-0">
                        <i class="fab fa-youtube"></i> Tonton di YouTube
                    </a>
                </div>

                <p class="text-xs text-gray-400 mt-3 flex items-start gap-2">
                    <i class="fas fa-info-circle text-[#FFD700] mt-0.5 flex-shrink-0"></i>
                    <span>
                        Video ini menjelaskan cara menggunakan layanan SI-TALAWANG untuk keluarga Warga Binaan Pemasyarakatan (WBP).
                    </span>
                </p>
            </div>

            <!-- ===== CARA MENGGUNAKAN ===== -->
            <div class="bg-white rounded-2xl shadow-lg p-6 sm:p-8 mb-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 bg-[#FFD700] rounded-xl flex items-center justify-center">
                        <i class="fas fa-question-circle text-[#0a1638]"></i>
                    </div>
                    <h3 class="text-xl sm:text-2xl font-bold text-[#0a1638]">Cara Menggunakan SI-TALAWANG</h3>
                </div>
                <div class="w-14 h-1 bg-[#FFD700] rounded-full mb-6"></div>

                <div class="space-y-4">
                    @foreach($caraList as $index => $cara)
                        <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-xl border-l-4 border-[#FFD700]">
                            <div class="w-10 h-10 bg-[#0a1638] rounded-full flex items-center justify-center flex-shrink-0 text-white font-bold">
                                {{ $index + 1 }}
                            </div>
                            <div class="flex-1">
                                @if($index === 0)
                                    <h4 class="font-bold text-[#0a1638] text-sm sm:text-base mb-1">{{ $cara }}</h4>
                                    <p class="text-sm text-gray-600">Simpan nomor WhatsApp SI-TALAWANG:</p>
                                    <a href="{{ $whatsappLink }}" target="_blank"
                                        class="inline-flex items-center gap-2 mt-2 px-4 py-2 bg-[#25D366] text-white rounded-full text-sm font-semibold hover:bg-[#1eb855] transition">
                                        <i class="fab fa-whatsapp"></i> {{ $whatsapp }}
                                    </a>
                                @elseif($index === 1)
                                    <h4 class="font-bold text-[#0a1638] text-sm sm:text-base mb-1">{{ $cara }}</h4>
                                    <p class="text-sm text-gray-600">Kirim pesan dengan format:</p>
                                    <span class="inline-block mt-2 px-4 py-2 bg-[#FFD700]/20 border border-[#FFD700] rounded-lg text-sm font-bold text-[#0a1638]">"Halo"</span>
                                @elseif($index === 2)
                                    <h4 class="font-bold text-[#0a1638] text-sm sm:text-base mb-2">{{ $cara }}</h4>
                                    <div class="space-y-2 mt-2">
                                        <div class="flex items-start gap-3 p-3 bg-white rounded-lg border border-gray-200">
                                            <span class="w-6 h-6 bg-[#FFD700] rounded-full flex items-center justify-center text-[#0a1638] text-xs font-bold flex-shrink-0">1</span>
                                            <div>
                                                <p class="text-xs font-bold text-[#0a1638]">INFORMASI PENERIMAAN DOKUMEN</p>
                                                <p class="text-xs text-gray-500">Cek status penerimaan dokumen usulan integrasi</p>
                                            </div>
                                        </div>
                                        <div class="flex items-start gap-3 p-3 bg-white rounded-lg border border-gray-200">
                                            <span class="w-6 h-6 bg-[#FFD700] rounded-full flex items-center justify-center text-[#0a1638] text-xs font-bold flex-shrink-0">2</span>
                                            <div>
                                                <p class="text-xs font-bold text-[#0a1638]">INFORMASI STATUS USULAN</p>
                                                <p class="text-xs text-gray-500">Monitoring progres usulan integrasi secara real-time</p>
                                            </div>
                                        </div>
                                        <div class="flex items-start gap-3 p-3 bg-white rounded-lg border border-gray-200">
                                            <span class="w-6 h-6 bg-[#FFD700] rounded-full flex items-center justify-center text-[#0a1638] text-xs font-bold flex-shrink-0">3</span>
                                            <div>
                                                <p class="text-xs font-bold text-[#0a1638]">INFORMASI PENGAMBILAN DOKUMEN</p>
                                                <p class="text-xs text-gray-500">Menunggu 2/3 masa pidana untuk pengambilan dokumen</p>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <h4 class="font-bold text-[#0a1638] text-sm sm:text-base mb-1">{{ $cara }}</h4>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- ===== KEUNGGULAN ===== -->
            <div class="bg-white rounded-2xl shadow-lg p-6 sm:p-8 mb-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 bg-[#FFD700] rounded-xl flex items-center justify-center">
                        <i class="fas fa-star text-[#0a1638]"></i>
                    </div>
                    <h3 class="text-xl sm:text-2xl font-bold text-[#0a1638]">Keunggulan SI-TALAWANG</h3>
                </div>
                <div class="w-14 h-1 bg-[#FFD700] rounded-full mb-6"></div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach($keunggulanList as $index => $keunggulan)
                        @php
                            $parts = explode('|', $keunggulan);
                            $judul = $parts[0] ?? $keunggulan;
                            $sub = $parts[1] ?? '';
                            $icon = $keunggulanIcons[$index % count($keunggulanIcons)];
                        @endphp
                        <div class="flex items-start gap-3 p-4 bg-gray-50 rounded-xl hover:bg-[#FFD700]/10 transition">
                            <div class="w-10 h-10 bg-[#0a1638] rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas {{ $icon }} text-[#FFD700]"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-[#0a1638] text-sm">{{ $judul }}</h4>
                                @if($sub)
                                    <p class="text-xs text-gray-500 mt-0.5">{{ $sub }}</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-6 p-4 bg-[#0a1638] rounded-xl text-center">
                    <p class="text-[#FFD700] text-sm font-bold uppercase tracking-wider mb-1">Komitmen Kami</p>
                    <p class="text-white text-sm">
                        Seluruh layanan integrasi di <span class="font-bold text-[#FFD700]">Lapas Perempuan Kelas IIA Palangka Raya</span>
                        <span class="font-bold text-[#FFD700]">TIDAK DIPUNGUT BIAYA (GRATIS)</span>.
                    </p>
                </div>
            </div>

            <!-- ===== PERSYARATAN DOKUMEN ===== -->
            <div class="bg-white rounded-2xl shadow-lg p-6 sm:p-8 mb-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 bg-[#FFD700] rounded-xl flex items-center justify-center">
                        <i class="fas fa-file-alt text-[#0a1638]"></i>
                    </div>
                    <h3 class="text-xl sm:text-2xl font-bold text-[#0a1638]">Persyaratan Dokumen Penjamin</h3>
                </div>
                <div class="w-14 h-1 bg-[#FFD700] rounded-full mb-6"></div>

                <ol class="space-y-3">
                    @foreach($persyaratanList as $index => $syarat)
                        <li class="flex items-start gap-3 p-3 bg-gray-50 rounded-lg">
                            <span class="w-7 h-7 bg-[#0a1638] rounded-full flex items-center justify-center text-white text-xs font-bold flex-shrink-0">
                                {{ $index + 1 }}
                            </span>
                            <span class="text-sm text-gray-700">
                                @if(str_contains($syarat, '('))
                                    {{ Str::before($syarat, '(') }}
                                    <span class="text-gray-400">({{ Str::between($syarat, '(', ')') }})</span>
                                @else
                                    {{ $syarat }}
                                @endif
                            </span>
                        </li>
                    @endforeach
                </ol>
            </div>

            <!-- ===== HUBUNGI KAMI ===== -->
            <div class="bg-gradient-to-br from-[#0a1638] to-[#0f1f4a] rounded-2xl shadow-lg p-6 sm:p-8 text-white">
                <h3 class="text-xl sm:text-2xl font-bold mb-6 text-center">Hubungi Kami</h3>
                <div class="w-14 h-1 bg-[#FFD700] rounded-full mx-auto mb-6"></div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 bg-[#FFD700]/20 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-building text-[#FFD700]"></i>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-[#FFD700]">LAPAS PEREMPUAN</p>
                                <p class="text-sm">Kelas IIA Palangka Raya</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 bg-[#FFD700]/20 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fab fa-whatsapp text-[#FFD700]"></i>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-[#FFD700]">WhatsApp SI-TALAWANG</p>
                                <a href="{{ $whatsappLink }}" target="_blank" class="text-sm hover:text-[#FFD700] transition">
                                    {{ $whatsapp }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="text-center sm:text-left">
                        <p class="text-sm text-white/70 mb-4">Klik tombol di bawah untuk memulai chat dengan SI-TALAWANG</p>
                        <a href="{{ $whatsappLink }}" target="_blank" rel="noopener noreferrer"
                            class="inline-flex items-center gap-2 px-6 py-3 bg-[#25D366] text-white rounded-full font-bold hover:bg-[#1eb855] transition shadow-lg hover:shadow-xl">
                            <i class="fab fa-whatsapp text-xl"></i> PINDAI SAYA
                        </a>
                        <p class="text-xs text-white/50 mt-2">Chat WhatsApp SI-TALAWANG</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection
