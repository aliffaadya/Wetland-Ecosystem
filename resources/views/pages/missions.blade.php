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
    body {
      background: #F6F8F5;
      font-family: 'Manrope', Arial, sans-serif;
      color: #202b25;
      margin: 0;
    }
  </style>
</head>

<body class="bg-[#F6F8F5] text-gray-800 antialiased flex flex-col min-h-screen"
      x-data="{ 
        isMission1Done: localStorage.getItem('mission_1_completed') === 'true',
        isMission2Done: localStorage.getItem('mission_2_completed') === 'true',
        isMission3Done: localStorage.getItem('mission_3_completed') === 'true'
      }">

  <!-- NAVBAR WETLAND EXPLORER -->
  <nav class="bg-white/95 backdrop-blur-sm shadow-sm sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between items-center h-16">
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

        <div class="hidden md:flex items-center space-x-8 text-sm font-medium">
          <a href="{{ route('home') }}" class="text-gray-600 hover:text-[#2E7D32] transition">Beranda</a>
          <a href="{{ url('/tutorial') }}" class="text-gray-600 hover:text-[#2E7D32] transition">Materi</a>
          <a href="{{ url('/exploration') }}" class="text-gray-600 hover:text-[#2E7D32] transition">Eksplorasi</a>
          <a href="{{ url('/missions') }}" class="text-[#1B5E20] font-bold border-b-2 border-[#2E7D32] pb-1">Misi</a>
          <a href="{{ url('/quiz') }}" class="text-gray-600 hover:text-[#2E7D32] transition">Kuis</a>
          <a href="{{ route('home') }}#tentang" class="text-gray-600 hover:text-[#2E7D32] transition">Tentang</a>
        </div>

        <div class="flex items-center gap-2">
          @auth
            <a href="{{ route('dashboard') }}" class="flex items-center gap-2 px-3 py-1.5 rounded-full bg-green-50 hover:bg-green-100 text-[#1B5E20] font-semibold text-xs transition">
              <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                <path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/>
              </svg>
              <span>{{ Auth::user()->name }}</span>
            </a>
          @endauth
        </div>
      </div>
    </div>
  </nav>

  <!-- KONTEN UTAMA HALAMAN MISI -->
  <main class="flex-grow max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8 w-full">
    
    <div class="flex items-center gap-3 mb-5">
      <div class="w-10 h-10 rounded-xl bg-green-100 text-[#2E7D32] flex items-center justify-center shadow-sm">
        <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24">
          <path d="M17 8C8 10 5.9 16.17 3.82 21.34l1.89.66.95-2.3c.48.17.98.3 1.34.3C19 20 22 3 22 3c-1 2-8 2.25-13 3.25S2 11.5 2 13.5s1.75 3.75 1.75 3.75C7 8 17 8 17 8Z"/>
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
            <circle cx="120" cy="125" r="95" fill="#FFFFFF" fill-opacity="0.35"/>
            <path d="M84 148L76 210H164L156 148H84Z" fill="#795548"/>
            <path d="M72 215C72 178 90 158 120 158C150 158 168 178 168 215H72Z" fill="#A1887F"/>
            <path d="M104 158L120 182L136 158H104Z" fill="#EFEBE9"/>
            <rect x="88" y="182" width="20" height="22" rx="3" fill="#8D6E63"/>
            <rect x="132" y="182" width="20" height="22" rx="3" fill="#8D6E63"/>
            <path d="M98 156C106 168 134 168 142 156L136 174L120 166L104 174L98 156Z" fill="#2E7D32"/>
            <rect x="110" y="136" width="20" height="24" rx="8" fill="#FFCCBC"/>
            <circle cx="120" cy="108" r="36" fill="#FFCCBC"/>
            <path d="M84 104C84 78 100 66 120 66C140 66 156 78 156 104C152 88 138 82 120 82C102 82 88 88 84 104Z" fill="#3E2723"/>
            <ellipse cx="120" cy="76" rx="54" ry="12" fill="#6D4C41"/>
            <path d="M90 76C90 54 104 44 120 44C136 44 150 54 150 76H90Z" fill="#8D6E63"/>
            <rect x="90" y="68" width="60" height="6" fill="#2E7D32"/>
            <circle cx="107" cy="108" r="4" fill="#212121"/>
            <circle cx="133" cy="108" r="4" fill="#212121"/>
            <circle cx="108" cy="107" r="1.5" fill="#FFFFFF"/>
            <circle cx="134" cy="107" r="1.5" fill="#FFFFFF"/>
            <path d="M111 122C115 127 125 127 129 122" stroke="#5D4037" stroke-width="3.5" stroke-linecap="round"/>
            <circle cx="99" cy="116" r="4.5" fill="#FF8A65" fill-opacity="0.5"/>
            <circle cx="141" cy="116" r="4.5" fill="#FF8A65" fill-opacity="0.5"/>
            <circle cx="176" cy="164" r="12" fill="#FFCCBC"/>
            <path d="M156 174L174 164" stroke="#A1887F" stroke-width="14" stroke-linecap="round"/>
          </svg>
        </div>

        <!-- Balon Pesan -->
        <div class="relative bg-white/95 backdrop-blur-sm text-gray-800 p-6 rounded-2xl shadow-lg max-w-sm border border-green-100">
          <div class="hidden md:block absolute -left-3 top-1/2 -translate-y-1/2 w-0 h-0 border-t-[10px] border-t-transparent border-b-[10px] border-b-transparent border-r-[12px] border-r-white/95"></div>
          
          <h2 class="text-lg md:text-xl font-extrabold text-[#1B5E20] mb-1.5"
              x-text="isMission1Done ? 'Luar Biasa! Misi 1 Selesai!' : 'Ayo selesaikan misi!'"></h2>
          <p class="text-gray-700 text-sm md:text-base leading-relaxed font-medium"
             x-text="isMission1Done ? 'Misi 2 kini telah terbuka! Silakan lanjutkan petualangan.' : 'Bantu selamatkan lahan basah dari ancaman kerusakan.'"></p>
        </div>

      </div>

      <!-- 3 Kartu Misi -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-5 relative z-10">
        
        <!-- Misi 1: Selesai / Ulangi -->
        <a href="{{ url('/missions/fire-prevention') }}" class="bg-white/95 hover:bg-white rounded-2xl p-5 shadow-md hover:shadow-xl transform hover:-translate-y-1 transition flex flex-col items-center text-center relative border-2 border-[#388E3C] group">
          <div class="w-12 h-12 rounded-2xl bg-orange-100 text-orange-600 flex items-center justify-center mb-3 group-hover:scale-110 transition">
            <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="M13.5.67s.74 2.65.74 4.8c0 2.06-1.35 3.73-3.41 3.73-2.07 0-3.63-1.67-3.63-3.73l.03-.36C5.21 7.51 4 10.62 4 14c0 4.42 3.58 8 8 8s8-3.58 8-8C20 8.61 17.41 3.8 13.5.67z"/></svg>
          </div>
          <span class="text-xs font-extrabold text-gray-500 uppercase tracking-wider">Misi 1</span>
          <h3 class="text-base font-extrabold text-gray-900 mt-0.5 mb-4">Cegah Kebakaran Gambut</h3>
          
          <div class="mt-auto w-full flex items-center justify-between pt-2 border-t border-gray-100">
            <span class="text-xs font-bold text-[#2E7D32]" x-text="isMission1Done ? 'Selesai (Ulangi) →' : 'Mulai Misi →'"></span>
            <span class="w-6 h-6 rounded-full bg-[#388E3C] text-white flex items-center justify-center shadow-sm">
              <i class="fa-solid fa-check text-xs" x-show="isMission1Done"></i>
              <i class="fa-solid fa-play text-[9px] ml-0.5" x-show="!isMission1Done"></i>
            </span>
          </div>
        </a>

        <!-- Misi 2: Dinamis (Terkunci / Terbuka berdasarkan isMission1Done) -->
        <div class="rounded-2xl p-5 shadow-md flex flex-col items-center text-center relative transition"
             :class="isMission1Done ? 'bg-white/95 border-2 border-blue-500 hover:shadow-xl cursor-pointer group' : 'bg-white/90 border border-gray-200 opacity-90 cursor-not-allowed'">
          
          <div class="w-12 h-12 rounded-2xl bg-blue-100 text-blue-500 flex items-center justify-center mb-3"
               :class="isMission1Done ? 'group-hover:scale-110 transition' : ''">
            <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="M12 2c-5.33 4.55-8 8.48-8 11.8 0 4.98 3.8 8.2 8 8.2s8-3.22 8-8.2c0-3.32-2.67-7.25-8-11.8z"/></svg>
          </div>
          <span class="text-xs font-extrabold uppercase tracking-wider" :class="isMission1Done ? 'text-blue-600' : 'text-gray-400'">Misi 2</span>
          <h3 class="text-base font-extrabold mt-0.5 mb-4" :class="isMission1Done ? 'text-gray-900' : 'text-gray-700'">Atasi Pencemaran Air</h3>
          
          <div class="mt-auto pt-2 w-full">
            <template x-if="isMission1Done">
              <a href="{{ url('/missions/water-pollution') }}" class="w-full flex items-center justify-between pt-2 border-t border-gray-100 text-xs font-bold text-blue-700">
                <span>Mulai Misi →</span>
                <span class="w-6 h-6 rounded-full bg-blue-600 text-white flex items-center justify-center text-xs">
                  <i class="fa-solid fa-play text-[9px] ml-0.5"></i>
                </span>
              </a>
            </template>
            <template x-if="!isMission1Done">
              <span class="w-7 h-7 rounded-full bg-gray-200 text-gray-600 inline-flex items-center justify-center text-xs">
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
    <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="M17 8C8 10 5.9 16.17 3.82 21.34l1.89.66.95-2.3c.48.17.98.3 1.34.3C19 20 22 3 22 3c-1 2-8 2.25-13 3.25S2 11.5 2 13.5s1.75 3.75 1.75 3.75C7 8 17 8 17 8Z"/></svg>
  </div>
  <span class="text-xs font-extrabold uppercase tracking-wider" :class="isMission2Done ? 'text-green-700' : 'text-gray-400'">Misi 3</span>
  <h3 class="text-base font-extrabold mt-0.5 mb-4" :class="isMission2Done ? 'text-gray-900' : 'text-gray-700'">Pulihkan Ekosistem</h3>
  
  <div class="mt-auto pt-2 w-full">
    <template x-if="isMission2Done">
      <a href="{{ url('/missions/ecosystem-restoration') }}" class="w-full flex items-center justify-between pt-2 border-t border-gray-100 text-xs font-bold text-green-800">
        <span x-text="isMission3Done ? 'Selesai (Ulangi) →' : 'Mulai Misi →'"></span>
        <span class="w-6 h-6 rounded-full bg-[#2E7D32] text-white flex items-center justify-center text-xs">
          <i class="fa-solid fa-check text-xs" x-show="isMission3Done"></i>
          <i class="fa-solid fa-play text-[9px] ml-0.5" x-show="!isMission3Done"></i>
        </span>
      </a>
    </template>
    <template x-if="!isMission2Done">
      <span class="w-7 h-7 rounded-full bg-gray-200 text-gray-600 inline-flex items-center justify-center text-xs">
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

</body>

</html>