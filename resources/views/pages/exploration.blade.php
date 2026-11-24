<!doctype html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Eksplorasi Virtual — Wetland Explorer</title>
  <link rel="stylesheet" href="{{ asset('vendor/fontawesome/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendor/fonts/fonts.css') }}">
  <style>
    :root {
      font-family: Inter, system-ui, sans-serif;
      color: #193d37;
      background: #f4f8f3;
    }

    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
    }

    a {
      color: #176b54;
      text-decoration: none;
    }

    /* NAVBAR - disamakan dengan halaman Misi */
    header.site-header {
      position: sticky;
      top: 0;
      z-index: 1000;
      padding: 0;
      background: #fff;
      border-bottom: 1px solid #dce5d8;
      box-shadow: 0 2px 12px rgba(29, 56, 45, .05);
    }

    .header-inner {
      position: relative;
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
      color: #1d382d;
      font-family: 'Manrope', Arial, sans-serif;
      font-size: 21px;
      font-weight: 700;
      letter-spacing: -.6px;
      text-decoration: none;
    }

    .brand:hover {
      color: #284b3b;
    }

    .brand-mark {
      display: grid;
      place-items: center;
      width: 36px;
      height: 36px;
      border-radius: 12px;
      background: #284b3b;
      color: #fff;
      font-size: 22px;
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
      font-family: 'Manrope', Arial, sans-serif;
      font-size: 13px;
      font-weight: 700;
      text-decoration: none;
      transition: .2s;
    }

    .main-navigation a:hover {
      background: #f1f5ed;
      color: #284b3b;
    }

    .main-navigation a.active {
      background: #e6eee2;
      color: #1d382d;
    }

    .profile-button {
      display: grid;
      place-items: center;
      width: 42px;
      height: 42px;
      flex-shrink: 0;
      border: 1px solid #dce5d8;
      border-radius: 50%;
      background: #f7f9f5;
      color: #284b3b;
      font-size: 18px;
      text-decoration: none;
      transition: .2s;
    }

    .profile-button:hover {
      background: #e6eee2;
      border-color: #b9cbb7;
    }



    .profile-area {
      position: relative;
      flex-shrink: 0;
    }

    .profile-dropdown {
      position: absolute;
      top: calc(100% + 12px);
      right: 0;
      width: 225px;
      padding: 9px;
      background: #fff;
      border: 1px solid #dce5d8;
      border-radius: 12px;
      box-shadow: 0 12px 35px rgba(29, 56, 45, .13);
      display: none;
      z-index: 1100;
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
      color: #1d382d;
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

    /* LOGOUT CONFIRMATION */
    .logout-modal {
      position: fixed;
      inset: 0;
      z-index: 2000;
      display: none;
      align-items: center;
      justify-content: center;
      padding: 18px;
      background: rgba(16, 43, 40, .45);
    }

    .logout-modal.show {
      display: flex;
    }

    .logout-modal-content {
      width: min(100%, 380px);
      padding: 26px;
      border-radius: 18px;
      background: #fff;
      box-shadow: 0 18px 50px rgba(16, 43, 40, .2);
      text-align: center;
    }

    .logout-modal-content h3 {
      margin: 0 0 10px;
      font-size: 19px;
    }

    .logout-modal-content p {
      margin: 0 0 22px;
      color: #65736a;
      font-size: 14px;
      line-height: 1.6;
    }

    .logout-modal-actions {
      display: flex;
      justify-content: center;
      gap: 10px;
    }

    .logout-modal-actions button {
      padding: 10px 18px;
      border: 0;
      border-radius: 9px;
      font-family: 'Manrope', Arial, sans-serif;
      font-size: 13px;
      font-weight: 700;
      cursor: pointer;
    }

    .cancel-logout {
      background: #e6eee2;
      color: #284b3b;
    }

    .confirm-logout {
      background: #c0392b;
      color: #fff;
    }


    .mobile-toggle {
      display: none;
      width: 39px;
      height: 39px;
      border: 1px solid #dce5d8;
      border-radius: 8px;
      background: #fff;
      color: #284b3b;
      font-size: 17px;
      cursor: pointer;
    }

    /* KONTEN ASLI - TIDAK DIUBAH */
    main {
      max-width: 1160px;
      padding: 32px 20px 56px;
      margin: auto;
    }

    .eyebrow {
      color: #61776c;
      font-size: .82rem;
      font-weight: 800;
      letter-spacing: .12em;
      text-transform: uppercase;
    }

    h1 {
      margin: 6px 0 10px;
      font-size: clamp(1.8rem, 4vw, 2.6rem);
      color: #193d37;
    }

    h2,
    h3 {
      color: #193d37;
    }

    .intro {
      max-width: 760px;
      color: #526d66;
      line-height: 1.65;
    }

    .banner {
      position: relative;
      min-height: 190px;
      margin: 22px 0 26px;
      overflow: hidden;
      border-radius: 20px;
      background: #dce9d5;
    }

    .banner img {
      position: absolute;
      inset: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .banner::after {
      position: absolute;
      inset: 0;
      content: "";
      background: linear-gradient(90deg, #102c20ce, #102c2050 68%, transparent);
    }

    .banner-copy {
      position: relative;
      z-index: 1;
      max-width: 620px;
      padding: 28px;
      color: #fff;
    }

    .banner-copy h2 {
      margin: 0 0 7px;
      color: #fff;
    }

    .banner-copy p {
      margin: 0;
      line-height: 1.6;
    }

    .overall-progress,
    .ecosystem-progress {
      padding: 14px 18px;
      background: #fff;
      border: 1px solid #dce9df;
      border-radius: 14px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 14px;
    }

    .progress-track {
      height: 9px;
      max-width: 280px;
      flex: 1;
      background: #e2eee6;
      border-radius: 9px;
      overflow: hidden;
    }

    .progress-fill {
      height: 100%;
      background: #27815f;
      transition: width .2s;
    }

    .ecosystem-grid {
      display: grid;
      grid-template-columns: repeat(2, minmax(0, 1fr));
      gap: 20px;
      margin-top: 22px;
    }

    .ecosystem-card {
      overflow: hidden;
      background: #fff;
      border: 1px solid #dce9df;
      border-radius: 18px;
      box-shadow: 0 10px 28px #174b3310;
    }

    .ecosystem-card>img {
      display: block;
      width: 100%;
      height: 220px;
      object-fit: cover;
    }

    .ecosystem-card-body {
      padding: 18px;
    }

    .ecosystem-card h2 {
      margin: 0 0 8px;
      font-size: 1.35rem;
    }

    .ecosystem-card p {
      color: #526d66;
      line-height: 1.55;
    }

    .card-progress {
      display: flex;
      align-items: center;
      gap: 12px;
      margin: 14px 0;
      color: #526d66;
      font-size: .9rem;
    }

    .card-progress .progress-track {
      max-width: none;
    }

    .button {
      display: inline-flex;
      justify-content: center;
      align-items: center;
      gap: 8px;
      padding: 11px 16px;
      border: 0;
      border-radius: 10px;
      background: #176b54;
      color: #fff;
      font-weight: 700;
      cursor: pointer;
    }

    .button:hover {
      background: #125540;
      color: #fff;
    }

    .button.secondary {
      background: #e6eee2;
      color: #1d382d;
    }

    .back-link {
      display: inline-block;
      margin: 0 0 18px;
      font-weight: 700;
    }

    .scene {
      position: relative;
      margin-top: 22px;
      border-radius: 18px;
      overflow: hidden;
      background: #d8e9d8;
      box-shadow: 0 14px 40px #174b3322;
    }

    .scene-image {
      display: block;
      width: 100%;
      height: auto;
    }

    .hotspot {
      position: absolute;
      left: var(--x);
      top: var(--y);
      transform: translate(-50%, -50%);
      width: 46px;
      height: 46px;
      border: 3px solid #fff;
      border-radius: 50%;
      background: #efac32;
      color: #193d37;
      font-weight: 800;
      font-size: 17px;
      cursor: pointer;
      box-shadow: 0 2px 12px #163b3b88;
      animation: pulse 2.2s infinite;
      transition: transform .16s, background .16s;
    }

    .hotspot:hover,
    .hotspot:focus-visible {
      outline: 3px solid #176b54;
      outline-offset: 3px;
      transform: translate(-50%, -50%) scale(1.12);
    }

    .hotspot.visited {
      background: #27815f;
      color: #fff;
      animation: none;
    }

    .eco-progress-wrap {
      margin-top: 16px;
    }

    .eco-progress-wrap .progress-track {
      max-width: none;
    }

    .eco-complete {
      margin-top: 12px;
      padding: 14px 18px;
      background: #e6f4e8;
      border: 1px solid #b9ddbf;
      border-radius: 14px;
      color: #176b54;
      font-weight: 700;
    }

    .extra-card {
      display: grid;
      grid-template-columns: minmax(200px, .8fr) 1.2fr;
      gap: 22px;
      align-items: center;
      margin-top: 28px;
      padding: 18px;
      background: #fff;
      border: 1px solid #dce9df;
      border-radius: 18px;
    }

    .extra-card img {
      display: block;
      width: 100%;
      max-height: 280px;
      object-fit: cover;
      border-radius: 12px;
    }

    .extra-card p {
      color: #526d66;
      line-height: 1.6;
    }

    .extra-card h3 {
      margin: 16px 0 4px;
      font-size: 1rem;
    }

    .image-source {
      margin: 8px 0 14px;
      font-size: .85rem;
      color: #61776c;
      line-height: 1.45;
    }

    .extra-card .image-source {
      margin-top: 12px;
    }

    .popup {
      position: fixed;
      inset: 0;
      background: #102b2877;
      display: grid;
      place-items: center;
      padding: 18px;
      z-index: 1100;
      opacity: 1;
      transition: opacity .18s;
    }

    .popup[hidden] {
      display: none;
    }

    .popup.closing {
      opacity: 0;
    }

    .panel {
      position: relative;
      width: min(100%, 600px);
      max-height: min(88vh, 780px);
      overflow: auto;
      background: #fff;
      border-radius: 20px;
      padding: 26px;
      box-shadow: 0 18px 60px #102b2855;
    }

    .panel h2 {
      margin: 0 48px 12px 0;
    }

    .panel h3 {
      margin: 18px 0 5px;
      font-size: 1rem;
    }

    .popup-image {
      display: block;
      width: 100%;
      height: auto;
      max-height: 330px;
      object-fit: contain;
      border-radius: 12px;
      margin: 12px 0;
    }

    .close {
      position: absolute;
      right: 18px;
      top: 18px;
      border: 0;
      background: #e9f2ec;
      border-radius: 50%;
      width: 38px;
      height: 38px;
      font-size: 23px;
      cursor: pointer;
      color: #193d37;
    }

    .panel p {
      line-height: 1.6;
    }

    .save-warning {
      min-height: 1.5em;
      color: #8c4b1f;
      font-size: .9rem;
    }

    @keyframes pulse {

      0%,
      100% {
        box-shadow: 0 2px 12px #163b3b88, 0 0 0 0 #efac3266;
      }

      50% {
        box-shadow: 0 2px 12px #163b3b88, 0 0 0 10px #efac3200;
      }
    }

    /* RESPONSIVE NAVBAR */
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
        border-bottom: 1px solid #dce5d8;
        box-shadow: 0 10px 18px rgba(29, 56, 45, .08);
      }

      .main-navigation.open {
        display: flex;
      }

      .main-navigation a {
        padding: 12px;
        font-size: 13px;
      }

      .profile-button {
        width: 39px;
        height: 39px;
      }
    }

    /* RESPONSIVE KONTEN ASLI - TIDAK DIUBAH */
    @media (max-width: 650px) {
      main {
        padding: 26px 14px 42px;
      }

      .ecosystem-grid {
        grid-template-columns: 1fr;
      }

      .ecosystem-card>img {
        height: 200px;
      }

      .banner {
        min-height: 210px;
      }

      .banner-copy {
        padding: 22px;
      }

      .overall-progress,
      .ecosystem-progress {
        flex-wrap: wrap;
      }

      .progress-track {
        max-width: none;
        flex-basis: 100%;
        order: 2;
      }

      .hotspot {
        width: 36px;
        height: 36px;
        font-size: 14px;
      }

      .extra-card {
        grid-template-columns: 1fr;
        gap: 12px;
        padding: 15px;
      }

      .extra-card img {
        max-height: 220px;
      }

      .panel {
        padding: 22px 18px;
      }
    }

    @media (prefers-reduced-motion: reduce) {

      *,
      *::before,
      *::after {
        animation-duration: .01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: .01ms !important;
        scroll-behavior: auto !important;
      }
    }
  </style>
</head>

<body>
  <header class="site-header">
    <div class="header-inner">

      <a class="brand" href="{{ url('/dashboard') }}">
        <span class="brand-mark" aria-hidden="true">♧</span>
        </span>
        <span>Wetland Explorer</span>
      </a>

      <button type="button" class="mobile-toggle" id="mobileNavToggle" aria-label="Buka navigasi" aria-expanded="false"
        aria-controls="mainNavigation">
        <i class="fa-solid fa-bars"></i>
      </button>

      <nav class="main-navigation" id="mainNavigation" aria-label="Navigasi utama">
        <a href="{{ url('/dashboard') }}">Dashboard</a>
        <a href="{{ url('/tutorial') }}">Materi</a>
        <a href="{{ url('/exploration') }}" class="active" aria-current="page">Eksplorasi</a>
        <a href="{{ url('/missions') }}">Misi</a>
        <a href="{{ url('/quiz') }}">Kuis</a>
      </nav>



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


  <div class="logout-modal" id="logoutModal">
    <div class="logout-modal-content">
      <h3>Konfirmasi Keluar</h3>
      <p>Apakah kamu yakin ingin keluar dari akun?</p>

      <div class="logout-modal-actions">
        <button type="button" class="cancel-logout" id="cancelLogout">
          Batal
        </button>

        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit" class="confirm-logout">
            Ya, Keluar
          </button>
        </form>
      </div>
    </div>
  </div>

  <main>
    <p class="eyebrow">Eksplorasi Virtual</p>
    @if ($selectedEcosystem)
      <a class="back-link" href="{{ route('exploration.index') }}"><i class="fa-solid fa-arrow-left"></i> Kembali ke semua
        ekosistem</a>
      <h1>{{ $selectedEcosystem['title'] }}</h1>
      <p class="intro">{{ $selectedEcosystem['introduction'] }}</p>
    @else
      <h1>Jelajahi Ekosistem Lahan Basah</h1>
      <p class="intro">Pilih ekosistem untuk melihat objek-objek di dalamnya. Buka penanda pada foto untuk menemukan
        informasi dan mengumpulkan progres.</p>
      <section class="banner" aria-label="Pemandangan lahan basah">
        <img src="{{ $bannerUrl }}" alt="Pemandangan udara lahan basah dan perairan" loading="eager">
        <div class="banner-copy">
          <h2>Empat ekosistem, banyak hal untuk ditemukan</h2>
          <p>Amati rawa, hutan mangrove, lahan gambut, serta danau dan kawasan sekitar sungai.</p>
        </div>
      </section>
    @endif

    <section class="overall-progress" aria-live="polite">
      <strong>Progres seluruh eksplorasi: <span id="overallCount">{{ $overallVisited }} dari {{ $overallTotal }}
          objek</span> · <span id="completedEcosystems"
          data-count="{{ $completeEcosystemCount }}">{{ $completeEcosystemCount }} dari {{ $ecosystemCount }}
          ekosistem</span></strong>
      <div class="progress-track" role="progressbar" aria-label="Progres keseluruhan eksplorasi" aria-valuemin="0"
        aria-valuemax="{{ $overallTotal }}" aria-valuenow="{{ $overallVisited }}">
        <div class="progress-fill" id="overallFill"
          style="width:{{ $overallTotal ? $overallVisited / $overallTotal * 100 : 0 }}%"></div>
      </div>
    </section>

    @if ($selectedEcosystem)
      <section class="scene" aria-label="Gambar {{ $selectedEcosystem['title'] }} dengan penanda interaktif">
        <img class="scene-image" src="{{ $selectedEcosystem['image_url'] }}" alt="{{ $selectedEcosystem['title'] }}"
          loading="eager">
        @foreach ($selectedEcosystem['hotspots'] as $hotspotKey => $hotspot)
          <button type="button" class="hotspot{{ $hotspot['visited'] ? ' visited' : '' }}"
            style="--x:{{ $hotspot['x'] }}%;--y:{{ $hotspot['y'] }}%" data-hotspot="{{ $hotspotKey }}"
            aria-label="{{ $hotspot['label'] }}{{ $hotspot['visited'] ? ', sudah dijelajahi' : '' }}"
            aria-pressed="{{ $hotspot['visited'] ? 'true' : 'false' }}">{{ $loop->iteration }}</button>
        @endforeach
      </section>
      @if ($selectedEcosystem['photo_credit'])
        <p class="image-source">Sumber foto utama: <a href="{{ $selectedEcosystem['photo_credit']['source'] }}"
            target="_blank" rel="noopener noreferrer">{{ $selectedEcosystem['photo_credit']['title'] }}</a> —
          {{ $selectedEcosystem['photo_credit']['photographer'] }}; {{ $selectedEcosystem['photo_credit']['license'] }}.
        </p>
      @endif
      <p class="hint">Klik penanda pada foto untuk menjelajahi tiap objek.</p>
      <div class="eco-progress-wrap">
        <div class="ecosystem-progress" aria-live="polite">
          <strong>Objek {{ $selectedEcosystem['title'] }}: <span
              id="ecosystemCount">{{ $selectedEcosystem['visited_count'] }} dari
              {{ $selectedEcosystem['hotspot_count'] }}</span></strong>
          <div class="progress-track" role="progressbar" aria-label="Progres {{ $selectedEcosystem['title'] }}"
            aria-valuemin="0" aria-valuemax="{{ $selectedEcosystem['hotspot_count'] }}"
            aria-valuenow="{{ $selectedEcosystem['visited_count'] }}">
            <div class="progress-fill" id="ecosystemFill"
              style="width:{{ $selectedEcosystem['visited_count'] / $selectedEcosystem['hotspot_count'] * 100 }}%"></div>
          </div>
        </div>
        <p class="eco-complete" id="ecosystemComplete" role="status" @if (!$selectedEcosystem['complete']) hidden @endif>
          Eksplorasi {{ $selectedEcosystem['title'] }} selesai! Semua objek sudah ditemukan.</p>
      </div>
      <p class="save-warning" id="saveWarning" role="status"></p>

      @if (isset($selectedEcosystem['extra']))
        <section class="extra-card" aria-label="{{ $selectedEcosystem['extra']['title'] }}">
          <div><img src="{{ $selectedEcosystem['extra']['image_url'] }}" alt="{{ $selectedEcosystem['extra']['title'] }}"
              loading="lazy">
            @if (!empty($selectedEcosystem['extra']['photo_credit']))
              <p class="image-source">Sumber foto: <a href="{{ $selectedEcosystem['extra']['photo_credit']['source'] }}"
                  target="_blank" rel="noopener noreferrer">{{ $selectedEcosystem['extra']['photo_credit']['title'] }}</a> —
                {{ $selectedEcosystem['extra']['photo_credit']['photographer'] }};
                {{ $selectedEcosystem['extra']['photo_credit']['license'] }}.
            </p>@endif
          </div>
          <div>
            <h2>{{ $selectedEcosystem['extra']['title'] }}</h2>
            <p>{{ $selectedEcosystem['extra']['description'] }}</p>
            @if (!empty($selectedEcosystem['extra']['traits']))
              <h3>Ciri-ciri</h3>
            <p>{{ $selectedEcosystem['extra']['traits'] }}</p>@endif
            @if (!empty($selectedEcosystem['extra']['role']))
              <h3>Peran dalam ekosistem</h3>
            <p>{{ $selectedEcosystem['extra']['role'] }}</p>@endif
          </div>
        </section>
      @endif
    @else
      <section class="ecosystem-grid" aria-label="Pilih ekosistem">
        @foreach ($ecosystems as $ecosystem)
          <article class="ecosystem-card">
            <img src="{{ $ecosystem['image_url'] }}" alt="{{ $ecosystem['title'] }}" loading="lazy">
            @if ($ecosystem['photo_credit'])
              <p class="image-source" style="padding:0 18px">Sumber foto: <a href="{{ $ecosystem['photo_credit']['source'] }}"
                  target="_blank" rel="noopener noreferrer">{{ $ecosystem['photo_credit']['title'] }}</a> —
                {{ $ecosystem['photo_credit']['photographer'] }}; {{ $ecosystem['photo_credit']['license'] }}.
            </p>@endif
            <div class="ecosystem-card-body">
              <h2>{{ $ecosystem['title'] }}</h2>
              <p>{{ $ecosystem['summary'] }}</p>
              <div class="card-progress"><span>{{ $ecosystem['visited_count'] }} dari {{ $ecosystem['hotspot_count'] }}
                  objek</span>
                <div class="progress-track">
                  <div class="progress-fill"
                    style="width:{{ $ecosystem['visited_count'] / $ecosystem['hotspot_count'] * 100 }}%"></div>
                </div>
              </div>
              <a class="button"
                href="{{ $ecosystem['url'] }}">{{ $ecosystem['complete'] ? 'Jelajahi kembali' : 'Mulai menjelajah' }} <i
                  class="fa-solid fa-arrow-right"></i></a>
            </div>
          </article>
        @endforeach
      </section>
    @endif
  </main>

  @if ($selectedEcosystem)
    <div class="popup" id="infoPopup" role="dialog" aria-modal="true" aria-labelledby="popupTitle" hidden>
      <article class="panel">
        <button class="close" id="closePopup" type="button" aria-label="Tutup informasi">&times;</button>
        <h2 id="popupTitle"></h2><img class="popup-image" id="popupImage" alt="" hidden>
        <p id="popupDescription"></p>
        <h3>Ciri-ciri</h3>
        <p id="popupTraits"></p>
        <h3>Peran dalam ekosistem</h3>
        <p id="popupRole"></p>
        <p class="image-source" id="popupImageSource" hidden></p>
      </article>
    </div>
    <script>
      window.WETLAND_EXPLORATION_DATA = {
        ecosystem: @json($selectedEcosystem['key']),
        hotspots: @json($selectedEcosystem['hotspots']),
        overallVisited: @json($overallVisited),
        overallTotal: @json($overallTotal),
        totalEcosystems: @json($ecosystemCount),
        saveUrl: @json(url('/learning-progress/exploration'))
      };


    </script>
  @endif
  <script>

    document.addEventListener('DOMContentLoaded', function () {
      const profileButton = document.getElementById('profileButton');
      const profileDropdown = document.getElementById('profileDropdown');
      const logoutButton = document.getElementById('logoutButton');
      const logoutModal = document.getElementById('logoutModal');
      const cancelLogout = document.getElementById('cancelLogout');

      profileButton?.addEventListener('click', function (event) {
        event.stopPropagation();

        profileDropdown.classList.toggle('show');

        const isOpen = profileDropdown.classList.contains('show');
        profileButton.classList.toggle('active', isOpen);
        profileButton.setAttribute('aria-expanded', isOpen);
      });

      document.addEventListener('click', function (event) {
        if (
          profileDropdown &&
          !profileDropdown.contains(event.target) &&
          !profileButton.contains(event.target)
        ) {
          profileDropdown.classList.remove('show');
          profileButton.classList.remove('active');
          profileButton.setAttribute('aria-expanded', 'false');
        }
      });

      logoutButton?.addEventListener('click', function () {
        profileDropdown.classList.remove('show');
        profileButton.classList.remove('active');
        profileButton.setAttribute('aria-expanded', 'false');
        logoutModal.classList.add('show');
      });

      cancelLogout?.addEventListener('click', function () {
        logoutModal.classList.remove('show');
      });

      logoutModal?.addEventListener('click', function (event) {
        if (event.target === logoutModal) {
          logoutModal.classList.remove('show');
        }
      });

      document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
          profileDropdown?.classList.remove('show');
          profileButton?.classList.remove('active');
          profileButton?.setAttribute('aria-expanded', 'false');
          logoutModal?.classList.remove('show');
        }
      });
    });

  </script>
  <script src="{{ asset('js/exploration.js') }}" defer></script>


</body>

</html>