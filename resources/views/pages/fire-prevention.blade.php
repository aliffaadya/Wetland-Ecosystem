<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Misi 1: Cegah Kebakaran Gambut — Wetland Explorer</title>

  <link rel="stylesheet" href="{{ asset('vendor/fontawesome/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendor/fonts/fonts.css') }}">
  <script src="https://cdn.tailwindcss.com"></script>
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

  <style>
    body {
      background: #F6F8F5;
      font-family: 'Manrope', Arial, sans-serif;
      color: #202b25;
      margin: 0;
    }

    /* NAVBAR: mengikuti desain halaman Tutorial */
    :root {
      --forest: #284b3b;
      --forest-dark: #1d382d;
      --sage: #e6eee2;
      --line: #dce5d8;
    }

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
      font-weight: 800;
      letter-spacing: -.6px;
      text-decoration: none;
    }

    .brand:hover { color: var(--forest); }

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

    .profile-area { position: relative; flex-shrink: 0; }

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
      text-decoration: none;
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

    .profile-dropdown.show { display: block; }

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
    .profile-dropdown a:hover { background: #f3f6f0; }
    .profile-dropdown .logout-button { color: #b44d46; }
    .profile-dropdown .logout-button:hover { background: #fff2ef; }

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

    .logout-modal.show { display: flex; }

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

    .logout-actions { display: flex; gap: 10px; }

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

    .cancel-logout { background: #edf2e9; color: var(--forest); }
    .confirm-logout { background: #b9534a; color: #fff; }

    @media (max-width: 950px) {
      .header-inner { gap: 12px; }
      .main-navigation { gap: 0; }
      .main-navigation a { padding: 9px 8px; font-size: 11px; }
    }

    @media (max-width: 720px) {
      .header-inner {
        position: relative;
        width: calc(100% - 28px);
        min-height: 68px;
      }

      .brand { font-size: 17px; gap: 9px; }
      .brand-mark { width: 34px; height: 34px; font-size: 22px; }

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

      .main-navigation.show { display: flex; }
      .main-navigation a { padding: 12px; font-size: 13px; }
      .profile-area { margin-left: 0; }
    }

    @media (max-width: 420px) {
      .profile-dropdown { right: 0; }
    }

    body, button, input, textarea, select {
      font-family: 'Manrope', Arial, sans-serif !important;
    }

    /* Penyesuaian konten Misi 1 agar nyaman dibaca seperti halaman Tutorial */
    .mission-question {
      margin: 0 0 1rem;
      color: #26332f;
      font-size: 1.125rem;
      font-weight: 700;
      line-height: 1.65;
      letter-spacing: 0;
    }

    .mission-option-text {
      color: #526158;
      font-size: 0.95rem;
      font-weight: 600;
      line-height: 1.65;
      overflow-wrap: anywhere;
    }

    .mission-hud {
      width: fit-content;
      max-width: 100%;
      flex-wrap: wrap;
    }

    @media (max-width: 640px) {
      .mission-question {
        font-size: 1rem;
        line-height: 1.6;
        margin-bottom: .9rem;
      }

      .mission-option-text {
        font-size: .875rem;
        line-height: 1.6;
      }

      .mission-hud {
        gap: .55rem;
        padding: .6rem .75rem;
      }
    }
  </style>
</head>

<body class="bg-[#F6F8F5] text-gray-800 antialiased flex flex-col min-h-screen">

  <!-- NAVBAR: SAMA DENGAN HALAMAN TUTORIAL -->
  <header class="site-header" id="siteHeader">
    <div class="header-inner">
      <a class="brand" href="{{ url('/') }}">
        <span class="brand-mark" aria-hidden="true">♧</span>
        <span>Wetland Explorer</span>
      </a>

      <button type="button" class="mobile-toggle" id="mobileNavToggle"
              aria-label="Buka navigasi" aria-expanded="false">
        <i class="fa-solid fa-bars"></i>
      </button>

      <nav class="main-navigation" id="mainNavigation">
        <a href="{{ url('/dashboard') }}">Dashboard</a>
        <a href="{{ url('/tutorial') }}">Materi</a>
        <a href="{{ url('/exploration') }}">Eksplorasi</a>
        <a href="{{ url('/missions') }}" class="active">Misi</a>
        <a href="{{ url('/quiz') }}">Kuis</a>
      </nav>

      @auth
      <div class="profile-area">
        <button type="button" class="profile-button" id="profileButton"
                aria-label="Menu profil" aria-expanded="false">
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

  <!-- KONTEN UTAMA MISI 1 INTERAKTIF (3 VARIASI TANTANGAN) -->
  <main class="flex-grow max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8 w-full"
        x-data="{
          step: 1,
          xp: 0,
          moisture: 25,

          // State Tahap 1 (Pilihan Ganda A-E)
          q1Selected: null,
          q1Done: false,
          q1Correct: false,
          q1Options: [
            { id: 'a', text: 'Membakar sisa jerami dan tumbuhan kering di atas permukaan gambut agar lahan cepat bersih untuk ditanami kembali.' },
            { id: 'b', text: 'Melakukan pembasahan kembali (rewetting) dengan membangun sekat kanal agar air tetap tertahan di dalam lapisan gambut.' },
            { id: 'c', text: 'Membiarkan saluran air terbuka lebar agar air cepat mengalir keluar dan tanah menjadi kering padat.' },
            { id: 'd', text: 'Menebang seluruh pohon peneduh di sekitar lahan agar sinar matahari langsung mengeringkan seluruh area gambut.' },
            { id: 'e', text: 'Menimbun kawasan gambut dengan pasir pantai tebal agar strukturnya berubah menjadi tanah mineral kering.' }
          ],
          answerQ1(id) {
            if (this.q1Done) return;
            this.q1Selected = id;
            this.q1Done = true;
            if (id === 'b') {
              this.q1Correct = true;
              this.xp += 50;
              this.moisture = 55;
            }
          },

          // State Tahap 2 (Benar atau Salah)
          q2Selected: null,
          q2Done: false,
          q2Correct: false,
          answerQ2(choice) {
            if (this.q2Done) return;
            this.q2Selected = choice;
            this.q2Done = true;
            if (choice === false) { // Pernyataan salah
              this.q2Correct = true;
              this.xp += 50;
              this.moisture = 80;
            }
          },

          // State Tahap 3 (Susun Urutan Langkah)
          availableSteps: [
            { id: 2, label: 'Membangun sekat kanal (canal blocking) dari kayu dan karung tanah' },
            { id: 3, label: 'Memantau tinggi muka air gambut dan menanam vegetasi asli rawa' },
            { id: 1, label: 'Mengidentifikasi saluran kanal yang mengalami kebocoran air' }
          ],
          orderedSteps: [],
          q3Done: false,
          q3Correct: false,
          pickStep(item) {
            if (this.q3Done) return;
            this.availableSteps = this.availableSteps.filter(s => s.id !== item.id);
            this.orderedSteps.push(item);
          },
          resetSteps() {
            this.orderedSteps = [];
            this.q3Done = false;
            this.q3Correct = false;
            this.availableSteps = [
              { id: 2, label: 'Membangun sekat kanal (canal blocking) dari kayu dan karung tanah' },
              { id: 3, label: 'Memantau tinggi muka air gambut dan menanam vegetasi asli rawa' },
              { id: 1, label: 'Mengidentifikasi saluran kanal yang mengalami kebocoran air' }
            ];
          },
          checkQ3() {
            if (this.orderedSteps.length < 3) return;
            this.q3Done = true;
            const isMatch = this.orderedSteps[0].id === 1 && this.orderedSteps[1].id === 2 && this.orderedSteps[2].id === 3;
            if (isMatch) {
              this.q3Correct = true;
              this.xp += 100;
              this.moisture = 100;
            }
          }
        }">

    <!-- Navigasi Atas & Indikator Status Ekosistem -->
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 sm:gap-4 mb-6">
      <a href="{{ url('/missions') }}" class="inline-flex self-start w-auto shrink-0 items-center px-4 py-2 rounded-lg bg-gray-200 text-sm font-bold text-gray-700 hover:bg-gray-300 hover:text-gray-900 transition">
        Kembali
      </a>

      <!-- HUD / Status Permainan Interaktif -->
      <div class="mission-hud flex items-center gap-3 bg-white px-4 py-2.5 rounded-2xl shadow-sm border border-green-100">
        <!-- Indikator Kelembapan Gambut -->
        <div class="flex items-center gap-2">
          <span class="text-xs font-bold text-gray-500">Kelembapan Gambut:</span>
          <div class="w-24 h-2.5 bg-gray-200 rounded-full overflow-hidden">
            <div class="h-full transition-all duration-500 rounded-full"
                 :class="moisture < 50 ? 'bg-orange-500' : (moisture < 85 ? 'bg-blue-500' : 'bg-[#2E7D32]')"
                 :style="'width: ' + moisture + '%'"></div>
          </div>
          <span class="text-xs font-extrabold"
                :class="moisture < 50 ? 'text-orange-600' : 'text-[#2E7D32]'"
                x-text="moisture + '%'"></span>
        </div>

        <span class="text-gray-300">|</span>

        <!-- Poin XP -->
        <div class="flex items-center gap-1 text-xs font-extrabold text-amber-600">
          <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
          </svg>
          <span x-text="xp + ' XP'"></span>
        </div>
      </div>
    </div>

    <!-- Header & Narasi Kasus -->
    <div class="bg-white rounded-2xl p-4 sm:p-6 md:p-7 shadow-sm border border-green-100 mb-6">
      <div class="flex items-center justify-between flex-wrap gap-3 mb-4">
        <div class="flex items-center gap-3.5">
          <div class="w-12 h-12 rounded-xl bg-orange-100 text-orange-600 flex items-center justify-center shadow-sm flex-shrink-0">
            <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24">
              <path d="M13.5.67s.74 2.65.74 4.8c0 2.06-1.35 3.73-3.41 3.73-2.07 0-3.63-1.67-3.63-3.73l.03-.36C5.21 7.51 4 10.62 4 14c0 4.42 3.58 8 8 8s8-3.58 8-8C20 8.61 17.41 3.8 13.5.67z"/>
            </svg>
          </div>
          <div>
            <span class="text-xs font-extrabold text-orange-600 uppercase tracking-wider">Misi 1 — Simulasi Penyelamatan</span>
            <h1 class="text-xl md:text-2xl font-extrabold text-[#1d382d]">Cegah Kebakaran Gambut</h1>
          </div>
        </div>

        <!-- Stepper Tahapan Misi -->
        <div class="flex items-center gap-2">
          <span class="px-3 py-1 rounded-full text-xs font-extrabold"
                :class="step === 1 ? 'bg-[#2E7D32] text-white' : 'bg-green-100 text-[#2E7D32]'">1. Pilihan Ganda</span>
          <span class="px-3 py-1 rounded-full text-xs font-extrabold"
                :class="step === 2 ? 'bg-[#2E7D32] text-white' : (step > 2 ? 'bg-green-100 text-[#2E7D32]' : 'bg-gray-100 text-gray-400')">2. Benar/Salah</span>
          <span class="px-3 py-1 rounded-full text-xs font-extrabold"
                :class="step === 3 ? 'bg-[#2E7D32] text-white' : (step > 3 ? 'bg-green-100 text-[#2E7D32]' : 'bg-gray-100 text-gray-400')">3. Urutkan Aksi</span>
        </div>
      </div>

      <div class="bg-[#edf3e9] border-l-4 border-[#388E3C] p-4 rounded-r-xl">
        <h2 class="text-sm font-extrabold text-[#284b3b] mb-1">
          Studi Kasus: Musim Kemarau Panjang di Lahan Gambut Liang Anggang
        </h2>
        <p class="text-gray-700 text-xs md:text-sm leading-relaxed m-0 font-medium">
          Saluran kanal buatan di sekitar lahan gambut Liang Anggang mengering saat kemarau panjang, menyebabkan muka air tanah turun drastis. Selesaikan <strong>3 tantangan berurutan</strong> di bawah ini untuk memulihkan kelembapan gambut hingga 100%!
        </p>
      </div>
    </div>

    <!-- ===================================================================== -->
    <!-- TAHAP 1: PILIHAN GANDA (OPSI A SAMPAI E)                              -->
    <!-- ===================================================================== -->
    <div x-show="step === 1" class="mission-card bg-white rounded-2xl p-4 sm:p-6 md:p-8 shadow-sm border border-green-100">
      <div class="inline-block bg-green-50 text-[#2E7D32] text-xs font-extrabold px-3 py-1 rounded-lg mb-3">
        Tantangan 1 dari 3 • Pilihan Ganda (A–E)
      </div>
      <h3 class="mission-question">
        Tindakan paling tepat apa yang harus segera dilakukan untuk mencegah kebakaran di lahan gambut yang mengering tersebut?
      </h3>

      <div class="space-y-3 mb-6">
        <template x-for="opt in q1Options" :key="opt.id">
          <button @click="answerQ1(opt.id)"
                  :class="{
                    'border-gray-200 bg-white hover:border-green-400 hover:bg-green-50/30': !q1Done,
                    'border-green-600 bg-green-50 text-green-900 font-bold': q1Done && opt.id === 'b',
                    'border-red-500 bg-red-50 text-red-900': q1Done && q1Selected === opt.id && opt.id !== 'b',
                    'border-gray-200 bg-white opacity-55': q1Done && q1Selected !== opt.id && opt.id !== 'b'
                  }"
                  class="w-full text-left p-3 sm:p-4 rounded-xl border-2 transition flex items-start gap-3">
            <span class="w-7 h-7 rounded-full font-extrabold text-xs flex items-center justify-center flex-shrink-0 uppercase"
                  :class="q1Done && opt.id === 'b' ? 'bg-green-600 text-white' : (q1Done && q1Selected === opt.id ? 'bg-red-500 text-white' : 'bg-gray-100 text-gray-700')"
                  x-text="opt.id"></span>
            <span class="mission-option-text" x-text="opt.text"></span>
          </button>
        </template>
      </div>

      <!-- Feedback Tahap 1 -->
      <template x-if="q1Done">
        <div class="p-5 rounded-xl border"
             :class="q1Correct ? 'bg-green-50 border-green-200 text-green-900' : 'bg-orange-50 border-orange-200 text-orange-900'">
          <h4 class="font-extrabold text-base mb-1" x-text="q1Correct ? 'Tepat Sekali! (+50 XP, Kelembapan Naik ke 55%)' : 'Kurang Tepat!'"></h4>
          <p class="text-sm leading-relaxed mb-4" x-text="q1Correct ? 'Pembasahan kembali (rewetting) menggunakan sekat kanal menahan air agar tidak keluar dari gambut, sehingga gambut tetap basah dan tahan api.' : 'Tindakan tersebut justru membuat gambut kehilangan cadangan air atau merusak ekosistem aslinya.'"></p>
          
          <template x-if="!q1Correct">
            <button @click="q1Done = false; q1Selected = null;" class="bg-orange-600 hover:bg-orange-700 text-white font-bold text-xs px-4 py-2.5 rounded-xl transition">
              Ulangi Tantangan 1
            </button>
          </template>
          <template x-if="q1Correct">
            <button @click="step = 2" class="bg-[#2E7D32] hover:bg-[#1B5E20] text-white font-bold text-sm px-5 py-2.5 rounded-xl shadow transition">
              Lanjut ke Tantangan 2 &rarr;
            </button>
          </template>
        </div>
      </template>
    </div>

    <!-- ===================================================================== -->
    <!-- TAHAP 2: BENAR ATAU SALAH (MITOS VS FAKTA GAMBUT)                     -->
    <!-- ===================================================================== -->
    <div x-show="step === 2" class="mission-card bg-white rounded-2xl p-4 sm:p-6 md:p-8 shadow-sm border border-green-100">
      <div class="inline-block bg-blue-50 text-blue-700 text-xs font-extrabold px-3 py-1 rounded-lg mb-3">
        Tantangan 2 dari 3 • Analisis Pernyataan (Benar / Salah)
      </div>
      <h3 class="mission-question">
        Perhatikan pernyataan ilmiah berikut tentang sifat lahan gambut:
      </h3>

      <div class="bg-gray-50 border border-gray-200 rounded-2xl p-4 sm:p-5 mb-6 text-center">
        <p class="text-sm sm:text-base font-semibold text-gray-700 italic leading-relaxed">
          "Kebakaran pada lahan gambut sangat mudah dipadamkan hanya dengan menyiram permukaan atasnya saja karena api hanya membakar rumput di permukaan."
        </p>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
        <button @click="answerQ2(true)"
                :class="q2Done && q2Selected === true ? 'border-red-500 bg-red-50 text-red-900' : 'border-gray-200 hover:border-green-400 bg-white'"
                class="p-5 rounded-2xl border-2 font-extrabold text-base flex items-center justify-center gap-2 transition">
          <span>BENAR</span>
        </button>

        <button @click="answerQ2(false)"
                :class="q2Done ? 'border-green-600 bg-green-50 text-green-900' : 'border-gray-200 hover:border-green-400 bg-white'"
                class="p-5 rounded-2xl border-2 font-extrabold text-base flex items-center justify-center gap-2 transition">
          <span>SALAH</span>
        </button>
      </div>

      <!-- Feedback Tahap 2 -->
      <template x-if="q2Done">
        <div class="p-5 rounded-xl border"
             :class="q2Correct ? 'bg-green-50 border-green-200 text-green-900' : 'bg-orange-50 border-orange-200 text-orange-900'">
          <h4 class="font-extrabold text-base mb-1" x-text="q2Correct ? 'Analisis Kamu Akurat! (+50 XP, Kelembapan Naik ke 80%)' : 'Hati-hati, Pernyataan Itu Salah!'"></h4>
          <p class="text-sm leading-relaxed mb-4">
            Gambut tersusun dari tumpukan sisa tumbuhan sedalam beberapa meter. Saat kering, api menjalar <strong>di bawah permukaan tanah</strong> (bara tersembunyi) sehingga sangat sulit dipadamkan hanya dari atas.
          </p>

          <template x-if="!q2Correct">
            <button @click="q2Done = false; q2Selected = null;" class="bg-orange-600 hover:bg-orange-700 text-white font-bold text-xs px-4 py-2.5 rounded-xl transition">
              Coba Lagi
            </button>
          </template>
          <template x-if="q2Correct">
            <button @click="step = 3" class="bg-[#2E7D32] hover:bg-[#1B5E20] text-white font-bold text-sm px-5 py-2.5 rounded-xl shadow transition">
              Lanjut ke Tantangan Terakhir &rarr;
            </button>
          </template>
        </div>
      </template>
    </div>

    <!-- ===================================================================== -->
    <!-- TAHAP 3: SUSUN URUTAN LANGKAH PENYELAMATAN                            -->
    <!-- ===================================================================== -->
    <div x-show="step === 3" class="mission-card bg-white rounded-2xl p-4 sm:p-6 md:p-8 shadow-sm border border-green-100">
      <div class="inline-block bg-amber-50 text-amber-700 text-xs font-extrabold px-3 py-1 rounded-lg mb-3">
        Tantangan 3 dari 3 • Susun Urutan Langkah Lapangan
      </div>
      <h3 class="mission-question">
        Klik kartu tindakan di bawah ini sesuai urutan langkah pemulihan lahan gambut yang paling logis (dari Langkah 1 ke Langkah 3):
      </h3>
      <p class="text-xs text-gray-500 mb-5">Klik kotak pilihan untuk memasukkannya ke slot urutan di bawah.</p>

      <!-- Pilihan Langkah Acak -->
      <div class="space-y-2.5 mb-6" x-show="availableSteps.length > 0">
        <template x-for="item in availableSteps" :key="item.id">
          <button @click="pickStep(item)"
                  class="w-full text-left p-4 rounded-xl border-2 border-dashed border-gray-300 hover:border-[#2E7D32] hover:bg-green-50/40 transition flex items-center justify-between group">
            <span class="text-sm font-bold text-gray-700" x-text="item.label"></span>
            <span class="text-xs font-extrabold text-[#2E7D32] opacity-75 group-hover:opacity-100">+ Pilih</span>
          </button>
        </template>
      </div>

      <!-- Area Slot Urutan Siswa -->
      <div class="bg-[#F6F8F5] p-5 rounded-2xl border border-gray-200 mb-6">
        <div class="flex items-center justify-between mb-3">
          <span class="text-xs font-extrabold text-gray-600 uppercase tracking-wider">Urutan Jawaban Kamu:</span>
          <button x-show="orderedSteps.length > 0 && !q3Correct" @click="resetSteps()" class="text-xs font-bold text-red-600 hover:underline">
            Reset Urutan
          </button>
        </div>

        <div class="space-y-2.5">
          <template x-for="(picked, index) in orderedSteps" :key="picked.id">
            <div class="bg-white p-3.5 rounded-xl border border-green-200 shadow-sm flex items-center gap-3">
              <span class="w-6 h-6 rounded-full bg-[#2E7D32] text-white font-extrabold text-xs flex items-center justify-center" x-text="index + 1"></span>
              <span class="text-sm font-bold text-gray-800" x-text="picked.label"></span>
            </div>
          </template>

          <div x-show="orderedSteps.length === 0" class="text-center py-6 text-xs text-gray-400 font-semibold">
            Belum ada langkah yang dipilih. Klik langkah pertama di atas!
          </div>
        </div>

        <div class="mt-4" x-show="orderedSteps.length === 3 && !q3Done">
          <button @click="checkQ3()" class="w-full bg-[#2E7D32] hover:bg-[#1B5E20] text-white font-extrabold text-sm py-3 rounded-xl shadow transition">
            Periksa Urutan Langkah
          </button>
        </div>
      </div>

      <!-- Feedback Akhir Tahap 3 -->
      <template x-if="q3Done">
        <div class="p-5 rounded-xl border"
             :class="q3Correct ? 'bg-green-50 border-green-300 text-green-900' : 'bg-orange-50 border-orange-200 text-orange-900'">
          <h4 class="font-extrabold text-base mb-1" x-text="q3Correct ? 'Luar Biasa! Misi 1 Selesai 100%! (+100 XP)' : 'Urutannya Belum Tepat!'"></h4>
          <p class="text-sm leading-relaxed mb-4" x-text="q3Correct ? 'Kamu telah memulihkan kelembapan lahan gambut Liang Anggang menjadi 100% dan menyelamatkannya dari ancaman kebakaran!' : 'Ingat alur kerja di lapangan: kita harus memeriksa lokasi kebocoran dulu, baru membangun sekat kanal, lalu memantau air dan menanam kembali vegetasi.'"></p>
          
          <template x-if="!q3Correct">
            <button @click="resetSteps()" class="bg-orange-600 hover:bg-orange-700 text-white font-bold text-xs px-4 py-2.5 rounded-xl transition">
              Susun Ulang Langkah
            </button>
          </template>
          <template x-if="q3Correct">
            <a href="{{ url('/missions') }}" 
   @click="localStorage.setItem('mission_1_completed', 'true')"
   class="inline-flex items-center gap-2 bg-[#2E7D32] hover:bg-[#1B5E20] text-white font-extrabold text-sm px-6 py-3 rounded-xl shadow transition">
  <span>Selesai & Kembali ke Peta Misi &rarr;</span>
</a>
          </template>
        </div>
      </template>
    </div>

  </main>

  <!-- FOOTER -->
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

  <!-- INTERAKSI NAVBAR, PROFIL, DAN MENU MOBILE -->
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
    });
  </script>

</body>

</html>