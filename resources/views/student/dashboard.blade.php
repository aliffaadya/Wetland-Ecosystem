<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Dashboard Siswa — Wetland Explorer</title>

    <link rel="stylesheet" href="{{ asset('css/wetland-landing.css') }}">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --green-dark: #123f32;
            --green: #167447;
            --green-medium: #39885b;
            --green-light: #e8f3e7;
            --green-pale: #f1f7ec;
            --cream: #fbfaf2;
            --text: #172b28;
            --muted: #718078;
            --border: #dce8dc;
            --forest: #284b3b;
            --forest-dark: #1d382d;
            --leaf: #6f966d;
            --sage: #e6eee2;
            --cream: #f5f7ef;
            --ink: #202b25;
            --muted: #647269;
            --line: #dce5d8;
            --white: #fff;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #f5f8f2;
            color: var(--text);
            font-family: 'Manrope', Arial, sans-serif;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        /* =========================
           NAVBAR
        ========================= */

        .site-header {
            position: sticky;
            top: 0;
            z-index: 999;
            width: 100%;
            background: #ffffff;
            border-bottom: 1px solid var(--border);
            box-shadow: 0 2px 10px rgba(18, 63, 50, .05);
        }

        .header-inner {
            width: min(1440px, calc(100% - 48px));
            min-height: 72px;
            margin: auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .brand {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            color: var(--forest-dark);
            font: 800 21px 'Manrope', sans-serif;
            letter-spacing: -.6px;
            text-decoration: none;
        }

        .brand-mark {
            display: grid;
            place-items: center;
            width: 36px;
            height: 36px;
            border-radius: 12px;
            color: white;
            background: var(--forest);
            font-size: 25px;
        }

        .profile-link {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            border-radius: 50%;
            color: var(--green-dark);
            font-size: 23px;
            transition: .2s;
        }

        .profile-link:hover {
            background: var(--green-light);
        }

        /* =========================
           PROFILE DROPDOWN & LOGOUT MODAL
        ========================= */

        .profile-menu {
            position: relative;
            flex-shrink: 0;
        }

        .profile-link {
            border: 0;
            background: transparent;
            cursor: pointer;
        }

        .profile-dropdown {
            position: absolute;
            top: calc(100% + 12px);
            right: 0;
            z-index: 1001;
            width: 235px;
            padding: 10px;
            border: 1px solid var(--border);
            border-radius: 16px;
            background: #fff;
            box-shadow: 0 14px 35px rgba(18, 63, 50, .16);
            opacity: 0;
            visibility: hidden;
            transform: translateY(-7px);
            transition: opacity .18s ease, transform .18s ease, visibility .18s ease;
        }

        .profile-dropdown.is-open {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .profile-dropdown-user {
            padding: 11px 12px 13px;
            border-bottom: 1px solid #edf1eb;
            margin-bottom: 7px;
        }

        .profile-dropdown-user strong {
            display: block;
            color: var(--green-dark);
            font-size: 13px;
            font-weight: 850;
            overflow-wrap: anywhere;
        }

        .profile-dropdown-user span {
            display: block;
            margin-top: 4px;
            color: var(--muted);
            font-size: 11px;
            overflow-wrap: anywhere;
        }

        .profile-logout-button {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 11px 12px;
            border: 0;
            border-radius: 10px;
            background: transparent;
            color: #b64242;
            font: inherit;
            font-size: 12px;
            font-weight: 800;
            text-align: left;
            cursor: pointer;
            transition: background .18s ease;
        }

        .profile-logout-button:hover {
            background: #fff1ef;
        }

        .logout-modal {
            position: fixed;
            inset: 0;
            z-index: 2000;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background: rgba(12, 35, 27, .48);
            opacity: 0;
            visibility: hidden;
            transition: opacity .2s ease, visibility .2s ease;
        }

        .logout-modal.is-visible {
            opacity: 1;
            visibility: visible;
        }

        .logout-dialog {
            width: min(420px, 100%);
            padding: 30px;
            border: 1px solid #e1eadf;
            border-radius: 22px;
            background: #fff;
            box-shadow: 0 22px 65px rgba(0, 0, 0, .2);
            text-align: center;
            transform: translateY(12px) scale(.98);
            transition: transform .2s ease;
        }

        .logout-modal.is-visible .logout-dialog {
            transform: translateY(0) scale(1);
        }

        .logout-dialog-icon {
            width: 62px;
            height: 62px;
            display: grid;
            place-items: center;
            margin: 0 auto 17px;
            border-radius: 20px;
            background: #fff3e8;
            color: #c47732;
            font-size: 28px;
        }

        .logout-dialog h2 {
            margin: 0 0 9px;
            color: var(--green-dark);
            font-size: 21px;
            font-weight: 900;
        }

        .logout-dialog p {
            margin: 0;
            color: var(--muted);
            font-size: 13px;
            line-height: 1.7;
        }

        .logout-dialog-actions {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 24px;
        }

        .logout-dialog-actions button {
            min-height: 42px;
            padding: 10px 18px;
            border-radius: 12px;
            font: inherit;
            font-size: 12px;
            font-weight: 850;
            cursor: pointer;
            transition: .18s ease;
        }

        .logout-cancel {
            border: 1px solid var(--border);
            background: #fff;
            color: #52645a;
        }

        .logout-cancel:hover {
            background: #f4f7f1;
        }

        .logout-confirm {
            border: 1px solid #b84242;
            background: #b84242;
            color: #fff;
        }

        .logout-confirm:hover {
            border-color: #963333;
            background: #963333;
        }

        @media (max-width: 480px) {
            .profile-dropdown {
                right: -4px;
            }

            .logout-dialog {
                padding: 25px 20px;
            }

            .logout-dialog-actions {
                flex-direction: column-reverse;
            }

            .logout-dialog-actions button {
                width: 100%;
            }
        }

        /* =========================
           MAIN CONTAINER
        ========================= */

        .dash-wrap {
            width: min(1180px, calc(100% - 40px));
            margin: 32px auto 65px;
        }

        /* =========================
           WELCOME BANNER
        ========================= */

        .welcome-banner {
            position: relative;
            display: flex;
            align-items: center;
            min-height: 205px;
            padding: 35px 40px;
            overflow: hidden;
            border: 1px solid #d6e7d1;
            border-radius: 22px;
            background:
                radial-gradient(circle at 90% 10%,
                    rgba(255, 255, 255, .65),
                    transparent 28%),
                linear-gradient(110deg,
                    #e2f0dc 0%,
                    #edf5e7 52%,
                    #d9ebd4 100%);
        }

        .welcome-content {
            position: relative;
            z-index: 2;
            max-width: 700px;
        }

        .welcome-kicker {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 7px 12px;
            margin-bottom: 12px;
            border: 1px solid #cce0c8;
            border-radius: 30px;
            background: rgba(255, 255, 255, .72);
            color: var(--green);
            font-size: 10px;
            font-weight: 850;
            letter-spacing: 1px;
        }

        .welcome-banner h1 {
            margin: 0 0 10px;
            color: var(--green-dark);
            font-size: clamp(27px, 4vw, 37px);
            font-weight: 900;
            letter-spacing: -1.3px;
            line-height: 1.2;
        }

        .welcome-banner p {
            max-width: 560px;
            margin: 0;
            color: #476454;
            font-size: 14px;
            line-height: 1.8;
        }

        .welcome-decoration {
            position: absolute;
            right: 45px;
            bottom: -22px;
            display: flex;
            align-items: flex-end;
            gap: 4px;
            color: rgba(22, 116, 71, .17);
            font-size: 100px;
            line-height: 1;
            user-select: none;
        }

        .welcome-decoration span:last-child {
            font-size: 65px;
            margin-bottom: 12px;
        }

        /* =========================
           STATISTICS
        ========================= */

        .stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 17px;
            margin: 24px 0;
        }

        .stat-card {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 21px;
            border: 1px solid var(--border);
            border-radius: 18px;
            background: white;
            box-shadow: 0 4px 16px rgba(35, 75, 45, .035);
        }

        .stat-icon {
            width: 49px;
            height: 49px;
            display: grid;
            place-items: center;
            flex-shrink: 0;
            border-radius: 15px;
            background: var(--green-light);
            color: var(--green);
            font-size: 22px;
        }

        .stat-info strong {
            display: block;
            margin-bottom: 4px;
            color: var(--green-dark);
            font-size: 27px;
            font-weight: 900;
        }

        .stat-info span {
            color: var(--muted);
            font-size: 12px;
            font-weight: 650;
        }

        /* =========================
           PROGRESS
        ========================= */

        .progress-panel {
            padding: 25px 27px;
            border: 1px solid var(--border);
            border-radius: 20px;
            background: white;
            box-shadow: 0 4px 16px rgba(35, 75, 45, .035);
        }

        .panel-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .panel-heading h2 {
            margin: 0;
            color: var(--green-dark);
            font-size: 19px;
            font-weight: 850;
        }

        .progress-percent {
            padding: 7px 12px;
            border-radius: 30px;
            background: var(--green-light);
            color: var(--green);
            font-size: 12px;
            font-weight: 850;
        }

        .progress-description {
            margin: 9px 0 0;
            color: var(--muted);
            font-size: 12px;
            line-height: 1.7;
        }

        .progress-track {
            height: 12px;
            margin: 18px 0 10px;
            overflow: hidden;
            border-radius: 30px;
            background: #eaf0e7;
        }

        .progress-fill {
            width: 0%;
            height: 100%;
            border-radius: inherit;
            background: linear-gradient(90deg, #77a974, #167447);
        }

        .progress-note {
            color: var(--muted);
            font-size: 11px;
        }

        /* =========================
           ACTIVITIES
        ========================= */

        .activity-section {
            margin-top: 38px;
        }

        .section-heading {
            margin-bottom: 19px;
        }

        .section-heading h2 {
            margin: 0 0 7px;
            color: var(--green-dark);
            font-size: 24px;
            font-weight: 900;
            letter-spacing: -.5px;
        }

        .section-heading p {
            margin: 0;
            color: var(--muted);
            font-size: 13px;
            line-height: 1.7;
        }

        .modules {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px;
        }

        .module-card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-height: 220px;
            padding: 24px;
            overflow: hidden;
            border: 1px solid var(--border);
            border-radius: 20px;
            background: white;
            box-shadow: 0 4px 16px rgba(35, 75, 45, .04);
            transition:
                transform .25s ease,
                box-shadow .25s ease,
                border-color .25s ease;
        }

        .module-card::before {
            content: "";
            position: absolute;
            top: -65px;
            right: -55px;
            width: 165px;
            height: 165px;
            border-radius: 50%;
            background: #f0f6e9;
            transition: .25s ease;
        }

        .module-card:hover {
            transform: translateY(-5px);
            border-color: #9bc59b;
            box-shadow: 0 12px 26px rgba(30, 90, 52, .11);
        }

        .module-card:hover::before {
            transform: scale(1.2);
            background: #e4f0dd;
        }

        .module-top,
        .module-content,
        .module-bottom {
            position: relative;
            z-index: 1;
        }

        .module-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
        }

        .module-icon {
            width: 53px;
            height: 53px;
            display: grid;
            place-items: center;
            border-radius: 16px;
            background: var(--green-light);
            color: var(--green);
            font-size: 25px;
        }

        .module-label {
            padding: 7px 11px;
            border-radius: 30px;
            background: #f0f6e9;
            color: var(--green);
            font-size: 10px;
            font-weight: 850;
            letter-spacing: .5px;
        }

        .module-content h3 {
            margin: 17px 0 7px;
            color: var(--green-dark);
            font-size: 18px;
            font-weight: 900;
        }

        .module-content p {
            margin: 0;
            color: var(--muted);
            font-size: 12px;
            line-height: 1.8;
        }

        .module-bottom {
            margin-top: auto;
            padding-top: 19px;
        }

        .module-action {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 11px;
            min-height: 39px;
            padding: 10px 17px;
            border-radius: 30px;
            background: var(--green);
            color: white;
            font-size: 11px;
            font-weight: 850;
            box-shadow: 0 4px 10px rgba(22, 116, 71, .16);
            transition: .2s ease;
        }

        .module-card:hover .module-action {
            gap: 16px;
            background: var(--green-dark);
        }

        /* =========================
           HISTORY
        ========================= */

        .history-panel {
            margin-top: 27px;
            padding: 25px 27px;
            border: 1px solid var(--border);
            border-radius: 20px;
            background: white;
            box-shadow: 0 4px 16px rgba(35, 75, 45, .035);
        }

        .history-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .history-heading h2 {
            margin: 0;
            color: var(--green-dark);
            font-size: 19px;
            font-weight: 850;
        }

        .history-tag {
            padding: 7px 11px;
            border-radius: 30px;
            background: var(--green-light);
            color: var(--green);
            font-size: 10px;
            font-weight: 800;
        }

        .history-description {
            margin: 9px 0 0;
            color: var(--muted);
            font-size: 12px;
            line-height: 1.7;
        }

        .table-wrap {
            overflow-x: auto;
        }

        table {
            width: 100%;
            min-width: 500px;
            margin-top: 17px;
            border-collapse: collapse;
            font-size: 12px;
        }

        th,
        td {
            padding: 14px 12px;
            border-bottom: 1px solid #e8eee6;
            text-align: left;
        }

        th {
            color: var(--muted);
            font-size: 10px;
            font-weight: 850;
            letter-spacing: .5px;
            text-transform: uppercase;
        }

        td {
            color: #42544a;
        }

        .empty-history {
            padding: 27px 12px;
            color: var(--muted);
            text-align: center;
            line-height: 1.8;
        }

        .footer-note {
            margin-top: 27px;
            color: var(--muted);
            font-size: 11px;
            line-height: 1.8;
            text-align: center;
        }

        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 900px) {
            .header-inner {
                width: calc(100% - 28px);
                flex-wrap: wrap;
                padding: 10px 0;
                gap: 5px;
            }


            .welcome-decoration {
                right: 10px;
                opacity: .65;
            }
        }

        @media (max-width: 650px) {
            .dash-wrap {
                width: calc(100% - 28px);
                margin-top: 23px;
            }

            .welcome-banner {
                min-height: 190px;
                padding: 25px 22px;
            }

            .welcome-banner p {
                max-width: 90%;
                font-size: 12px;
            }

            .welcome-decoration {
                right: -12px;
                bottom: -10px;
                font-size: 65px;
                opacity: .4;
            }

            .welcome-decoration span:last-child {
                font-size: 43px;
            }

            .stats {
                grid-template-columns: 1fr;
                gap: 11px;
                margin: 17px 0;
            }

            .stat-card {
                padding: 16px;
            }

            .stat-icon {
                width: 43px;
                height: 43px;
            }

            .stat-info strong {
                font-size: 23px;
            }

            .modules {
                grid-template-columns: 1fr;
            }

            .module-card {
                min-height: 205px;
            }

            .progress-panel,
            .history-panel {
                padding: 20px;
            }

            .section-heading h2 {
                font-size: 21px;
            }
        }
    </style>
</head>

<body>

    <!-- =========================
         NAVBAR
    ========================= -->

    <header class="site-header">
        <div class="header-inner">


            <a class="brand" href="{{ url('/') }}">
                <span class="brand-mark" aria-hidden="true">♧</span>
                <span>Wetland Explorer</span>
            </a>

            <div class="profile-menu">
                <button class="profile-link" type="button" id="profileMenuButton" aria-label="Buka menu profil"
                    aria-haspopup="true" aria-expanded="false" aria-controls="profileDropdown">
                    <i class="bi bi-person-fill"></i>
                </button>

                <div class="profile-dropdown" id="profileDropdown" role="menu" aria-labelledby="profileMenuButton">
                    <div class="profile-dropdown-user">
                        <strong>{{ Auth::user()->name }}</strong>
                        <span>{{ Auth::user()->email }}</span>
                    </div>

                    <button class="profile-logout-button" type="button" id="openLogoutModal" role="menuitem">
                        <i class="bi bi-box-arrow-right"></i>
                        Keluar
                    </button>
                </div>
            </div>

        </div>
    </header>

    <!-- LOGOUT CONFIRMATION MODAL -->
    <div class="logout-modal" id="logoutModal" role="dialog" aria-modal="true" aria-labelledby="logoutModalTitle"
        aria-hidden="true">
        <div class="logout-dialog">
            <div class="logout-dialog-icon">
                <i class="bi bi-box-arrow-right"></i>
            </div>

            <h2 id="logoutModalTitle">Yakin ingin keluar?</h2>
            <p>
                Apakah kamu yakin ingin keluar dari akun Wetland Explorer?
                Kamu perlu masuk kembali untuk melanjutkan aktivitas belajar.
            </p>

            <div class="logout-dialog-actions">
                <button type="button" class="logout-cancel" id="cancelLogout">
                    Batal
                </button>

                <button type="submit" form="logoutForm" class="logout-confirm">
                    Ya, Keluar
                </button>
            </div>
        </div>
    </div>

    <form id="logoutForm" method="POST" action="{{ route('logout') }}" style="display: none;">
        @csrf
    </form>


    <!-- =========================
         MAIN DASHBOARD
    ========================= -->

    <main class="dash-wrap">

        <!-- WELCOME BANNER -->

        <section class="welcome-banner">

            <div class="welcome-content">

                <span class="welcome-kicker">
                    🌿 RUANG BELAJAR SISWA
                </span>

                <h1>
                    Halo, {{ Auth::user()->name }}!
                </h1>

                <p>
                    Selamat datang di Wetland Explorer.
                    Siap menjelajahi, mempelajari, dan mengenal
                    keanekaragaman ekosistem lahan basah Kalimantan?
                    Yuk, mulai petualangan belajarmu!
                </p>

            </div>

            <div class="welcome-decoration" aria-hidden="true">
                <span>🌿</span>
                <span>🍃</span>
            </div>

        </section>


        <!-- STATISTICS -->

        <section class="stats">

            <article class="stat-card">

                <div class="stat-icon">
                    <i class="bi bi-book-half"></i>
                </div>

                <div class="stat-info">
                    <strong>0%</strong>
                    <span>Progress Pembelajaran</span>
                </div>

            </article>


            <article class="stat-card">

                <div class="stat-icon">
                    <i class="bi bi-pencil-square"></i>
                </div>

                <div class="stat-info">
                    <strong>0</strong>
                    <span>Latihan Diselesaikan</span>
                </div>

            </article>


            <article class="stat-card">

                <div class="stat-icon">
                    <i class="bi bi-trophy"></i>
                </div>

                <div class="stat-info">
                    <strong>—</strong>
                    <span>Nilai Kuis Terakhir</span>
                </div>

            </article>

        </section>


        <!-- PROGRESS MATERI -->

        <section class="progress-panel">

            <div class="panel-heading">

                <h2>
                    <i class="bi bi-bar-chart-line"></i>
                    Progress Materi
                </h2>

                <span class="progress-percent">0%</span>

            </div>

            <p class="progress-description">
                Pantau perkembanganmu dalam mempelajari
                berbagai materi ekosistem lahan basah.
            </p>

            <div class="progress-track">
                <div class="progress-fill"></div>
            </div>

            <small class="progress-note">
                0 dari seluruh materi selesai
            </small>

        </section>


        <!-- AKTIVITAS BELAJAR -->

        <section class="activity-section">

            <div class="section-heading">

                <h2>Mulai Aktivitas Belajar</h2>

                <p>
                    Pilih aktivitas yang ingin kamu lakukan
                    dan mulai petualangan belajarmu!
                </p>

            </div>


            <div class="modules">

                <!-- MATERI -->

                <a class="module-card" href="{{ url('/tutorial') }}">

                    <div class="module-top">

                        <span class="module-icon">
                            <i class="bi bi-book"></i>
                        </span>

                        <span class="module-label">
                            PEMBELAJARAN
                        </span>

                    </div>

                    <div class="module-content">

                        <h3>Materi Pembelajaran</h3>

                        <p>
                            Pelajari konsep, jenis, karakteristik,
                            serta keanekaragaman ekosistem lahan basah.
                        </p>

                    </div>

                    <div class="module-bottom">

                        <span class="module-action">
                            Mulai Belajar
                            <i class="bi bi-arrow-right"></i>
                        </span>

                    </div>

                </a>


                <!-- EKSPLORASI -->

                <a class="module-card" href="{{ url('/exploration') }}">

                    <div class="module-top">

                        <span class="module-icon">
                            <i class="bi bi-geo-alt"></i>
                        </span>

                        <span class="module-label">
                            EKSPLORASI
                        </span>

                    </div>

                    <div class="module-content">

                        <h3>Eksplorasi Virtual</h3>

                        <p>
                            Jelajahi lingkungan lahan basah
                            dan kenali berbagai flora serta fauna.
                        </p>

                    </div>

                    <div class="module-bottom">

                        <span class="module-action">
                            Mulai Eksplorasi
                            <i class="bi bi-arrow-right"></i>
                        </span>

                    </div>

                </a>


                <!-- MISI -->

                <a class="module-card" href="{{ url('/missions') }}">

                    <div class="module-top">

                        <span class="module-icon">
                            <i class="bi bi-flower1"></i>
                        </span>

                        <span class="module-label">
                            TANTANGAN
                        </span>

                    </div>

                    <div class="module-content">

                        <h3>Misi Pelestarian</h3>

                        <p>
                            Selesaikan tantangan menarik untuk
                            membantu menjaga kelestarian lahan basah.
                        </p>

                    </div>

                    <div class="module-bottom">

                        <span class="module-action">
                            Mulai Misi
                            <i class="bi bi-arrow-right"></i>
                        </span>

                    </div>

                </a>


                <!-- KUIS -->

                <a class="module-card" href="{{ url('/quiz') }}">

                    <div class="module-top">

                        <span class="module-icon">
                            <i class="bi bi-clipboard-check"></i>
                        </span>

                        <span class="module-label">
                            EVALUASI
                        </span>

                    </div>

                    <div class="module-content">

                        <h3>Kuis Evaluasi</h3>

                        <p>
                            Uji pemahamanmu melalui kuis
                            seputar ekosistem lahan basah.
                        </p>

                    </div>

                    <div class="module-bottom">

                        <span class="module-action">
                            Mulai Kuis
                            <i class="bi bi-arrow-right"></i>
                        </span>

                    </div>

                </a>

            </div>

        </section>


        <!-- RIWAYAT NILAI -->

        <section class="history-panel">

            <div class="history-heading">

                <h2>
                    <i class="bi bi-award"></i>
                    Riwayat Nilai
                </h2>

                <span class="history-tag">
                    AKTIVITAS BELAJAR
                </span>

            </div>

            <p class="history-description">
                Lihat hasil latihan dan kuis yang telah kamu kerjakan.
            </p>

            <div class="table-wrap">

                <table>

                    <thead>
                        <tr>
                            <th>Aktivitas</th>
                            <th>Tanggal</th>
                            <th>Nilai</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>

                        <tr>
                            <td colspan="4" class="empty-history">
                                Belum ada hasil belajar yang tersimpan.
                                <br>
                                Yuk, mulai aktivitas belajarmu!
                            </td>
                        </tr>

                    </tbody>

                </table>

            </div>

        </section>

    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const profileButton = document.getElementById('profileMenuButton');
            const profileDropdown = document.getElementById('profileDropdown');
            const openLogoutButton = document.getElementById('openLogoutModal');
            const logoutModal = document.getElementById('logoutModal');
            const cancelLogoutButton = document.getElementById('cancelLogout');

            function closeProfileDropdown() {
                profileDropdown.classList.remove('is-open');
                profileButton.setAttribute('aria-expanded', 'false');
            }

            function openModal() {
                closeProfileDropdown();
                logoutModal.classList.add('is-visible');
                logoutModal.setAttribute('aria-hidden', 'false');
                cancelLogoutButton.focus();
            }

            function closeModal() {
                logoutModal.classList.remove('is-visible');
                logoutModal.setAttribute('aria-hidden', 'true');
                profileButton.focus();
            }

            profileButton.addEventListener('click', function (event) {
                event.stopPropagation();

                const isOpen = profileDropdown.classList.toggle('is-open');
                profileButton.setAttribute('aria-expanded', String(isOpen));
            });

            openLogoutButton.addEventListener('click', openModal);
            cancelLogoutButton.addEventListener('click', closeModal);

            document.addEventListener('click', function (event) {
                if (!profileDropdown.contains(event.target) &&
                    !profileButton.contains(event.target)) {
                    closeProfileDropdown();
                }
            });

            logoutModal.addEventListener('click', function (event) {
                if (event.target === logoutModal) {
                    closeModal();
                }
            });

            document.addEventListener('keydown', function (event) {
                if (event.key === 'Escape') {
                    if (logoutModal.classList.contains('is-visible')) {
                        closeModal();
                    } else {
                        closeProfileDropdown();
                    }
                }
            });
        });
    </script>

</body>

</html>