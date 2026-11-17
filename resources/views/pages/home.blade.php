<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wetland Explorer - Jelajah, Pelajari, dan Jaga Lahan Basah Kalimantan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F6F8F5] text-gray-800 font-sans antialiased">

    <!-- Navbar -->
    <nav class="bg-white/95 backdrop-blur-sm shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-2.5">
                    <div class="w-9 h-9 bg-[#2E7D32] rounded-lg flex items-center justify-center text-white shadow-sm">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C7.5 2 4 5.5 4 10c0 3.5 2.5 6.5 6 7.5V22h4v-4.5c3.5-1 6-4 6-7.5 0-4.5-3.5-8-8-8z"/>
                        </svg>
                    </div>
                    <div class="leading-tight">
                        <span class="block font-bold text-[#1B5E20] text-base">Wetland</span>
                        <span class="block font-bold text-[#2E7D32] text-sm -mt-1">Explorer</span>
                    </div>
                </a>

                <!-- Menu Navigasi Tengah -->
                <div class="hidden md:flex items-center space-x-8 text-sm font-medium">
                    <a href="{{ route('home') }}" class="text-[#1B5E20] font-bold border-b-2 border-[#2E7D32] pb-1">Beranda</a>
                    <a href="{{ url('/tutorial') }}" class="text-gray-600 hover:text-[#2E7D32] transition">Materi</a>
                    <a href="{{ url('/exploration') }}" class="text-gray-600 hover:text-[#2E7D32] transition">Eksplorasi</a>
                    <a href="{{ url('/missions') }}" class="text-gray-600 hover:text-[#2E7D32] transition">Misi</a>
                    <a href="{{ url('/quiz') }}" class="text-gray-600 hover:text-[#2E7D32] transition">Kuis</a>
                    <a href="#tentang" class="text-gray-600 hover:text-[#2E7D32] transition">Tentang</a>
                </div>

                <!-- Ikon Profil / Login di Kanan -->
                <div class="flex items-center">
                    @auth
                        <a href="{{ route('dashboard') }}" class="w-9 h-9 rounded-full bg-gray-100 hover:bg-green-100 flex items-center justify-center text-gray-700 hover:text-[#2E7D32] transition" title="Dashboard">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/>
                            </svg>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="w-9 h-9 rounded-full bg-gray-100 hover:bg-green-100 flex items-center justify-center text-gray-700 hover:text-[#2E7D32] transition" title="Masuk">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/>
                            </svg>
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section Full Width -->
    <section class="relative min-h-[540px] flex flex-col justify-between items-center text-center px-4 pt-12 pb-8 bg-cover bg-center"
             style="background-image: linear-gradient(to bottom, rgba(255,255,255,0.75) 0%, rgba(255,255,255,0.25) 45%, rgba(0,0,0,0.2) 100%), url('{{ asset('images/wetland-hero.svg') }}');">
        
        <!-- Konten Tengah Hero -->
        <div class="max-w-3xl mx-auto mt-4 z-10">
            <!-- Judul Utama -->
            <h1 class="text-4xl md:text-5xl font-extrabold text-[#2E7D32] drop-shadow-sm tracking-tight flex items-center justify-center gap-2">
                <span>Wetland Explorer</span>
                <svg class="w-7 h-7 text-[#43A047] -mt-4" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17 8C8 10 5.9 16.17 3.82 21.34l1.89.66.95-2.3c.48.17.98.3 1.34.3C19 20 22 3 22 3c-1 2-8 2.25-13 3.25S2 11.5 2 13.5s1.75 3.75 1.75 3.75C7 8 17 8 17 8Z"/>
                </svg>
            </h1>

            <!-- Subjudul -->
            <p class="mt-2 text-lg md:text-xl font-bold text-gray-800 drop-shadow-sm">
                Jelajah, Pelajari, dan Jaga Lahan Basah Kalimantan
            </p>

            <!-- Badge Kelas -->
            <div class="mt-3 inline-block bg-white/90 backdrop-blur-sm px-5 py-1.5 rounded-full shadow-sm border border-green-100">
                <p class="text-xs md:text-sm font-semibold text-gray-700">
                    Media pembelajaran interaktif untuk <br class="sm:hidden"> SMP Kelas VII
                </p>
            </div>

            <!-- Tombol CTA Utama -->
            <div class="mt-6">
                <a href="{{ url('/tutorial') }}"
                   class="inline-flex items-center gap-2.5 bg-[#388E3C] hover:bg-[#2E7D32] text-white font-bold text-base px-8 py-3 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition duration-200">
                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                        <path d="M8 5v14l11-7z"/>
                    </svg>
                    <span>Mulai Belajar</span>
                </a>
            </div>
        </div>

        <!-- 4 Kartu Fitur di Bagian Bawah Hero -->
        <div class="w-full max-w-4xl mx-auto mt-16 z-10">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                
                <!-- Kartu 1: Materi Interaktif -->
                <a href="{{ url('/tutorial') }}" class="bg-white/95 hover:bg-white backdrop-blur-md rounded-2xl p-4 shadow-md hover:shadow-lg transition flex flex-col items-center text-center group">
                    <div class="w-10 h-10 rounded-full bg-green-50 text-[#2E7D32] flex items-center justify-center mb-2 group-hover:scale-110 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-800 text-sm leading-snug">Materi<br>Interaktif</h3>
                </a>

                <!-- Kartu 2: Eksplorasi Virtual -->
                <a href="{{ url('/exploration') }}" class="bg-white/95 hover:bg-white backdrop-blur-md rounded-2xl p-4 shadow-md hover:shadow-lg transition flex flex-col items-center text-center group">
                    <div class="w-10 h-10 rounded-full bg-green-50 text-[#2E7D32] flex items-center justify-center mb-2 group-hover:scale-110 transition">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-800 text-sm leading-snug">Eksplorasi<br>Virtual</h3>
                </a>

                <!-- Kartu 3: Misi Pelestarian -->
                <a href="{{ url('/missions') }}" class="bg-white/95 hover:bg-white backdrop-blur-md rounded-2xl p-4 shadow-md hover:shadow-lg transition flex flex-col items-center text-center group">
                    <div class="w-10 h-10 rounded-full bg-green-50 text-[#2E7D32] flex items-center justify-center mb-2 group-hover:scale-110 transition">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M21 6H3c-1.1 0-2 .9-2 2v8c0 1.1.9 2 2 2h18c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2zm-10 7H8v3H6v-3H3v-2h3V8h2v3h3v2zm4.5 2c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zm4-3c-.83 0-1.5-.67-1.5-1.5S18.67 9 19.5 9s1.5.67 1.5 1.5-.67 1.5-1.5 1.5z"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-800 text-sm leading-snug">Misi<br>Pelestarian</h3>
                </a>

                <!-- Kartu 4: Kuis & Evaluasi -->
                <a href="{{ url('/quiz') }}" class="bg-white/95 hover:bg-white backdrop-blur-md rounded-2xl p-4 shadow-md hover:shadow-lg transition flex flex-col items-center text-center group">
                    <div class="w-10 h-10 rounded-full bg-green-50 text-[#2E7D32] flex items-center justify-center mb-2 group-hover:scale-110 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-800 text-sm leading-snug">Kuis &<br>Evaluasi</h3>
                </a>

            </div>
        </div>
    </section>

</body>
</html>