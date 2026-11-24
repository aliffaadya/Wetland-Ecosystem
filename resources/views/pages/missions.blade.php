<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Misi Pelestarian — Wetland Explorer</title>

  <link rel="stylesheet" href="{{ asset('vendor/fontawesome/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendor/fonts/fonts.css') }}">
  <script src="https://cdn.tailwindcss.com"></script>
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

  <style>
    :root {
      --forest: #284b3b;
      --forest-dark: #1d382d;
      --sage: #e6eee2;
      --line: #dce5d8;
    }

    body {
      background: #F6F8F5;
      font-family: 'Manrope', Arial, sans-serif;
      color: #202b25;
      margin: 0;
    }

    /* NAVBAR - disamakan dengan halaman Tutorial */
    .site-header {
      position: sticky;
      top: 0;
      z-index: 1000;
      background: #fff;
      border-bottom: 1px solid var(--line);
      box-shadow: 0 2px 12px rgba(29, 56, 45, .05);
    }

    .header-inner {
      width: min(1440px, calc(100% - 48px));
      min-height: 76px;
      margin: auto;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 25px;
    }

    .brand {
      display: inline-flex;
      align-items: center;
      gap: 12px;
      flex-shrink: 0;
      color: var(--forest-dark);
      font-family: 'Manrope', sans-serif;
      font-size: 21px;
      font-weight: 700;
      letter-spacing: -.6px;
      text-decoration: none;
    }

    .brand:hover {
      color: var(--forest);
    }

    .brand-mark {
      display: grid;
      place-items: center;
      width: 36px;
      height: 36px;
      border-radius: 12px;
      background: var(--forest);
      color: #fff;
      font-size: 25px;
    }

    .main-navigation {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 7px;
    }

    .main-navigation a {
      padding: 10px 13px;
      border-radius: 8px;
      color: #65736a;
      font-size: 13px;
      font-weight: 700;
      text-decoration: none;
      transition: .2s;
    }

    .main-navigation a:hover {
      background: #f1f5ed;
      color: var(--forest);
    }

    .main-navigation a.active {
      background: var(--sage);
      color: var(--forest-dark);
    }

    .profile-area {
      position: relative;
      flex-shrink: 0;
    }

    .profile-button {
      display: grid;
      place-items: center;
      width: 42px;
      height: 42px;
      border: 1px solid var(--line);
      border-radius: 50%;
      background: #f7f9f5;
      color: var(--forest);
      font-size: 18px;
      cursor: pointer;
      transition: .2s;
    }

    .profile-button:hover,
    .profile-button.active {
      background: var(--sage);
      border-color: #b9cbb7;
    }

    .profile-dropdown {
      position: absolute;
      top: calc(100% + 12px);
      right: 0;
      width: 225px;
      padding: 9px;
      background: #fff;
      border: 1px solid var(--line);
      border-radius: 12px;
      box-shadow: 0 12px 35px rgba(29, 56, 45, .13);
      display: none;
    }

    .profile-dropdown.show {
      display: block;
    }

    .profile-info {
      padding: 11px 12px;
      border-bottom: 1px solid #edf1eb;
      margin-bottom: 6px;
    }

    .profile-info strong {
      display: block;
      color: var(--forest-dark);
      font-size: 13px;
    }

    .profile-info span {
      display: block;
      color: #879187;
      font-size: 11px;
      margin-top: 3px;
    }

    .profile-dropdown button,
    .profile-dropdown a {
      display: flex;
      align-items: center;
      gap: 10px;
      width: 100%;
      padding: 11px 12px;
      border: 0;
      border-radius: 7px;
      background: transparent;
      color: #526158;
      font-family: inherit;
      font-size: 12px;
      text-align: left;
      text-decoration: none;
      cursor: pointer;
    }

    .profile-dropdown button:hover,
    .profile-dropdown a:hover {
      background: #f3f6f0;
    }

    .profile-dropdown .logout-button {
      color: #b44d46;
    }

    .profile-dropdown .logout-button:hover {
      background: #fff2ef;
    }

    .mobile-toggle {
      display: none;
      width: 39px;
      height: 39px;
      border: 1px solid var(--line);
      border-radius: 8px;
      background: #fff;
      color: var(--forest);
      font-size: 17px;
      cursor: pointer;
    }

    /* MODAL LOGOUT - mengikuti Tutorial */
    .logout-modal {
      position: fixed;
      inset: 0;
      z-index: 2000;
      display: none;
      align-items: center;
      justify-content: center;
      padding: 20px;
      background: rgba(19, 37, 28, .48);
    }

    .logout-modal.show {
      display: flex;
    }

    .logout-dialog {
      width: 100%;
      max-width: 390px;
      padding: 27px;
      border-radius: 15px;
      background: #fff;
      box-shadow: 0 20px 60px rgba(0, 0, 0, .17);
      text-align: center;
    }

    .logout-icon {
      display: grid;
      place-items: center;
      width: 55px;
      height: 55px;
      margin: 0 auto 15px;
      border-radius: 50%;
      background: #fff0ed;
      color: #bd5b50;
      font-size: 22px;
    }

    .logout-dialog h3 {
      margin: 0 0 8px;
      color: var(--forest-dark);
      font-size: 19px;
      font-weight: 800;
    }

    .logout-dialog p {
      margin: 0 0 22px;
      color: #77847a;
      font-size: 12px;
      line-height: 1.7;
    }

    .logout-actions {
      display: flex;
      gap: 10px;
    }

    .logout-actions button {
      flex: 1;
      padding: 11px;
      border: 0;
      border-radius: 8px;
      font-family: inherit;
      font-size: 12px;
      font-weight: 800;
      cursor: pointer;
    }

    .cancel-logout {
      background: #edf2e9;
      color: var(--forest);
    }

    .confirm-logout {
      background: #b9534a;
      color: #fff;
    }

    @media (max-width: 950px) {
      .header-inner {
        gap: 12px;
      }

      .main-navigation {
        gap: 0;
      }

      .main-navigation a {
        padding: 9px 8px;
        font-size: 11px;
      }
    }

    @media (max-width: 720px) {
      .header-inner {
        position: relative;
        width: calc(100% - 28px);
        min-height: 68px;
      }

      .brand {
        font-size: 17px;
        gap: 9px;
      }

      .brand-mark {
        width: 34px;
        height: 34px;
        font-size: 22px;
      }

      .mobile-toggle {
        display: grid;
        place-items: center;
        margin-left: auto;
      }

      .main-navigation {
        position: absolute;
        top: calc(100% + 1px);
        left: -14px;
        right: -14px;
        display: none;
        flex-direction: column;
        align-items: stretch;
        padding: 12px 16px;
        background: #fff;
        border-bottom: 1px solid var(--line);
        box-shadow: 0 10px 18px rgba(29, 56, 45, .08);
      }

      .main-navigation.show {
        display: flex;
      }

      .main-navigation a {
        padding: 12px;
        font-size: 13px;
      }

      .profile-area {
        margin-left: 0;
      }
    }

    @media (max-width: 420px) {
      .profile-dropdown {
        right: 0;
      }
    }

    body,
    button,
    input,
    textarea,
    select {
      font-family: 'Manrope', Arial, sans-serif !important;
    }

    
  </style>
</head>

<body class="bg-[#F6F8F5] text-gray-800 antialiased flex flex-col min-h-screen" x-data="{ 
        isMission1Done: localStorage.getItem('mission_1_completed') === 'true',
        isMission2Done: localStorage.getItem('mission_2_completed') === 'true',
        isMission3Done: localStorage.getItem('mission_3_completed') === 'true'
      }">

  <!-- NAVBAR: SAMA DENGAN HALAMAN TUTORIAL -->
  <header class="site-header" id="siteHeader">
    <div class="header-inner">
      <!-- BRAND -->
      <a class="brand" href="{{ url('/') }}">
        <span class="brand-mark" aria-hidden="true">♧</span>
        <span>Wetland Explorer</span>
      </a>

      <!-- MOBILE MENU -->
      <button type="button" class="mobile-toggle" id="mobileNavToggle" aria-label="Buka navigasi" aria-expanded="false">
        <i class="fa-solid fa-bars"></i>
      </button>

      <!-- NAVIGATION -->
      <nav class="main-navigation" id="mainNavigation">
        <a href="{{ url('/dashboard') }}">Dashboard</a>
        <a href="{{ url('/tutorial') }}">Materi</a>
        <a href="{{ url('/exploration') }}">Eksplorasi</a>
        <a href="{{ url('/missions') }}" class="active">Misi</a>
        <a href="{{ url('/quiz') }}">Kuis</a>
      </nav>

      <!-- PROFILE -->
      @auth
        <div class="profile-area">
          <button type="button" class="profile-button" id="profileButton" aria-label="Menu profil" aria-expanded="false">
            <i class="fa-solid fa-user"></i>
          </button>

          <div class="profile-dropdown" id="profileDropdown">
            <div class="profile-info">
              <strong>{{ Auth::user()->name }}</strong>
              <span>Siswa Wetland Explorer</span>
            </div>

            <a href="{{ url('/dashboard') }}">
              <i class="fa-solid fa-house"></i>
              Dashboard
            </a>

            <button type="button" class="logout-button" id="openLogoutModal">
              <i class="fa-solid fa-right-from-bracket"></i>
              Keluar
            </button>
          </div>
        </div>
      @else
        <a href="{{ route('login') }}" class="profile-button" aria-label="Masuk">
          <i class="fa-solid fa-user"></i>
        </a>
      @endauth
    </div>
  </header>

  <!-- KONTEN UTAMA HALAMAN MISI -->
  <main class="flex-grow max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8 w-full">

    <div class="flex items-center gap-3 mb-5">
      <div class="w-10 h-10 rounded-xl bg-green-100 text-[#2E7D32] flex items-center justify-center shadow-sm">
        <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24">
          <path
            d="M17 8C8 10 5.9 16.17 3.82 21.34l1.89.66.95-2.3c.48.17.98.3 1.34.3C19 20 22 3 22 3c-1 2-8 2.25-13 3.25S2 11.5 2 13.5s1.75 3.75 1.75 3.75C7 8 17 8 17 8Z" />
        </svg>
      </div>
      <h1 class="text-2xl md:text-3xl font-extrabold text-[#1d382d] tracking-tight">Misi Pelestarian</h1>
    </div>

    <!-- Container Banner -->
    <div class="rounded-3xl overflow-hidden shadow-xl border border-green-200 bg-cover bg-center relative p-6 md:p-8"
      style="background-image: linear-gradient(to bottom, rgba(232, 245, 233, 0.72) 0%, rgba(46, 125, 50, 0.35) 55%, rgba(27, 94, 32, 0.78) 100%), url('{{ asset('images/wetland-hero.svg') }}');">

      <div class="flex flex-col md:flex-row items-center justify-center gap-6 md:gap-10 mb-8 pt-2">

        <!-- Karakter Penjelajah SVG -->
        <div class="flex-shrink-0 drop-shadow-lg">
          <svg class="w-44 h-44 md:w-52 md:h-52" viewBox="0 0 240 240" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="120" cy="125" r="95" fill="#FFFFFF" fill-opacity="0.35" />
            <path d="M84 148L76 210H164L156 148H84Z" fill="#795548" />
            <path d="M72 215C72 178 90 158 120 158C150 158 168 178 168 215H72Z" fill="#A1887F" />
            <path d="M104 158L120 182L136 158H104Z" fill="#EFEBE9" />
            <rect x="88" y="182" width="20" height="22" rx="3" fill="#8D6E63" />
            <rect x="132" y="182" width="20" height="22" rx="3" fill="#8D6E63" />
            <path d="M98 156C106 168 134 168 142 156L136 174L120 166L104 174L98 156Z" fill="#2E7D32" />
            <rect x="110" y="136" width="20" height="24" rx="8" fill="#FFCCBC" />
            <circle cx="120" cy="108" r="36" fill="#FFCCBC" />
            <path d="M84 104C84 78 100 66 120 66C140 66 156 78 156 104C152 88 138 82 120 82C102 82 88 88 84 104Z"
              fill="#3E2723" />
            <ellipse cx="120" cy="76" rx="54" ry="12" fill="#6D4C41" />
            <path d="M90 76C90 54 104 44 120 44C136 44 150 54 150 76H90Z" fill="#8D6E63" />
            <rect x="90" y="68" width="60" height="6" fill="#2E7D32" />
            <circle cx="107" cy="108" r="4" fill="#212121" />
            <circle cx="133" cy="108" r="4" fill="#212121" />
            <circle cx="108" cy="107" r="1.5" fill="#FFFFFF" />
            <circle cx="134" cy="107" r="1.5" fill="#FFFFFF" />
            <path d="M111 122C115 127 125 127 129 122" stroke="#5D4037" stroke-width="3.5" stroke-linecap="round" />
            <circle cx="99" cy="116" r="4.5" fill="#FF8A65" fill-opacity="0.5" />
            <circle cx="141" cy="116" r="4.5" fill="#FF8A65" fill-opacity="0.5" />
            <circle cx="176" cy="164" r="12" fill="#FFCCBC" />
            <path d="M156 174L174 164" stroke="#A1887F" stroke-width="14" stroke-linecap="round" />
          </svg>
        </div>

        <!-- Balon Pesan -->
        <div
          class="relative bg-white/95 backdrop-blur-sm text-gray-800 p-6 rounded-2xl shadow-lg max-w-sm border border-green-100">
          <div
            class="hidden md:block absolute -left-3 top-1/2 -translate-y-1/2 w-0 h-0 border-t-[10px] border-t-transparent border-b-[10px] border-b-transparent border-r-[12px] border-r-white/95">
          </div>

          <h2 class="text-lg md:text-xl font-extrabold text-[#1B5E20] mb-1.5"
            x-text="isMission1Done ? 'Luar Biasa! Misi 1 Selesai!' : 'Ayo selesaikan misi!'"></h2>
          <p class="text-gray-700 text-sm md:text-base leading-relaxed font-medium"
            x-text="isMission1Done ? 'Misi 2 kini telah terbuka! Silakan lanjutkan petualangan.' : 'Bantu selamatkan lahan basah dari ancaman kerusakan.'">
          </p>
        </div>

      </div>

      <!-- 3 Kartu Misi -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-5 relative z-10">

        <!-- Misi 1: Selesai / Ulangi -->
        <a href="{{ url('/missions/fire-prevention') }}"
          class="bg-white/95 hover:bg-white rounded-2xl p-5 shadow-md hover:shadow-xl transform hover:-translate-y-1 transition flex flex-col items-center text-center relative border-2 border-[#388E3C] group">
          <div
            class="w-12 h-12 rounded-2xl bg-orange-100 text-orange-600 flex items-center justify-center mb-3 group-hover:scale-110 transition">
            <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24">
              <path
                d="M13.5.67s.74 2.65.74 4.8c0 2.06-1.35 3.73-3.41 3.73-2.07 0-3.63-1.67-3.63-3.73l.03-.36C5.21 7.51 4 10.62 4 14c0 4.42 3.58 8 8 8s8-3.58 8-8C20 8.61 17.41 3.8 13.5.67z" />
            </svg>
          </div>
          <span class="text-xs font-extrabold text-gray-500 uppercase tracking-wider">Misi 1</span>
          <h3 class="text-base font-extrabold text-gray-900 mt-0.5 mb-4">Cegah Kebakaran Gambut</h3>

          <div class="mt-auto w-full pt-3 border-t border-gray-100 flex justify-center">
            <span
              class="inline-flex items-center justify-center gap-2 bg-[#167447] hover:bg-[#123f32] text-white font-bold text-sm px-5 py-2.5 rounded-xl shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition duration-200">

              <!-- Ikon Play -->
              <svg class="w-4 h-4 fill-current shrink-0" viewBox="0 0 24 24">
                <path d="M8 5v14l11-7z" />
              </svg>

              <!-- Teks Tombol -->
              <span x-text="isMission1Done ? 'Ulangi Misi' : 'Mulai Misi'"></span>

            </span>
          </div>
        </a>

        <!-- Misi 2: Dinamis (Terkunci / Terbuka berdasarkan isMission1Done) -->
        <div class="rounded-2xl p-5 shadow-md flex flex-col items-center text-center relative transition"
          :class="isMission1Done ? 'bg-white/95 border-2 border-blue-500 hover:shadow-xl cursor-pointer group' : 'bg-white/90 border border-gray-200 opacity-90 cursor-not-allowed'">

          <div class="w-12 h-12 rounded-2xl bg-blue-100 text-blue-500 flex items-center justify-center mb-3"
            :class="isMission1Done ? 'group-hover:scale-110 transition' : ''">
            <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24">
              <path d="M12 2c-5.33 4.55-8 8.48-8 11.8 0 4.98 3.8 8.2 8 8.2s8-3.22 8-8.2c0-3.32-2.67-7.25-8-11.8z" />
            </svg>
          </div>
          <span class="text-xs font-extrabold uppercase tracking-wider"
            :class="isMission1Done ? 'text-blue-600' : 'text-gray-400'">Misi 2</span>
          <h3 class="text-base font-extrabold mt-0.5 mb-4" :class="isMission1Done ? 'text-gray-900' : 'text-gray-700'">
            Atasi Pencemaran Air</h3>

          <div class="mt-auto pt-2 w-full">
            <template x-if="isMission1Done">
              <a href="{{ url('/missions/water-pollution') }}"
                class="inline-flex items-center justify-center gap-2 bg-[#167447] hover:bg-[#123f32] text-white font-bold text-sm px-5 py-2.5 rounded-xl shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition duration-200">

                <svg class="w-4 h-4 fill-current shrink-0" viewBox="0 0 24 24">
                  <path d="M8 5v14l11-7z" />
                </svg>

                <span>Mulai Misi</span>
              </a>
            </template>
            <template x-if="!isMission1Done">
              <span
                class="w-7 h-7 rounded-full bg-gray-200 text-gray-600 inline-flex items-center justify-center text-xs">
                <i class="fa-solid fa-lock"></i>
              </span>
            </template>
          </div>
        </div>

        <!-- Misi 3: Terkunci -->
        <div class="rounded-2xl p-5 shadow-md flex flex-col items-center text-center relative transition"
          :class="isMission2Done ? 'bg-white/95 border-2 border-green-600 hover:shadow-xl cursor-pointer group' : 'bg-white/90 border border-gray-200 opacity-90 cursor-not-allowed'">

          <div class="w-12 h-12 rounded-2xl bg-green-100 text-green-600 flex items-center justify-center mb-3"
            :class="isMission2Done ? 'group-hover:scale-110 transition' : ''">
            <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24">
              <path
                d="M17 8C8 10 5.9 16.17 3.82 21.34l1.89.66.95-2.3c.48.17.98.3 1.34.3C19 20 22 3 22 3c-1 2-8 2.25-13 3.25S2 11.5 2 13.5s1.75 3.75 1.75 3.75C7 8 17 8 17 8Z" />
            </svg>
          </div>
          <span class="text-xs font-extrabold uppercase tracking-wider"
            :class="isMission2Done ? 'text-green-700' : 'text-gray-400'">Misi 3</span>
          <h3 class="text-base font-extrabold mt-0.5 mb-4" :class="isMission2Done ? 'text-gray-900' : 'text-gray-700'">
            Pulihkan Ekosistem</h3>

          <div class="mt-auto pt-2 w-full">
            <template x-if="isMission2Done">
              <a href="{{ url('/missions/ecosystem-restoration') }}"
                class="inline-flex items-center justify-center gap-2 bg-[#167447] hover:bg-[#123f32] text-white font-bold text-sm px-5 py-2.5 rounded-xl shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition duration-200">

                <svg class="w-4 h-4 fill-current shrink-0" viewBox="0 0 24 24">
                  <path d="M8 5v14l11-7z" />
                </svg>


                <span x-text="isMission3Done ? 'Ulangi Misi' : 'Mulai Misi'"></span>
              </a>
            </template>
            <template x-if="!isMission2Done">
              <span
                class="w-7 h-7 rounded-full bg-gray-200 text-gray-600 inline-flex items-center justify-center text-xs">
                <i class="fa-solid fa-lock"></i>
              </span>
            </template>
          </div>
        </div>
      </div>
    </div>

  </main>

  <footer class="bg-white border-t border-gray-200 py-5 text-center text-xs text-gray-500 mt-auto">
    <p>© {{ date('Y') }} <strong>Wetland Explorer</strong>. Media Pembelajaran Ekosistem Lahan Basah.</p>
  </footer>

  <!-- LOGOUT CONFIRMATION MODAL: SAMA DENGAN TUTORIAL -->
  @auth
    <div class="logout-modal" id="logoutModal">
      <div class="logout-dialog">
        <div class="logout-icon">
          <i class="fa-solid fa-right-from-bracket"></i>
        </div>

        <h3>Keluar dari akun?</h3>
        <p>Apakah kamu yakin ingin mengakhiri sesi pembelajaran dan keluar dari akun Wetland Explorer?</p>

        <div class="logout-actions">
          <button type="button" class="cancel-logout" id="cancelLogout">Batal</button>
          <form method="POST" action="{{ route('logout') }}" style="flex: 1;">
            @csrf
            <button type="submit" class="confirm-logout" style="width: 100%;">Ya, Keluar</button>
          </form>
        </div>
      </div>
    </div>
  @endauth

  <!-- INTERAKSI NAVBAR DAN PROFIL -->
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const profileButton = document.getElementById('profileButton');
      const profileDropdown = document.getElementById('profileDropdown');
      const logoutModal = document.getElementById('logoutModal');
      const openLogoutModal = document.getElementById('openLogoutModal');
      const cancelLogout = document.getElementById('cancelLogout');
      const mobileToggle = document.getElementById('mobileNavToggle');
      const mainNavigation = document.getElementById('mainNavigation');

      if (profileButton && profileDropdown) {
        profileButton.addEventListener('click', function (event) {
          event.stopPropagation();
          profileDropdown.classList.toggle('show');
          profileButton.classList.toggle('active');
          profileButton.setAttribute('aria-expanded', profileDropdown.classList.contains('show'));
        });

        document.addEventListener('click', function (event) {
          if (!profileButton.contains(event.target) && !profileDropdown.contains(event.target)) {
            profileDropdown.classList.remove('show');
            profileButton.classList.remove('active');
            profileButton.setAttribute('aria-expanded', 'false');
          }
        });
      }

      if (openLogoutModal && logoutModal) {
        openLogoutModal.addEventListener('click', function () {
          logoutModal.classList.add('show');
          profileDropdown?.classList.remove('show');
          profileButton?.classList.remove('active');
        });
      }

      if (cancelLogout && logoutModal) {
        cancelLogout.addEventListener('click', function () {
          logoutModal.classList.remove('show');
        });
      }

      if (logoutModal) {
        logoutModal.addEventListener('click', function (event) {
          if (event.target === logoutModal) logoutModal.classList.remove('show');
        });
      }

      if (mobileToggle && mainNavigation) {
        mobileToggle.addEventListener('click', function () {
          mainNavigation.classList.toggle('show');
          const isOpen = mainNavigation.classList.contains('show');
          mobileToggle.setAttribute('aria-expanded', isOpen);
          mobileToggle.innerHTML = isOpen
            ? '<i class="fa-solid fa-xmark"></i>'
            : '<i class="fa-solid fa-bars"></i>';
        });

        mainNavigation.querySelectorAll('a').forEach(function (link) {
          link.addEventListener('click', function () {
            mainNavigation.classList.remove('show');
            mobileToggle.setAttribute('aria-expanded', 'false');
            mobileToggle.innerHTML = '<i class="fa-solid fa-bars"></i>';
          });
        });
      }

      document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
          logoutModal?.classList.remove('show');
          profileDropdown?.classList.remove('show');
          mainNavigation?.classList.remove('show');
          profileButton?.classList.remove('active');
          profileButton?.setAttribute('aria-expanded', 'false');
          mobileToggle?.setAttribute('aria-expanded', 'false');
          if (mobileToggle) mobileToggle.innerHTML = '<i class="fa-solid fa-bars"></i>';
        }
      });
    });
  </script>

</body>

</html>