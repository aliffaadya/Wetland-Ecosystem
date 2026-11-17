<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Misi 2: Atasi Pencemaran Air — Wetland Explorer</title>

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

<body class="bg-[#F6F8F5] text-gray-800 antialiased flex flex-col min-h-screen">

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

  <!-- KONTEN UTAMA MISI 2 -->
  <main class="flex-grow max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8 w-full"
        x-data="{
          step: 1,
          xp: 0,
          waterQuality: 30,

          // Tantangan 1: Pilihan Ganda (A-E)
          q1Selected: null,
          q1Done: false,
          q1Correct: false,
          q1Options: [
            { id: 'a', text: 'Meningkatkan populasi ikan lokal karena mendapat tambahan suplai makanan organik dari limbah.' },
            { id: 'b', text: 'Menurunkan kadar oksigen terlarut (DO) di dalam air yang menyebabkan kematian massal ikan dan biota air.' },
            { id: 'c', text: 'Membuat air sungai menjadi jernih secara alami karena partikel sampah menyerap kotoran.' },
            { id: 'd', text: 'Mempercepat pertumbuhan tanaman air eceng gondok hingga menyerap seluruh kandungan racun tanpa batas.' },
            { id: 'e', text: 'Menjaga suhu air tetap stabil sepanjang tahun meskipun terjadi pencemaran limbah berat.' }
          ],
          answerQ1(id) {
            if (this.q1Done) return;
            this.q1Selected = id;
            this.q1Done = true;
            if (id === 'b') {
              this.q1Correct = true;
              this.xp += 50;
              this.waterQuality = 65;
            }
          },

          // Tantangan 2: Benar / Salah
          q2Done: false,
          q2Correct: false,
          answerQ2(choice) {
            if (this.q2Done) return;
            this.q2Done = true;
            if (choice === true) {
              this.q2Correct = true;
              this.xp += 50;
              this.waterQuality = 100;
            }
          }
        }">

    <!-- Header & HUD -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
      <a href="{{ url('/missions') }}" class="inline-flex items-center gap-2 text-sm font-bold text-gray-600 hover:text-[#284b3b] transition">
        <span>&larr; Kembali ke Daftar Misi</span>
      </a>

      <div class="flex items-center gap-3 bg-white px-4 py-2.5 rounded-2xl shadow-sm border border-blue-100">
        <div class="flex items-center gap-2">
          <span class="text-xs font-bold text-gray-500">Kualitas Air Sungai:</span>
          <div class="w-24 h-2.5 bg-gray-200 rounded-full overflow-hidden">
            <div class="h-full transition-all duration-500 rounded-full"
                 :class="waterQuality < 50 ? 'bg-amber-600' : 'bg-blue-600'"
                 :style="'width: ' + waterQuality + '%'"></div>
          </div>
          <span class="text-xs font-extrabold text-blue-700" x-text="waterQuality + '%'"></span>
        </div>
        <span class="text-gray-300">|</span>
        <div class="flex items-center gap-1 text-xs font-extrabold text-amber-600">
          <i class="fa-solid fa-star"></i>
          <span x-text="xp + ' XP'"></span>
        </div>
      </div>
    </div>

    <!-- Judul & Studi Kasus -->
    <div class="bg-white rounded-2xl p-6 md:p-7 shadow-sm border border-blue-100 mb-6">
      <div class="flex items-center justify-between flex-wrap gap-3 mb-4">
        <div class="flex items-center gap-3.5">
          <div class="w-12 h-12 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center shadow-sm flex-shrink-0">
            <i class="fa-solid fa-water text-xl"></i>
          </div>
          <div>
            <span class="text-xs font-extrabold text-blue-600 uppercase tracking-wider">Misi 2 — Studi Kasus Interaktif</span>
            <h1 class="text-xl md:text-2xl font-extrabold text-[#1d382d]">Atasi Pencemaran Air Sungai</h1>
          </div>
        </div>

        <div class="flex items-center gap-2">
          <span class="px-3 py-1 rounded-full text-xs font-extrabold" :class="step === 1 ? 'bg-blue-600 text-white' : 'bg-blue-100 text-blue-800'">1. Analisis Dampak</span>
          <span class="px-3 py-1 rounded-full text-xs font-extrabold" :class="step === 2 ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-400'">2. Studi Pustaka</span>
        </div>
      </div>

      <div class="bg-blue-50/60 border-l-4 border-blue-600 p-4 rounded-r-xl">
        <h2 class="text-sm font-extrabold text-blue-900 mb-1">
          Kasus Lapangan: Penurunan Kualitas Air Sungai di Permukiman Rawa
        </h2>
        <p class="text-gray-700 text-xs md:text-sm leading-relaxed m-0 font-medium">
          Sungai di kawasan rawa mengalami pencemaran berat akibat tumpukan sampah plastik dan limbah cair rumah tangga yang dibuang langsung tanpa pengolahan. Hal ini memicu penurunan drastis kandungan oksigen terlarut. Selesaikan tantangan berikut untuk memulihkan ekosistem perairan!
        </p>
      </div>
    </div>

    <!-- TAHAP 1: PILIHAN GANDA (A-E) -->
    <div x-show="step === 1" class="bg-white rounded-2xl p-6 md:p-8 shadow-sm border border-blue-100">
      <div class="inline-block bg-blue-50 text-blue-700 text-xs font-extrabold px-3 py-1 rounded-lg mb-3">
        Tantangan 1 • Pilihan Ganda (A–E)
      </div>
      <h3 class="text-base md:text-lg font-extrabold text-gray-900 mb-5">
        Apa dampak langsung dari pembuangan limbah organik dan sampah rumah tangga secara terus-menerus terhadap ekosistem perairan sungai?
      </h3>

      <div class="space-y-3 mb-6">
        <template x-for="opt in q1Options" :key="opt.id">
          <button @click="answerQ1(opt.id)"
                  :class="{
                    'border-gray-200 bg-white hover:border-blue-300 hover:bg-blue-50/30': !q1Done,
                    'border-blue-600 bg-blue-50 text-blue-900 font-bold': q1Done && opt.id === 'b',
                    'border-red-500 bg-red-50 text-red-900': q1Done && q1Selected === opt.id && opt.id !== 'b',
                    'border-gray-200 bg-white opacity-55': q1Done && q1Selected !== opt.id && opt.id !== 'b'
                  }"
                  class="w-full text-left p-4 rounded-xl border-2 transition flex items-start gap-3.5">
            <span class="w-7 h-7 rounded-full font-extrabold text-xs flex items-center justify-center flex-shrink-0 uppercase"
                  :class="q1Done && opt.id === 'b' ? 'bg-blue-600 text-white' : (q1Done && q1Selected === opt.id ? 'bg-red-500 text-white' : 'bg-gray-100 text-gray-700')"
                  x-text="opt.id"></span>
            <span class="text-sm font-semibold text-gray-700 leading-snug" x-text="opt.text"></span>
          </button>
        </template>
      </div>

      <template x-if="q1Done">
        <div class="p-5 rounded-xl border"
             :class="q1Correct ? 'bg-blue-50 border-blue-200 text-blue-900' : 'bg-orange-50 border-orange-200 text-orange-900'">
          <h4 class="font-extrabold text-base mb-1" x-text="q1Correct ? 'Benar Sekali! (+50 XP)' : 'Kurang Tepat!'"></h4>
          <p class="text-sm leading-relaxed mb-4" x-text="q1Correct ? 'Limbah organik memicu mikroorganisme pengurai berkembang pesat yang mengonsumsi oksigen terlarut secara masif, mengakibatkan kematian biota air.' : 'Pilihan tersebut tidak sesuai dengan prinsip pencemaran lingkungan perairan.'"></p>
          
          <template x-if="!q1Correct">
            <button @click="q1Done = false; q1Selected = null;" class="bg-orange-600 text-white font-bold text-xs px-4 py-2.5 rounded-xl">Coba Lagi</button>
          </template>
          <template x-if="q1Correct">
            <button @click="step = 2" class="bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm px-5 py-2.5 rounded-xl shadow transition">Lanjut ke Sumber & Studi Pustaka &rarr;</button>
          </template>
        </div>
      </template>
    </div>

    <!-- TAHAP 2: VALIDASI STUDI PUSTAKA & SUMBER ILMIAH -->
    <div x-show="step === 2" class="bg-white rounded-2xl p-6 md:p-8 shadow-sm border border-blue-100">
      <div class="inline-block bg-green-50 text-[#2E7D32] text-xs font-extrabold px-3 py-1 rounded-lg mb-3">
        Tantangan 2 • Verifikasi Referensi & Sumber Ilmiah
      </div>
      <h3 class="text-base md:text-lg font-extrabold text-gray-900 mb-3">
        Apakah pernyataan berikut didukung oleh literatur ilmiah mengenai kualitas air lahan basah?
      </h3>

      <div class="bg-gray-50 border border-gray-200 rounded-2xl p-5 mb-5">
        <p class="text-sm md:text-base font-bold text-gray-800 italic mb-3">
          "Penurunan kadar Oksigen Terlarut (Dissolved Oxygen / DO) di bawah ambang batas normal akibat limbah domestik dapat menyebabkan terjadinya eutrofikasi dan kematian organisme akuatik."
        </p>
        <div class="text-xs text-gray-600 space-y-1 bg-white p-3 rounded-xl border border-gray-100">
          <p class="font-bold text-[#2E7D32]">📚 Referensi / Sumber Ilmiah:</p>
          <p>• <strong>Effendi, H. (2003).</strong> <em>Telaah Kualitas Air: Bagi Pengelolaan Sumber Daya dan Lingkungan Perairan.</em> Penerbit Kanisius.</p>
          <p>• <strong>Peraturan Pemerintah Republik Indonesia Nomor 22 Tahun 2021</strong> tentang Penyelenggaraan Perlindungan dan Pengelolaan Lingkungan Hidup (Lampiran Baku Mutu Air).</p>
        </div>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
        <button @click="answerQ2(true)"
                class="p-4 rounded-2xl border-2 font-extrabold text-sm border-gray-200 hover:border-blue-500 hover:bg-blue-50/40 transition">
          ✅ Ya, Pernyataan Valid Sesuai Sumber
        </button>
        <button @click="answerQ2(false)"
                class="p-4 rounded-2xl border-2 font-extrabold text-sm border-gray-200 hover:border-red-500 hover:bg-red-50/40 transition">
          ❌ Tidak Sesuai Literatur
        </button>
      </div>

      <template x-if="q2Done">
        <div class="p-5 rounded-xl border bg-green-50 border-green-200 text-green-900">
          <h4 class="font-extrabold text-base mb-1">Hebat! Misi 2 Selesai 100%! (+50 XP)</h4>
          <p class="text-sm leading-relaxed mb-4">
            Kamu telah berhasil menyelesaikan studi kasus dan memverifikasi sumber literatur pencemaran air sungai lahan basah.
          </p>
          <a href="{{ url('/missions') }}" 
             @click="localStorage.setItem('mission_2_completed', 'true')"
             class="inline-flex items-center gap-2 bg-[#2E7D32] hover:bg-[#1B5E20] text-white font-extrabold text-sm px-6 py-3 rounded-xl shadow transition">
            <span>Selesaikan & Buka Misi 3 &rarr;</span>
          </a>
        </div>
      </template>
    </div>

  </main>

  <footer class="bg-white border-t border-gray-200 py-5 text-center text-xs text-gray-500 mt-auto">
    <p>© {{ date('Y') }} <strong>Wetland Explorer</strong>. Media Pembelajaran Ekosistem Lahan Basah.</p>
  </footer>

</body>

</html>