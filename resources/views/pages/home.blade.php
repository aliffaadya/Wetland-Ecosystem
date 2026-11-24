<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wetland Explorer - Jelajah, Pelajari, dan Jaga Lahan Basah Kalimantan</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Font dan ikon mengikuti Dashboard -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        /* FONT HOME */
        body {
            font-family: 'Manrope', Arial, sans-serif;
        }

        /* NAVBAR - MENGIKUTI DASHBOARD */
        .site-header {
            position: sticky;
            top: 0;
            z-index: 999;
            width: 100%;
            background: #ffffff;
            border-bottom: 1px solid #dce8dc;
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
            color: #1d382d;
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
            background: #284b3b;
            font-size: 25px;
        }

        .profile-link {
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


        @media (max-width: 480px) {
            .header-inner {
                width: calc(100% - 28px);
            }

            .brand {
                font-size: 17px;
            }
        }
    </style>
</head>

<body class="bg-[#F6F8F5] text-gray-800 font-sans antialiased">

    <!-- NAVBAR -->
    <header class="site-header">
        <div class="header-inner">

            <!-- Logo mengikuti Dashboard -->
            <a class="brand" href="{{ route('home') }}">
                <span class="brand-mark" aria-hidden="true">♧</span>
                <span>Wetland Explorer</span>
            </a>

            <!-- Ikon Profil / Login -->
            @auth
                <a href="{{ route('dashboard') }}" class="profile-link" title="Dashboard" aria-label="Dashboard">
                    <i class="bi bi-person-fill"></i>
                </a>
            @else
                <a href="{{ route('login') }}" class="profile-link" title="Masuk" aria-label="Masuk">
                    <i class="bi bi-person-fill"></i>
                </a>
            @endauth

        </div>
    </header>


    <!-- HERO SECTION FULL WIDTH -->
    <section
        class="relative min-h-[540px] flex flex-col justify-start items-center text-center px-4 pt-12 pb-8 bg-cover bg-center"
        style="background-image: linear-gradient(to bottom, rgba(255,255,255,0.75) 0%, rgba(255,255,255,0.25) 45%, rgba(0,0,0,0.2) 100%), url('{{ asset('images/wetland-hero.svg') }}'); background-position: center 55%;"
        <!-- Konten Tengah Hero -->
        <div class="max-w-3xl mx-auto mt-4 z-10">

            <!-- Judul Utama -->
            <h1
                class="text-4xl md:text-5xl font-extrabold text-[#2E7D32] drop-shadow-sm tracking-tight flex items-center justify-center gap-2">

                <span>Wetland Explorer</span>

                <svg class="w-7 h-7 text-[#43A047] -mt-4" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M17 8C8 10 5.9 16.17 3.82 21.34l1.89.66.95-2.3c.48.17.98.3 1.34.3C19 20 22 3 22 3c-1 2-8 2.25-13 3.25S2 11.5 2 13.5s1.75 3.75 1.75 3.75C7 8 17 8 17 8Z" />
                </svg>
            </h1>

            <!-- Subjudul -->
            <p class="mt-2 text-lg md:text-xl font-extrabold text-[#202b25]"
                style="text-shadow: 0 2px 4px rgba(255,255,255,0.85);">
                Jelajah, Pelajari, dan Jaga Lahan Basah Kalimantan
            </p>

            <!-- Badge Kelas -->
            <div
                class="mt-3 inline-block bg-white/95 backdrop-blur-sm px-5 py-1.5 rounded-full shadow-md border border-green-200">
                <p class="text-xs md:text-sm font-semibold text-gray-700">
                    Media pembelajaran interaktif untuk <br class="sm:hidden"> SMP Kelas VII
                </p>
            </div>

            <!-- Tombol CTA Utama -->
            <div class="mt-6">
                <a href="{{ route('login') }}"
                    class="inline-flex items-center gap-2.5 text-white font-bold text-base px-8 py-3 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition duration-200"
                    style="background-color: #167447;" onmouseover="this.style.backgroundColor='#123f32'"
                    onmouseout="this.style.backgroundColor='#167447'">

                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                        <path d="M8 5v14l11-7z" />
                    </svg>

                    <span>Mulai Belajar</span>
                </a>
            </div>

        </div>


        <!-- 4 KARTU FITUR DI BAGIAN BAWAH HERO -->
        <div class="w-full max-w-4xl mx-auto mt-16 z-10">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">

                <!-- Kartu 1: Materi Interaktif -->
                <div
                    class="bg-white/95 hover:bg-white backdrop-blur-md rounded-2xl p-4 shadow-md hover:shadow-lg transition flex flex-col items-center text-center group">

                    <div
                        class="w-10 h-10 rounded-full bg-green-50 text-[#2E7D32] flex items-center justify-center mb-2 group-hover:scale-110 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>

                    <h3 class="font-bold text-gray-800 text-sm leading-snug">
                        Materi<br>Interaktif
                    </h3>
                </div>


                <!-- Kartu 2: Eksplorasi Virtual -->
                <div
                    class="bg-white/95 hover:bg-white backdrop-blur-md rounded-2xl p-4 shadow-md hover:shadow-lg transition flex flex-col items-center text-center group">

                    <div
                        class="w-10 h-10 rounded-full bg-green-50 text-[#2E7D32] flex items-center justify-center mb-2 group-hover:scale-110 transition">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" />
                        </svg>
                    </div>

                    <h3 class="font-bold text-gray-800 text-sm leading-snug">
                        Eksplorasi<br>Virtual
                    </h3>
                </div>


                <!-- Kartu 3: Misi Pelestarian -->
                <div
                    class="bg-white/95 hover:bg-white backdrop-blur-md rounded-2xl p-4 shadow-md hover:shadow-lg transition flex flex-col items-center text-center group">

                    <div
                        class="w-10 h-10 rounded-full bg-green-50 text-[#2E7D32] flex items-center justify-center mb-2 group-hover:scale-110 transition">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M21 6H3c-1.1 0-2 .9-2 2v8c0 1.1.9 2 2 2h18c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2zm-10 7H8v3H6v-3H3v-2h3V8h2v3h3v2zm4.5 2c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zm4-3c-.83 0-1.5-.67-1.5-1.5S18.67 9 19.5 9s1.5.67 1.5 1.5-.67 1.5-1.5 1.5z" />
                        </svg>
                    </div>

                    <h3 class="font-bold text-gray-800 text-sm leading-snug">
                        Misi<br>Pelestarian
                    </h3>
                </div>


                <!-- Kartu 4: Kuis & Evaluasi -->
                <div
                    class="bg-white/95 hover:bg-white backdrop-blur-md rounded-2xl p-4 shadow-md hover:shadow-lg transition flex flex-col items-center text-center group">

                    <div
                        class="w-10 h-10 rounded-full bg-green-50 text-[#2E7D32] flex items-center justify-center mb-2 group-hover:scale-110 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                        </svg>
                    </div>

                    <h3 class="font-bold text-gray-800 text-sm leading-snug">
                        Kuis &<br>Evaluasi
                    </h3>
                </div>

            </div>
        </div>

    </section>

</body>

</html>