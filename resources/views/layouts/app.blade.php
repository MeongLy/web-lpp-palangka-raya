<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon/favicon.ico') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon/favicon.ico') }}">
    <title>Lapas Perempuan Palangka Raya</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Poppins:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Custom CSS -->
    @vite(['resources/css/app.css'])

</head>

@php
use App\Models\Pengaturan;
$__settings = Pengaturan::pluck('value', 'key')->toArray();

// Kontak
$__alamat = $__settings['alamat'] ?? 'Jl. Tjilik Riwut No.km. 5, Bukit Tunggal, Kec. Jekan Raya, Kota Palangka Raya';
$__telepon = $__settings['telepon'] ?? '+62 812-3456-7890';
$__email = $__settings['email'] ?? 'lapas.perempuan@kemenkumham.go.id';

// Sosial
$__whatsapp = $__settings['whatsapp'] ?? '6281234567890';
$__whatsappClean = preg_replace('/[^0-9]/', '', $__whatsapp);
if (substr($__whatsappClean, 0, 1) === '0') {
$__whatsappClean = '62' . substr($__whatsappClean, 1);
} elseif (substr($__whatsappClean, 0, 2) !== '62') {
$__whatsappClean = '62' . $__whatsappClean;
}
$__whatsappLink = 'https://wa.me/' . $__whatsappClean;

$__facebook = $__settings['facebook'] ?? '#';
$__instagram = $__settings['instagram'] ?? '#';
$__youtube = $__settings['youtube'] ?? '#';
$__twitter = $__settings['twitter'] ?? '#';
@endphp


<body class="bg-gray-50 text-gray-800 font-sans antialiased">
    <!-- ===== LOADING SCREEN ===== -->
    <div id="loading-screen">
        <div class="loader">
            <div class="loader-ring"></div>
            <div class="loader-ring"></div>
            <div class="loader-ring"></div>
        </div>
        <div class="loader-text">
            Memuat
            <div class="loader-dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>

    <!-- ===== LIGHTBOX ===== -->
    <div class="lightbox" id="lightbox">
        <span class="lightbox-close" id="lightbox-close">&times;</span>
        <img id="lightbox-img" src="" alt="Zoom Image">
    </div>

    <!-- ===== NAVBAR ===== -->
    <nav id="navbar" class="navbar fixed w-full z-50 top-0 left-0">
        <div class="container mx-auto px-4 sm:px-6">
            <div class="flex justify-between items-center h-16 md:h-20">

                <!-- ===== BRAND (2 LOGO) ===== -->
                <a href="{{ route('home') }}" class="brand-container">
                    <div class="logo-icon">
                        <img src="{{ asset('images/images1.png') }}" alt="Logo Kemenimipas">
                    </div>

                    <div class="logo-icon">
                        <img src="{{ asset('images/images2.png') }}" alt="Logo Lapas Perempuan">
                    </div>

                    <div class="flex flex-col">
                        <span class="brand-text">Lapas Perempuan</span>
                        <span class="brand-sub">Kelas II A Palangka Raya</span>
                    </div>
                </a>

                <!-- ===== DESKTOP MENU (SEJAJAR) ===== -->
                <div class="hidden lg:flex items-center gap-1 navbar-menu">
                    <a href="{{ route('home') }}#beranda" class="nav-link">Beranda</a>

                    <!-- Dropdown Profil -->
                    <div class="dropdown" id="dropdown-profil">
                        <span class="nav-link no-underline" id="profil-trigger">
                            <span>Profil</span>
                            <i class="fas fa-chevron-down"></i>
                        </span>
                        <div class="dropdown-menu" id="dropdown-menu">
                            <a href="{{ route('pejabat') }}" class="dropdown-item">
                                Profil Pejabat
                            </a>
                            <a href="{{ route('struktur') }}" class="dropdown-item">
                                Struktur Organisasi
                            </a>
                        </div>
                    </div>

                    <a href="{{ route('home') }}#visi-misi" class="nav-link">Visi & Misi</a>

                    <!-- Dropdown Layanan -->
                    <div class="dropdown" id="dropdown-layanan">
                        <span class="nav-link no-underline" id="layanan-trigger">
                            <span>Layanan</span>
                            <i class="fas fa-chevron-down"></i>
                        </span>
                        <div class="dropdown-menu" id="dropdown-menu-layanan">
                            <a href="{{ route('layanan.sitalawang') }}" class="dropdown-item">
                                SI-Talawang
                            </a>
                            <a href="{{ route('layanan.survei') }}" class="dropdown-item">
                                Hasil Survei
                            </a>
                        </div>
                    </div>

                    <a href="{{ route('home') }}#berita" class="nav-link">Berita</a>
                    <a href="{{ route('home') }}#galeri" class="nav-link">Bawi'S</a>
                    <a href="{{ route('home') }}#kontak" class="nav-link">Kontak</a>
                </div>

                <!-- ===== MOBILE MENU BUTTON ===== -->
                <button id="menu-toggle" class="lg:hidden menu-toggle-btn">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>

        <!-- ===== MOBILE MENU ===== -->
        <div id="mobile-menu" class="mobile-menu-container">
            <div class="mobile-menu-inner">
                <a href="{{ route('home') }}#beranda" class="mobile-nav-link">
                    <i class="fas fa-home"></i> Beranda
                </a>

                <!-- Mobile Dropdown Profil -->
                <div class="mobile-nav-link" style="cursor:pointer;" id="mobile-profil-toggle">
                    <i class="fas fa-info-circle"></i> Profil
                    <i class="fas fa-chevron-down float-right mt-1 text-xs" id="mobile-profil-icon"></i>
                </div>
                <div class="mobile-sub-menu hidden" id="mobile-profil-sub">
                    <a href="{{ route('pejabat') }}" class="mobile-sub-link">
                        Profil Pejabat
                    </a>
                    <a href="{{ route('struktur') }}" class="mobile-sub-link">
                        Struktur Organisasi
                    </a>
                </div>

                <a href="{{ route('home') }}#visi-misi" class="mobile-nav-link">
                    <i class="fas fa-eye"></i> Visi & Misi
                </a>

                <!-- Mobile Dropdown Layanan -->
                <div class="mobile-nav-link" style="cursor:pointer;" id="mobile-layanan-toggle">
                    <i class="fas fa-hand-holding-heart"></i> Layanan
                    <i class="fas fa-chevron-down float-right mt-1 text-xs" id="mobile-layanan-icon"></i>
                </div>
                <div class="mobile-sub-menu hidden" id="mobile-layanan-sub">
                    <a href="{{ route('layanan.sitalawang') }}" class="mobile-sub-link">
                        SI-Talawang
                    </a>
                    <a href="{{ route('layanan.survei') }}" class="mobile-sub-link">
                        Hasil Survei
                    </a>
                </div>

                <a href="{{ route('home') }}#berita" class="mobile-nav-link">
                    <i class="fas fa-newspaper"></i> Berita
                </a>
                <a href="{{ route('home') }}#galeri" class="mobile-nav-link">
                    <i class="fas fa-images"></i> Bawis'S
                </a>
                <a href="{{ route('home') }}#kontak" class="mobile-nav-link">
                    <i class="fas fa-envelope"></i> Kontak
                </a>
            </div>
        </div>
    </nav>

    <!-- ===== KONTEN UTAMA ===== -->
    <main>
        @yield('content')
    </main>

    <!-- ===== FOOTER ===== -->
    <footer class="bg-[#0a1638] text-white py-8 sm:py-12 border-t-2 border-[#FFD700]">
        <div class="container mx-auto px-4 sm:px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                <!-- Kolom 1: Info -->
                <div>
                    <h4 class="text-[#FFD700] font-bold text-lg mb-4">
                        Lapas Perempuan Kelas II A Palangka Raya
                    </h4>
                    <p class="text-sm opacity-80 mb-3">
                        Melayani dengan hati, membina dengan profesionalisme.
                    </p>
                    <p class="text-xs opacity-60 leading-relaxed">
                        <i class="fas fa-map-marker-alt mr-1 text-[#FFD700]"></i>
                        {{ $__alamat }}
                    </p>
                </div>

                <!-- Kolom 2: Kontak -->
                <div>
                    <h4 class="text-[#FFD700] font-bold text-lg mb-4">Kontak</h4>
                    <p class="text-sm opacity-80 mb-2">
                        <i class="fas fa-phone mr-2 text-[#FFD700]"></i>
                        <a href="tel:{{ preg_replace('/[^0-9+]/', '', $__telepon) }}"
                            class="hover:text-[#FFD700] transition">
                            {{ $__telepon }}
                        </a>
                    </p>
                    @if(!empty($__settings['telepon_2']))
                    <p class="text-sm opacity-80 mb-2">
                        <i class="fas fa-phone mr-2 text-[#FFD700]"></i>
                        <a href="tel:{{ preg_replace('/[^0-9+]/', '', $__settings['telepon_2']) }}"
                            class="hover:text-[#FFD700] transition">
                            {{ $__settings['telepon_2'] }}
                        </a>
                    </p>
                    @endif
                    <p class="text-sm opacity-80">
                        <i class="fas fa-envelope mr-2 text-[#FFD700]"></i>
                        <a href="mailto:{{ $__email }}" class="hover:text-[#FFD700] transition">
                            {{ $__email }}
                        </a>
                    </p>
                </div>

                <!-- Kolom 3: Sosmed -->
                <div>
                    <h4 class="text-[#FFD700] font-bold text-lg mb-4">Ikuti Kami</h4>
                    <div class="flex flex-wrap gap-3">
                        @if($__facebook && $__facebook !== '#')
                        <a href="{{ $__facebook }}" target="_blank" rel="noopener noreferrer"
                            class="w-10 h-10 bg-white/10 hover:bg-[#1877F2] rounded-lg flex items-center justify-center transition"
                            title="Facebook">
                            <i class="fab fa-facebook-f text-white"></i>
                        </a>
                        @endif

                        @if($__instagram && $__instagram !== '#')
                        <a href="{{ $__instagram }}" target="_blank" rel="noopener noreferrer"
                            class="w-10 h-10 bg-white/10 hover:bg-gradient-to-br hover:from-[#833AB4] hover:via-[#FD1D1D] hover:to-[#FCB045] rounded-lg flex items-center justify-center transition"
                            title="Instagram">
                            <i class="fab fa-instagram text-white"></i>
                        </a>
                        @endif

                        @if($__twitter && $__twitter !== '#')
                        <a href="{{ $__twitter }}" target="_blank" rel="noopener noreferrer"
                            class="w-10 h-10 bg-white/10 hover:bg-black rounded-lg flex items-center justify-center transition"
                            title="X (Twitter)">
                            <i class="fab fa-x-twitter text-white"></i>
                        </a>
                        @endif

                        @if($__youtube && $__youtube !== '#')
                        <a href="{{ $__youtube }}" target="_blank" rel="noopener noreferrer"
                            class="w-10 h-10 bg-white/10 hover:bg-[#FF0000] rounded-lg flex items-center justify-center transition"
                            title="YouTube">
                            <i class="fab fa-youtube text-white"></i>
                        </a>
                        @endif

                        @if($__whatsappClean)
                        <a href="{{ $__whatsappLink }}" target="_blank" rel="noopener noreferrer"
                            class="w-10 h-10 bg-white/10 hover:bg-[#25D366] rounded-lg flex items-center justify-center transition"
                            title="WhatsApp">
                            <i class="fab fa-whatsapp text-white"></i>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="border-t border-[#14285c] pt-6 text-center text-sm opacity-70">
                <p>&copy; {{ date('Y') }} Lapas Perempuan Palangka Raya - Kementerian Imigrasi dan Pemasyarakatan RI</p>
            </div>
        </div>
    </footer>

    <!-- ===== WHATSAPP FLOATING BUTTON =====
    @if($__whatsappClean)
    <a href="{{ $__whatsappLink }}" target="_blank" rel="noopener noreferrer"
        class="whatsapp-float fixed bottom-6 right-6 z-50 group">
        <div class="relative">
            <div class="absolute -inset-4 bg-[#25D366] rounded-full opacity-30 animate-ping"></div>
            <div class="absolute -inset-2 bg-[#25D366] rounded-full opacity-20 animate-pulse"></div>
            <div
                class="relative bg-[#25D366] w-14 h-14 sm:w-16 sm:h-16 rounded-full shadow-2xl flex items-center justify-center hover:scale-110 transition-all duration-300 group-hover:shadow-[#25D366]/50">
                <i class="fab fa-whatsapp text-white text-2xl sm:text-3xl"></i>
            </div>
            <div
                class="absolute bottom-full right-0 mb-3 bg-[#0a1638] text-white px-4 py-2 rounded-lg text-sm font-semibold whitespace-nowrap opacity-0 group-hover:opacity-100 transition-all duration-300 translate-y-2 group-hover:translate-y-0 pointer-events-none shadow-lg">
                Hubungi Kami via WhatsApp
                <div class="absolute bottom-0 right-4 transform translate-y-1/2 rotate-45 w-2 h-2 bg-[#0a1638]"></div>
            </div>
        </div>
    </a> -->
    @endif
    <!-- ===== JAVASCRIPT ===== -->
    @vite(['resources/js/app.js'])

    @stack('scripts')

</body>

</html>
