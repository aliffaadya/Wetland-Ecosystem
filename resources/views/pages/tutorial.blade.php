<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Materi Pembelajaran — Wetland Explorer</title>

  <!-- Bootstrap -->
  <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('vendor/fontawesome/css/all.min.css') }}">

  <!-- Fonts -->
  <link rel="stylesheet" href="{{ asset('vendor/fonts/fonts.css') }}">

  <!-- Original Learning Portal CSS -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">

  <link rel="stylesheet" href="{{ asset('css/tutorial.css') }}">

  <!-- Wetland Explorer -->
  <link rel="stylesheet" href="{{ asset('css/wetland-landing.css') }}">

  <style>
    :root {
      --forest: #284b3b;
      --forest-dark: #1d382d;
      --leaf: #6f966d;
      --sage: #e6eee2;
      --cream: #f5f7ef;
      --ink: #202b25;
      --muted: #647269;
      --line: #dce5d8;
      --white: #ffffff;
    }

    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      background: #f7f9f5;
      color: var(--ink);
      font-family: 'Manrope', Arial, sans-serif;
    }

    a {
      text-decoration: none;
    }

    /* =====================================
           NAVBAR
        ===================================== */

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
      color: white;
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

    /* =====================================
           PROFILE DROPDOWN
        ===================================== */

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

    /* =====================================
           MOBILE NAVIGATION
        ===================================== */

    .mobile-toggle {
      display: none;

      width: 39px;
      height: 39px;

      border: 1px solid var(--line);
      border-radius: 8px;

      background: white;
      color: var(--forest);

      font-size: 17px;
      cursor: pointer;
    }

    /* =====================================
           MAIN LEARNING LAYOUT
        ===================================== */

    .tut-layout {
      display: grid;
      grid-template-columns: 265px minmax(0, 1fr);
      gap: 27px;

      width: min(1440px, calc(100% - 48px));
      margin: 30px auto 65px;

      align-items: start;
    }

    /* =====================================
           SIDEBAR
        ===================================== */

    .tut-sidebar {
      position: sticky;
      top: 102px;

      padding: 20px 15px;

      background: #fff;
      border: 1px solid var(--line);
      border-radius: 12px;

      box-shadow: 0 4px 15px rgba(29, 56, 45, .035);
    }

    .sidebar-heading {
      padding: 0 8px 15px;
      border-bottom: 1px solid #edf1eb;
      margin-bottom: 13px;
    }

    .sidebar-heading h2 {
      margin: 0 0 5px;

      color: var(--forest-dark);
      font-size: 16px;
      font-weight: 800;
    }

    .sidebar-heading p {
      margin: 0;
      color: #839087;
      font-size: 11px;
      line-height: 1.6;
    }

    .tut-unit-divider {
      padding: 13px 9px 8px;

      color: #91a091;
      font-size: 10px;
      font-weight: 800;
      letter-spacing: 1px;
    }

    .tut-topic-btn {
      display: flex;
      align-items: center;
      gap: 10px;

      width: 100%;
      padding: 11px 10px;
      margin-bottom: 5px;

      border: 1px solid transparent;
      border-radius: 8px;

      background: transparent;
      color: #65736a;

      font-family: inherit;
      font-size: 12px;
      font-weight: 600;
      line-height: 1.5;
      text-align: left;

      cursor: pointer;
      transition: .2s;
    }

    .tut-topic-btn:hover {
      background: #f4f7f1;
      color: var(--forest);
    }

    .tut-topic-btn.active {
      background: #eaf1e6;
      border-color: #d8e5d4;
      color: var(--forest-dark);
      font-weight: 800;
    }

    .tut-topic-btn .n {
      display: grid;
      place-items: center;

      width: 27px;
      height: 27px;
      flex-shrink: 0;

      border-radius: 7px;
      background: #f0f3ed;

      color: #718078;
      font-size: 10px;
      font-weight: 800;
    }

    .tut-topic-btn.active .n {
      background: var(--forest);
      color: white;
    }

    .tut-topic-btn .topic-name {
      flex: 1;
    }

    .topic-check {
      color: #4d9361;
      font-size: 15px;
      font-weight: 900;
    }

    /* =====================================
           CONTENT
        ===================================== */

    .tut-content {
      min-width: 0;
      padding: 29px 32px;

      background: white;
      border: 1px solid var(--line);
      border-radius: 12px;

      box-shadow: 0 4px 18px rgba(29, 56, 45, .035);
    }

    /* =====================================
           FOOTER
        ===================================== */

    .site-footer {
      padding: 24px;
      border-top: 1px solid var(--line);
      background: #fff;
      text-align: center;
    }

    .site-footer p {
      margin: 0;
      color: #829087;
      font-size: 11px;
    }

    .site-footer strong {
      color: var(--forest);
    }

    /* =====================================
           LOGOUT MODAL
        ===================================== */

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
      color: white;
    }

    /* =====================================
           RESPONSIVE
        ===================================== */

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

      .tut-layout {
        grid-template-columns: 225px minmax(0, 1fr);
        gap: 17px;
      }

      .tut-content {
        padding: 23px;
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

      .tut-layout {
        display: flex;
        flex-direction: column;

        width: calc(100% - 28px);
        margin-top: 18px;
        gap: 15px;
      }

      .tut-sidebar {
        position: static;
        width: 100%;
        padding: 14px;
      }

      .sidebar-heading {
        padding-bottom: 10px;
      }

      .tut-sidebar #tutSidebarList {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 5px;
      }

      .tut-unit-divider {
        grid-column: 1 / -1;
      }

      .tut-topic-btn {
        margin: 0;
        font-size: 11px;
      }

      .tut-content {
        width: 100%;
        padding: 19px 16px;
      }

      .site-footer {
        padding: 20px 14px;
      }
    }

    @media (max-width: 420px) {

      .tut-sidebar #tutSidebarList {
        grid-template-columns: 1fr;
      }

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

    .tut-content,
    .tut-content p,
    .tut-content li,
    .tut-content button,
    .tut-sidebar {
      font-family: 'Manrope', Arial, sans-serif !important;
    }
  </style>

</head>


<body>

  <!-- =====================================
         NAVBAR
    ===================================== -->

  <header class="site-header" id="siteHeader">

    <div class="header-inner">

      <!-- BRAND -->

      <a class="brand" href="{{ url('/') }}">

        <span class="brand-mark" aria-hidden="true">
          ♧
        </span>

        <span>
          Wetland Explorer
        </span>

      </a>


      <!-- MOBILE MENU -->

      <button type="button" class="mobile-toggle" id="mobileNavToggle" aria-label="Buka navigasi" aria-expanded="false">

        <i class="fa-solid fa-bars"></i>

      </button>


      <!-- NAVIGATION -->

      <nav class="main-navigation" id="mainNavigation">

        <a href="{{ url('/dashboard') }}">
          Dashboard
        </a>

        <a href="{{ url('/tutorial') }}" class="active">
          Materi
        </a>

        <a href="{{ url('/exploration') }}">
          Eksplorasi
        </a>

        <a href="{{ url('/missions') }}">
          Misi
        </a>

        <a href="{{ url('/quiz') }}">
          Kuis
        </a>

      </nav>


      <!-- PROFILE -->

      <div class="profile-area">

        <button type="button" class="profile-button" id="profileButton" aria-label="Menu profil" aria-expanded="false">

          <i class="fa-solid fa-user"></i>

        </button>


        <div class="profile-dropdown" id="profileDropdown">

          <div class="profile-info">

            <strong>
              {{ Auth::user()->name }}
            </strong>

            <span>
              Siswa Wetland Explorer
            </span>

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

    </div>

  </header>


  <!-- =====================================
         MAIN LEARNING PORTAL
    ===================================== -->

  <main class="container-fluid">

    <div class="tut-layout">


      <!-- SIDEBAR MATERI -->

      <aside class="tut-sidebar">

        <div class="sidebar-heading">

          <h2>
            <i class="fa-solid fa-book-open"></i>
            Daftar Materi
          </h2>

        </div>


        <!-- Diisi otomatis oleh tutorial.js -->

        <div id="tutSidebarList">

          <div class="text-muted small p-2">
            Memuat daftar materi...
          </div>

        </div>

      </aside>


      <!-- CONTENT -->

      <section class="tut-content" id="tutContentBody" aria-live="polite">

        <div class="text-center py-5">

          <div class="spinner-border" role="status" style="color: var(--forest);">

          </div>

          <p class="mt-3 text-muted small">
            Sedang menyiapkan materi pembelajaran...
          </p>

        </div>

      </section>

    </div>

  </main>


  <!-- =====================================
         FOOTER
    ===================================== -->

  <footer class="site-footer" id="siteFooter">

    <p>
      © {{ date('Y') }}
      <strong>Wetland Explorer</strong>.

      Media Pembelajaran Ekosistem Lahan Basah.
    </p>

  </footer>


  <!-- =====================================
         LOGOUT CONFIRMATION MODAL
    ===================================== -->

  <div class="logout-modal" id="logoutModal">

    <div class="logout-dialog">

      <div class="logout-icon">
        <i class="fa-solid fa-right-from-bracket"></i>
      </div>

      <h3>Keluar dari akun?</h3>

      <p>
        Apakah kamu yakin ingin mengakhiri sesi pembelajaran
        dan keluar dari akun Wetland Explorer?
      </p>


      <div class="logout-actions">

        <button type="button" class="cancel-logout" id="cancelLogout">

          Batal

        </button>


        <form method="POST" action="{{ route('logout') }}" style="flex: 1;">

          @csrf

          <button type="submit" class="confirm-logout" style="width: 100%;">

            Ya, Keluar

          </button>

        </form>

      </div>

    </div>

  </div>


  <!-- =====================================
         JAVASCRIPT
    ===================================== -->

  <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <script src="{{ asset('js/data-tutorials.js') }}"></script>
  <script>
    window.WETLAND_DASHBOARD_URL = @json(url('/dashboard'));
    window.WETLAND_TOPIC_COMPLETION_URL = @json(url('/learning-progress/topics'));
  </script>
  <script src="{{ asset('js/praktik.js') }}"></script>
  <script src="{{ asset('js/tutorial.js') }}"></script>


  <!-- NAVBAR & PROFILE INTERACTION -->

  <script>

    document.addEventListener("DOMContentLoaded", function () {

      const profileButton =
        document.getElementById("profileButton");

      const profileDropdown =
        document.getElementById("profileDropdown");

      const logoutModal =
        document.getElementById("logoutModal");

      const openLogoutModal =
        document.getElementById("openLogoutModal");

      const cancelLogout =
        document.getElementById("cancelLogout");

      const mobileToggle =
        document.getElementById("mobileNavToggle");

      const mainNavigation =
        document.getElementById("mainNavigation");


      // PROFILE DROPDOWN

      profileButton.addEventListener("click", function (event) {

        event.stopPropagation();

        profileDropdown.classList.toggle("show");

        profileButton.classList.toggle("active");

        profileButton.setAttribute(
          "aria-expanded",
          profileDropdown.classList.contains("show")
        );

      });


      // CLOSE PROFILE DROPDOWN WHEN CLICKING OUTSIDE

      document.addEventListener("click", function (event) {

        if (
          !profileButton.contains(event.target) &&
          !profileDropdown.contains(event.target)
        ) {

          profileDropdown.classList.remove("show");

          profileButton.classList.remove("active");

          profileButton.setAttribute("aria-expanded", "false");

        }

      });


      // OPEN LOGOUT MODAL

      openLogoutModal.addEventListener("click", function () {

        logoutModal.classList.add("show");

        profileDropdown.classList.remove("show");

        profileButton.classList.remove("active");

      });


      // CANCEL LOGOUT

      cancelLogout.addEventListener("click", function () {

        logoutModal.classList.remove("show");

      });


      // CLOSE MODAL WHEN CLICKING OUTSIDE

      logoutModal.addEventListener("click", function (event) {

        if (event.target === logoutModal) {

          logoutModal.classList.remove("show");

        }

      });


      // MOBILE NAVIGATION

      mobileToggle.addEventListener("click", function () {

        mainNavigation.classList.toggle("show");

        const isOpen =
          mainNavigation.classList.contains("show");

        mobileToggle.setAttribute(
          "aria-expanded",
          isOpen
        );

        mobileToggle.innerHTML = isOpen
          ? '<i class="fa-solid fa-xmark"></i>'
          : '<i class="fa-solid fa-bars"></i>';

      });


      // CLOSE MOBILE NAVIGATION AFTER CLICK

      mainNavigation.querySelectorAll("a").forEach(link => {

        link.addEventListener("click", function () {

          mainNavigation.classList.remove("show");

        });

      });


      // ESCAPE KEY

      document.addEventListener("keydown", function (event) {

        if (event.key === "Escape") {

          logoutModal.classList.remove("show");

          profileDropdown.classList.remove("show");

          mainNavigation.classList.remove("show");

          profileButton.classList.remove("active");

        }

      });

    });

  </script>

</body>

</html>