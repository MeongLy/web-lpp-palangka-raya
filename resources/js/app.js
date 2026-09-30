// ========================================
// LOADING SCREEN
// ========================================
let loadingStartTime = Date.now();

window.addEventListener('load', function() {
    let elapsed = Date.now() - loadingStartTime;
    let minDisplay = 500;
    let remaining = Math.max(0, minDisplay - elapsed);
    setTimeout(function() {
        const loadingScreen = document.getElementById('loading-screen');
        if (loadingScreen) {
            loadingScreen.classList.add('hidden');
            setTimeout(function() {
                loadingScreen.style.display = 'none';
            }, 400);
        }
    }, remaining);
});

// ========================================
// DETECT PAGE
// ========================================
function isHomePage() {
    const path = window.location.pathname;
    return path === '/' || path === '/home' || path === '';
}

// ========================================
// NAVBAR SOLID / TRANSPARAN
// ========================================
const navbar = document.getElementById('navbar');

if (navbar) {
    if (!isHomePage()) {
        navbar.classList.add('navbar-solid');
    }

    window.addEventListener('scroll', function() {
        if (isHomePage()) {
            if (window.scrollY > 50) {
                navbar.classList.add('navbar-scrolled');
                navbar.classList.remove('navbar-solid');
            } else {
                navbar.classList.remove('navbar-scrolled');
                navbar.classList.remove('navbar-solid');
            }
        } else {
            navbar.classList.add('navbar-solid');
            navbar.classList.remove('navbar-scrolled');
        }
    });
}

// ========================================
// LIGHTBOX / ZOOM IMAGE - EVENT DELEGATION
// ========================================
function openLightbox(src) {
    var lightbox = document.getElementById('lightbox');
    var lightboxImg = document.getElementById('lightbox-img');

    if (lightbox && lightboxImg) {
        lightboxImg.src = src;
        lightbox.classList.add('active');
        document.body.style.overflow = 'hidden';
    }
}

function closeLightbox() {
    var lightbox = document.getElementById('lightbox');
    if (lightbox) {
        lightbox.classList.remove('active');
        document.body.style.overflow = 'auto';
    }
}

// EVENT DELEGATION - Berlaku untuk SEMUA gambar .zoomable
document.addEventListener('DOMContentLoaded', function() {

    // Pasang listener di body sekali saja
    document.body.addEventListener('click', function(e) {
        var target = e.target;

        // Cek jika yang diklik adalah gambar .zoomable
        if (target.classList && target.classList.contains('zoomable')) {
            e.preventDefault();
            e.stopPropagation();
            openLightbox(target.src);
            return;
        }

        // Cek jika parent dari yang diklik adalah .zoomable
        var zoomableParent = target.closest ? target.closest('.zoomable') : null;
        if (zoomableParent) {
            e.preventDefault();
            e.stopPropagation();
            openLightbox(zoomableParent.src);
            return;
        }
    });

    // Close button
    var lightboxClose = document.getElementById('lightbox-close');
    if (lightboxClose) {
        lightboxClose.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            closeLightbox();
        });
    }

    // Klik di luar gambar = tutup
    var lightbox = document.getElementById('lightbox');
    if (lightbox) {
        lightbox.addEventListener('click', function(e) {
            if (e.target === this) {
                closeLightbox();
            }
        });
    }

    // ESC = tutup
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            var lb = document.getElementById('lightbox');
            if (lb && lb.classList.contains('active')) {
                closeLightbox();
            }
        }
    });

    // Set cursor pointer untuk semua .zoomable
    setTimeout(function() {
        document.querySelectorAll('.zoomable').forEach(function(img) {
            img.style.cursor = 'pointer';
        });
    }, 100);
});

// ========================================
// DROPDOWN PROFIL
// ========================================
const profilTrigger = document.getElementById('profil-trigger');
const dropdownMenu = document.getElementById('dropdown-menu');
let isDropdownOpen = false;

if (profilTrigger && dropdownMenu) {
    profilTrigger.addEventListener('click', function(e) {
        e.stopPropagation();
        isDropdownOpen = !isDropdownOpen;
        dropdownMenu.classList.toggle('show');
        const icon = this.querySelector('.fa-chevron-down');
        if (icon) {
            icon.style.transform = isDropdownOpen ? 'rotate(180deg)' : 'rotate(0deg)';
        }
    });

    document.addEventListener('click', function(e) {
        if (!e.target.closest('.dropdown')) {
            dropdownMenu.classList.remove('show');
            isDropdownOpen = false;
            const icon = profilTrigger.querySelector('.fa-chevron-down');
            if (icon) {
                icon.style.transform = 'rotate(0deg)';
            }
        }
    });

    const dropdownContainer = document.getElementById('dropdown-profil');
    if (dropdownContainer) {
        dropdownContainer.addEventListener('mouseenter', function() {
            if (window.innerWidth >= 1024) {
                isDropdownOpen = true;
                dropdownMenu.classList.add('show');
                const icon = profilTrigger.querySelector('.fa-chevron-down');
                if (icon) {
                    icon.style.transform = 'rotate(180deg)';
                }
            }
        });

        dropdownContainer.addEventListener('mouseleave', function() {
            if (window.innerWidth >= 1024) {
                isDropdownOpen = false;
                dropdownMenu.classList.remove('show');
                const icon = profilTrigger.querySelector('.fa-chevron-down');
                if (icon) {
                    icon.style.transform = 'rotate(0deg)';
                }
            }
        });
    }
}

// ========================================
// MOBILE SUB MENU PROFIL
// ========================================
const mobileProfilToggle = document.getElementById('mobile-profil-toggle');
const mobileProfilSub = document.getElementById('mobile-profil-sub');
const mobileProfilIcon = document.getElementById('mobile-profil-icon');

if (mobileProfilToggle && mobileProfilSub) {
    mobileProfilToggle.addEventListener('click', function() {
        mobileProfilSub.classList.toggle('hidden');
        if (mobileProfilIcon) {
            mobileProfilIcon.classList.toggle('fa-chevron-down');
            mobileProfilIcon.classList.toggle('fa-chevron-up');
        }
    });
}

// ========================================
// DROPDOWN LAYANAN
// ========================================
var layananTrigger = document.getElementById('layanan-trigger');
var dropdownMenuLayanan = document.getElementById('dropdown-menu-layanan');
var isDropdownLayananOpen = false;

if (layananTrigger && dropdownMenuLayanan) {
    layananTrigger.addEventListener('click', function(e) {
        e.stopPropagation();
        isDropdownLayananOpen = !isDropdownLayananOpen;
        dropdownMenuLayanan.classList.toggle('show');
        var icon = this.querySelector('.fa-chevron-down');
        if (icon) {
            icon.style.transform = isDropdownLayananOpen ? 'rotate(180deg)' : 'rotate(0deg)';
        }
    });

    document.addEventListener('click', function(e) {
        if (!e.target.closest('#dropdown-layanan')) {
            dropdownMenuLayanan.classList.remove('show');
            isDropdownLayananOpen = false;
            var icon = layananTrigger.querySelector('.fa-chevron-down');
            if (icon) {
                icon.style.transform = 'rotate(0deg)';
            }
        }
    });

    var dropdownLayananContainer = document.getElementById('dropdown-layanan');
    if (dropdownLayananContainer) {
        dropdownLayananContainer.addEventListener('mouseenter', function() {
            if (window.innerWidth >= 1024) {
                isDropdownLayananOpen = true;
                dropdownMenuLayanan.classList.add('show');
                var icon = layananTrigger.querySelector('.fa-chevron-down');
                if (icon) {
                    icon.style.transform = 'rotate(180deg)';
                }
            }
        });

        dropdownLayananContainer.addEventListener('mouseleave', function() {
            if (window.innerWidth >= 1024) {
                isDropdownLayananOpen = false;
                dropdownMenuLayanan.classList.remove('show');
                var icon = layananTrigger.querySelector('.fa-chevron-down');
                if (icon) {
                    icon.style.transform = 'rotate(0deg)';
                }
            }
        });
    }
}

// ========================================
// MOBILE SUB MENU LAYANAN
// ========================================
var mobileLayananToggle = document.getElementById('mobile-layanan-toggle');
var mobileLayananSub = document.getElementById('mobile-layanan-sub');
var mobileLayananIcon = document.getElementById('mobile-layanan-icon');

if (mobileLayananToggle && mobileLayananSub) {
    mobileLayananToggle.addEventListener('click', function() {
        mobileLayananSub.classList.toggle('hidden');
        if (mobileLayananIcon) {
            mobileLayananIcon.classList.toggle('fa-chevron-down');
            mobileLayananIcon.classList.toggle('fa-chevron-up');
        }
    });
}

// ========================================
// TOGGLE MOBILE MENU
// ========================================
const menuToggle = document.getElementById('menu-toggle');
const mobileMenu = document.getElementById('mobile-menu');
let isMenuOpen = false;

if (menuToggle && mobileMenu) {
    menuToggle.addEventListener('click', function() {
        isMenuOpen = !isMenuOpen;
        mobileMenu.classList.toggle('open');
        const icon = this.querySelector('i');
        if (icon) {
            if (isMenuOpen) {
                icon.className = 'fas fa-times';
                this.style.transform = 'rotate(90deg)';
            } else {
                icon.className = 'fas fa-bars';
                this.style.transform = 'rotate(0deg)';
            }
        }
    });
}

// ========================================
// ACTIVE LINK ON SCROLL
// ========================================
const sections = document.querySelectorAll('section[id]');
const navLinks = document.querySelectorAll('.nav-link');

window.addEventListener('scroll', () => {
    let current = '';
    sections.forEach(section => {
        const sectionTop = section.offsetTop - 100;
        if (window.scrollY >= sectionTop) {
            current = section.getAttribute('id');
        }
    });
    navLinks.forEach(link => {
        link.classList.remove('active');
        if (link.getAttribute('href') === `#${current}`) {
            link.classList.add('active');
        }
    });
});

// ========================================
// FILTER GALERI (KATEGORI & JENIS)
// ========================================
document.addEventListener('DOMContentLoaded', function() {
    var filterKategori = document.querySelectorAll('.filter-kategori');
    var filterJenis = document.querySelectorAll('.filter-jenis');
    var galeriItems = document.querySelectorAll('.galeri-item');
    var emptyFilter = document.getElementById('emptyFilter');

    // Jika tidak ada filter, keluar
    if (filterKategori.length === 0 && filterJenis.length === 0) {
        return;
    }

    var activeKategori = 'all';
    var activeJenis = 'all';

    // FUNGSI APPLY FILTER
    function applyFilter() {
        var visibleCount = 0;

        galeriItems.forEach(function(item) {
            var kategori = item.getAttribute('data-kategori');
            var jenis = item.getAttribute('data-jenis');

            var matchKategori = (activeKategori === 'all' || kategori === activeKategori);
            var matchJenis = (activeJenis === 'all' || jenis === activeJenis);

            if (matchKategori && matchJenis) {
                item.style.display = 'block';
                item.style.animation = 'fadeIn 0.4s ease forwards';
                visibleCount++;
            } else {
                item.style.display = 'none';
            }
        });

        // Tampilkan pesan kosong jika tidak ada item
        if (emptyFilter) {
            if (visibleCount === 0) {
                emptyFilter.classList.remove('hidden');
            } else {
                emptyFilter.classList.add('hidden');
            }
        }
    }

    // FILTER KATEGORI
    filterKategori.forEach(function(btn) {
        btn.addEventListener('click', function() {
            activeKategori = this.getAttribute('data-filter');

            filterKategori.forEach(function(b) {
                b.classList.remove('active', 'bg-[#0a1638]', 'text-white', 'border-[#0a1638]');
                b.classList.add('bg-white', 'text-gray-600', 'border-gray-300');
            });
            this.classList.add('active', 'bg-[#0a1638]', 'text-white', 'border-[#0a1638]');
            this.classList.remove('bg-white', 'text-gray-600', 'border-gray-300');

            applyFilter();
        });
    });

    // FILTER JENIS
    filterJenis.forEach(function(btn) {
        btn.addEventListener('click', function() {
            activeJenis = this.getAttribute('data-filter');

            filterJenis.forEach(function(b) {
                b.classList.remove('active', 'bg-[#FFD700]', 'text-[#0a1638]', 'border-[#FFD700]');
                b.classList.add('bg-gray-50', 'text-gray-600', 'border-gray-200');
            });
            this.classList.add('active', 'bg-[#FFD700]', 'text-[#0a1638]', 'border-[#FFD700]');
            this.classList.remove('bg-gray-50', 'text-gray-600', 'border-gray-200');

            applyFilter();
        });
    });
});

// ========================================
// FADE-IN EFFECT ON SCROLL
// ========================================
document.addEventListener('DOMContentLoaded', function() {
    const elements = document.querySelectorAll('.fade-in');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    });
    elements.forEach(el => observer.observe(el));
});

// ========================================
// CLOSE MOBILE MENU ON LINK CLICK
// ========================================
document.querySelectorAll('#mobile-menu a').forEach(link => {
    link.addEventListener('click', function() {
        if (mobileMenu) {
            mobileMenu.classList.remove('open');
            isMenuOpen = false;
            const icon = menuToggle ? menuToggle.querySelector('i') : null;
            if (icon) {
                icon.className = 'fas fa-bars';
                if (menuToggle) {
                    menuToggle.style.transform = 'rotate(0deg)';
                }
            }
        }
    });
});
