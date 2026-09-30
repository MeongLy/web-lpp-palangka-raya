<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="{{ asset('favicon/favicon.ico') }}">
  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon/favicon.ico') }}">
  <title>Admin Panel - @yield('title')</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <style>
    * {
      font-family: 'Inter', sans-serif;
    }

    .sidebar {
      background: #0a1638;
      min-height: 100vh;
      width: 260px;
      position: fixed;
      top: 0;
      left: 0;
      z-index: 50;
      transition: all 0.3s ease;
      overflow-y: auto;
    }

    .sidebar::-webkit-scrollbar {
      width: 4px;
    }

    .sidebar::-webkit-scrollbar-track {
      background: transparent;
    }

    .sidebar::-webkit-scrollbar-thumb {
      background: #FFD700;
      border-radius: 2px;
    }

    .main-content {
      margin-left: 260px;
      min-height: 100vh;
      background: #f8f9fa;
    }

    .sidebar-link {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 12px;
      padding: 0.75rem 1.5rem;
      color: rgba(255, 255, 255, 0.7);
      text-decoration: none;
      transition: all 0.3s ease;
      border-left: 3px solid transparent;
      cursor: pointer;
      width: 100%;
      background: none;
      border-top: none;
      border-right: none;
      border-bottom: none;
      text-align: left;
      font-size: 0.95rem;
    }

    .sidebar-link:hover {
      background: rgba(255, 215, 0, 0.05);
      color: #FFD700;
    }

    .sidebar-link.active {
      background: rgba(255, 215, 0, 0.1);
      color: #FFD700;
      border-left-color: #FFD700;
    }

    .sidebar-link i.link-icon {
      width: 20px;
      text-align: center;
    }

    .sidebar-link .link-content {
      display: flex;
      align-items: center;
      gap: 12px;
      flex: 1;
    }

    /* Submenu */
    .sidebar-submenu {
      max-height: 0;
      overflow: hidden;
      transition: max-height 0.3s ease;
      background: rgba(0, 0, 0, 0.2);
    }

    .sidebar-submenu.open {
      max-height: 300px;
    }

    .sidebar-submenu-link {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 0.6rem 1.5rem 0.6rem 3.5rem;
      color: rgba(255, 255, 255, 0.6);
      text-decoration: none;
      transition: all 0.3s ease;
      font-size: 0.85rem;
      border-left: 3px solid transparent;
    }

    .sidebar-submenu-link:hover {
      background: rgba(255, 215, 0, 0.05);
      color: #FFD700;
    }

    .sidebar-submenu-link.active {
      color: #FFD700;
      border-left-color: #FFD700;
    }

    .sidebar-submenu-link i {
      width: 16px;
      font-size: 0.75rem;
    }

    .dropdown-arrow {
      transition: transform 0.3s ease;
      font-size: 0.75rem;
      color: #FFD700;
    }

    .dropdown-arrow.open {
      transform: rotate(90deg);
    }

    .topbar {
      background: white;
      border-bottom: 1px solid #e5e7eb;
      padding: 0.75rem 1.5rem;
      position: sticky;
      top: 0;
      z-index: 40;
    }

    @media (max-width: 768px) {
      .sidebar {
        transform: translateX(-100%);
        width: 280px;
      }

      .sidebar.open {
        transform: translateX(0);
      }

      .main-content {
        margin-left: 0;
      }

      .sidebar-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.5);
        z-index: 45;
      }

      .sidebar-overlay.show {
        display: block;
      }
    }

    /* Custom Scroll */
    .custom-scroll::-webkit-scrollbar {
      width: 4px;
    }

    .custom-scroll::-webkit-scrollbar-track {
      background: #f1f1f1;
      border-radius: 10px;
    }

    .custom-scroll::-webkit-scrollbar-thumb {
      background: #FFD700;
      border-radius: 10px;
    }

    .custom-scroll::-webkit-scrollbar-thumb:hover {
      background: #e6c200;
    }

    /* Modal Animation */
    @keyframes modalPulse {

      0%,
      100% {
        transform: scale(1);
      }

      50% {
        transform: scale(1.05);
      }
    }

    .modal-icon-pulse {
      animation: modalPulse 2s ease-in-out infinite;
    }
  </style>
</head>

<body>
  <!-- ===== SIDEBAR OVERLAY (MOBILE) ===== -->
  <div class="sidebar-overlay" id="sidebarOverlay"></div>

  <!-- ===== SIDEBAR ===== -->
  <aside class="sidebar" id="sidebar">
    <div class="p-4 border-b border-white/10">
      <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
        <div class="w-10 h-10 bg-[#FFD700] rounded-lg flex items-center justify-center">
          <i class="fas fa-building text-[#0a1638]"></i>
        </div>
        <div>
          <h1 class="text-white font-bold text-lg leading-tight">Admin Panel</h1>
          <p class="text-[#FFD700] text-xs">Lapas Perempuan</p>
        </div>
      </a>
    </div>

    <nav class="py-4">
      <div class="px-4 text-xs text-white/40 uppercase tracking-wider font-semibold mb-2">Menu Utama</div>

      <!-- Dashboard -->
      <a href="{{ route('admin.dashboard') }}"
        class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <span class="link-content">
          <i class="fas fa-chart-pie link-icon"></i> Dashboard
        </span>
      </a>

      <!-- Profil (Dropdown) -->
      <button type="button" class="sidebar-link" onclick="toggleSubmenu('submenu-profil', 'arrow-profil')">
        <span class="link-content">
          <i class="fas fa-building link-icon"></i> Profil
        </span>
        <i class="fas fa-chevron-right dropdown-arrow" id="arrow-profil"></i>
      </button>
      <div class="sidebar-submenu" id="submenu-profil">
        <a href="{{ route('admin.profil.index') }}"
          class="sidebar-submenu-link {{ request()->routeIs('admin.profil.*') ? 'active' : '' }}">
          <i class="fas fa-circle"></i> Profil Lapas
        </a>
        <a href="{{ route('admin.pejabat.index') }}"
          class="sidebar-submenu-link {{ request()->routeIs('admin.pejabat.*') ? 'active' : '' }}">
          <i class="fas fa-circle"></i> Pejabat
        </a>
        <a href="{{ route('admin.struktur.index') }}"
          class="sidebar-submenu-link {{ request()->routeIs('admin.struktur.*') ? 'active' : '' }}">
          <i class="fas fa-circle"></i> Struktur Organisasi
        </a>
      </div>

      <!-- Berita -->
      <a href="{{ route('admin.berita.index') }}"
        class="sidebar-link {{ request()->routeIs('admin.berita.*') ? 'active' : '' }}">
        <span class="link-content">
          <i class="fas fa-newspaper link-icon"></i> Berita
        </span>
      </a>

      <!-- Galeri -->
      <a href="{{ route('admin.galeri.index') }}"
        class="sidebar-link {{ request()->routeIs('admin.galeri.*') ? 'active' : '' }}">
        <span class="link-content">
          <i class="fas fa-images link-icon"></i> Galeri
        </span>
      </a>

      <!-- Layanan (Dropdown) -->
      <button type="button" class="sidebar-link" onclick="toggleSubmenu('submenu-layanan', 'arrow-layanan')">
        <span class="link-content">
          <i class="fas fa-hand-holding-heart link-icon"></i> Layanan
        </span>
        <i class="fas fa-chevron-right dropdown-arrow" id="arrow-layanan"></i>
      </button>
      <div class="sidebar-submenu" id="submenu-layanan">
        <a href="{{ route('admin.layanan.index') }}"
          class="sidebar-submenu-link {{ request()->routeIs('admin.layanan.*') ? 'active' : '' }}">
          <i class="fas fa-circle"></i> Daftar Layanan
        </a>
        <a href="{{ route('admin.sitalawang.index') }}"
          class="sidebar-submenu-link {{ request()->routeIs('admin.sitalawang.*') ? 'active' : '' }}">
          <i class="fas fa-circle"></i> SI-Talawang
        </a>
        <a href="{{ route('admin.survei.index') }}"
          class="sidebar-submenu-link {{ request()->routeIs('admin.survei.*') ? 'active' : '' }}">
          <i class="fas fa-circle"></i> Hasil Survei
        </a>
      </div>

      <div class="px-4 text-xs text-white/40 uppercase tracking-wider font-semibold mt-6 mb-2">Pengaturan</div>

      <!-- Pengaturan -->
      <a href="{{ route('admin.pengaturan.index') }}"
        class="sidebar-link {{ request()->routeIs('admin.pengaturan.*') ? 'active' : '' }}">
        <span class="link-content">
          <i class="fas fa-cog link-icon"></i> Pengaturan
        </span>
      </a>

      <!-- Logout -->
      <form action="{{ route('logout') }}" method="POST" class="mt-4">
        @csrf
        <button type="submit" class="sidebar-link w-full text-left">
          <span class="link-content">
            <i class="fas fa-sign-out-alt link-icon"></i> Logout
          </span>
        </button>
      </form>
    </nav>
  </aside>

  <!-- ===== MAIN CONTENT ===== -->
  <main class="main-content">
    <!-- Topbar -->
    <header class="topbar">
      <div class="flex items-center justify-between">
        <div class="flex items-center gap-3">
          <button id="menuToggle" class="lg:hidden text-gray-600 hover:text-[#0a1638] text-xl">
            <i class="fas fa-bars"></i>
          </button>
          <h2 class="text-lg font-semibold text-[#0a1638]">@yield('title')</h2>
        </div>
        <div class="flex items-center gap-4">
          <span class="text-sm text-gray-600 hidden sm:block">{{ Auth::user()->name ?? 'Admin' }}</span>
          <div class="w-8 h-8 bg-[#0a1638] rounded-full flex items-center justify-center">
            <i class="fas fa-user text-[#FFD700] text-sm"></i>
          </div>
        </div>
      </div>
    </header>

    <!-- Content -->
    <div class="p-6">
      @if(session('success'))
      <div
        class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-4 text-sm flex items-center gap-2 animate-pulse">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
      </div>
      @endif

      @if(session('error'))
      <div
        class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-4 text-sm flex items-center gap-2">
        <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
      </div>
      @endif

      @yield('content')
    </div>
  </main>

  <!-- ===== MODAL KONFIRMASI HAPUS ===== -->
  <div id="deleteModal" class="fixed inset-0 z-[9999] hidden items-center justify-center p-4"
    style="background: rgba(0, 0, 0, 0.7); backdrop-filter: blur(4px);">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full overflow-hidden transform transition-all duration-300"
      id="deleteModalContent" style="transform: scale(0.9); opacity: 0;">

      <div class="p-6 text-center">
        <!-- Icon Warning -->
        <div class="w-20 h-20 bg-red-50 rounded-full flex items-center justify-center mx-auto mb-4 modal-icon-pulse">
          <i class="fas fa-exclamation-triangle text-red-500 text-4xl"></i>
        </div>

        <!-- Title -->
        <h3 class="text-xl font-bold text-[#0a1638] mb-2">Konfirmasi Hapus</h3>

        <!-- Message -->
        <p class="text-sm text-gray-600 mb-2">
          Apakah Anda yakin ingin menghapus data ini?
        </p>
        <p class="text-xs text-gray-400 mb-6">
          Data yang dihapus <strong class="text-red-500">tidak dapat dikembalikan</strong>.
        </p>

        <!-- Info Item -->
        <div id="deleteItemInfo" class="hidden bg-gray-50 rounded-xl p-3 mb-6 text-left border border-gray-100">
          <p class="text-xs text-gray-400 uppercase tracking-wider font-semibold mb-1">Data yang akan dihapus:</p>
          <p id="deleteItemName" class="text-sm font-semibold text-[#0a1638] truncate"></p>
        </div>

        <!-- Buttons -->
        <div class="flex gap-3">
          <button type="button" onclick="closeDeleteModal()"
            class="flex-1 px-4 py-3 bg-gray-100 text-gray-700 rounded-xl font-semibold text-sm hover:bg-gray-200 transition">
            <i class="fas fa-times mr-1"></i> Batal
          </button>
          <button type="button" onclick="confirmDelete()"
            class="flex-1 px-4 py-3 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-xl font-semibold text-sm hover:from-red-600 hover:to-red-700 transition shadow-lg">
            <i class="fas fa-trash mr-1"></i> Hapus
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- ===== SCRIPTS ===== -->
  <script>
    // ========================================
    // TOGGLE SIDEBAR MOBILE
    // ========================================
    const menuToggle = document.getElementById('menuToggle');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');

    if (menuToggle) {
      menuToggle.addEventListener('click', function () {
        sidebar.classList.toggle('open');
        overlay.classList.toggle('show');
      });
    }

    if (overlay) {
      overlay.addEventListener('click', function () {
        sidebar.classList.remove('open');
        overlay.classList.remove('show');
      });
    }

    // Auto close sidebar on link click (mobile)
    document.querySelectorAll('.sidebar-link, .sidebar-submenu-link').forEach(link => {
      link.addEventListener('click', function () {
        if (window.innerWidth < 768) {
          sidebar.classList.remove('open');
          overlay.classList.remove('show');
        }
      });
    });

    // ========================================
    // TOGGLE SUBMENU
    // ========================================
    function toggleSubmenu(submenuId, arrowId) {
      var submenu = document.getElementById(submenuId);
      var arrow = document.getElementById(arrowId);

      if (submenu) {
        submenu.classList.toggle('open');
      }
      if (arrow) {
        arrow.classList.toggle('open');
      }
    }

    // Auto open submenu jika halaman aktif
    document.addEventListener('DOMContentLoaded', function () {
      var currentPath = window.location.pathname;

      // Submenu Profil
      if (currentPath.includes('/admin/profil') ||
        currentPath.includes('/admin/pejabat') ||
        currentPath.includes('/admin/struktur')) {
        var submenuProfil = document.getElementById('submenu-profil');
        var arrowProfil = document.getElementById('arrow-profil');
        if (submenuProfil) submenuProfil.classList.add('open');
        if (arrowProfil) arrowProfil.classList.add('open');
      }

      // Submenu Layanan
      if (currentPath.includes('/admin/layanan') ||
        currentPath.includes('/admin/sitalawang') ||
        currentPath.includes('/admin/survei')) {
        var submenuLayanan = document.getElementById('submenu-layanan');
        var arrowLayanan = document.getElementById('arrow-layanan');
        if (submenuLayanan) submenuLayanan.classList.add('open');
        if (arrowLayanan) arrowLayanan.classList.add('open');
      }
    });

    // ========================================
    // MODAL KONFIRMASI HAPUS
    // ========================================
    let deleteForm = null;

    function showDeleteModal(form, itemName = null) {
      deleteForm = form;

      const modal = document.getElementById('deleteModal');
      const modalContent = document.getElementById('deleteModalContent');
      const itemInfo = document.getElementById('deleteItemInfo');
      const itemNameEl = document.getElementById('deleteItemName');

      // Tampilkan info item jika ada
      if (itemName && itemNameEl && itemInfo) {
        itemNameEl.textContent = itemName;
        itemInfo.classList.remove('hidden');
      } else if (itemInfo) {
        itemInfo.classList.add('hidden');
      }

      // Tampilkan modal
      modal.classList.remove('hidden');
      modal.classList.add('flex');

      setTimeout(() => {
        modalContent.style.transform = 'scale(1)';
        modalContent.style.opacity = '1';
      }, 50);
    }

    function closeDeleteModal() {
      const modal = document.getElementById('deleteModal');
      const modalContent = document.getElementById('deleteModalContent');

      if (modalContent) {
        modalContent.style.transform = 'scale(0.9)';
        modalContent.style.opacity = '0';
      }

      setTimeout(() => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        deleteForm = null;
      }, 300);
    }

    function confirmDelete() {
      if (deleteForm) {
        deleteForm.submit();
      }
    }

    // Close modal dengan ESC
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape') {
        const modal = document.getElementById('deleteModal');
        if (modal && !modal.classList.contains('hidden')) {
          closeDeleteModal();
        }
      }
    });

    // Close modal dengan klik luar
    document.addEventListener('click', function (e) {
      const modal = document.getElementById('deleteModal');
      if (modal && e.target === modal) {
        closeDeleteModal();
      }
    });

    // ========================================
    // REALTIME CLOCK
    // ========================================
    function updateRealtimeClock() {
      const now = new Date();

      const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
      const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

      const dayName = days[now.getDay()];
      const day = now.getDate();
      const monthName = months[now.getMonth()];
      const year = now.getFullYear();

      const dateString = `${dayName}, ${day} ${monthName} ${year}`;

      const hours = String(now.getHours()).padStart(2, '0');
      const minutes = String(now.getMinutes()).padStart(2, '0');
      const seconds = String(now.getSeconds()).padStart(2, '0');
      const timeString = `${hours}:${minutes}:${seconds}`;

      const dateElement = document.getElementById('realtime-date');
      const clockElement = document.getElementById('realtime-clock');

      if (dateElement) dateElement.textContent = dateString;
      if (clockElement) clockElement.textContent = timeString;
    }

    // Jalankan saat halaman load
    document.addEventListener('DOMContentLoaded', function () {
      updateRealtimeClock();
      setInterval(updateRealtimeClock, 1000);
    });
  </script>

  <!-- ===== STACK SCRIPTS ===== -->
  @stack('scripts')

</body>

</html>
