<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Misi 3: Pulihkan Ekosistem — Wetland Explorer</title>

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

    body, button, input, textarea, select {
      font-family: 'Manrope', Arial, sans-serif !important;
    }

    /* Penyesuaian tampilan Misi 3 agar konsisten dengan Misi 1, Misi 2, dan Tutorial */
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

    .mission-stepper {
      display: flex;
      align-items: center;
      flex-wrap: wrap;
      gap: .5rem;
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

      .mission-hud-label {
        font-size: .7rem;
      }

      .mission-stepper {
        gap: .35rem;
      }
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

  <!-- KONTEN UTAMA MISI 3 -->
  <main class="flex-grow max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8 w-full"
        x-data="{
          step: 1,
          xp: 0,
          biodiversity: 35,

          // Tantangan 1: Pilihan Ganda (A-E)
          q1Selected: null,
          q1Done: false,
          q1Correct: false,
          q1Options: [
            { id: 'a', text: 'Melakukan reboisasi atau penanaman kembali vegetasi asli rawa (seperti pohon rambai dan galam) serta melindungi kawasan jelajah satwa.' },
            { id: 'b', text: 'Mengonversi seluruh sisa hutan rawa menjadi kawasan industri agar penduduk sekitar memiliki fasilitas modern.' },
            { id: 'c', text: 'Membangun pagar tembok tinggi di sekeliling hutan tanpa menanam pohon tambahan agar satwa tidak keluar.' },
            { id: 'd', text: 'Memindahkan seluruh populasi Bekantan ke kebun binatang kota tanpa memperhatikan ketersediaan pakan alaminya.' },
            { id: 'e', text: 'Membiarkan lahan terbuka tanpa tindakan apapun karena alam dapat pulih sendiri secara instan.' }
          ],
          answerQ1(id) {
            if (this.q1Done) return;
            this.q1Selected = id;
            this.q1Done = true;
            if (id === 'a') {
              this.q1Correct = true;
              this.xp += 60;
              this.biodiversity = 70;
            }
          },

          // Tantangan 2: Studi Pustaka & Verifikasi Sumber
          q2Done: false,
          q2Correct: false,
          answerQ2(choice) {
            if (this.q2Done) return;
            this.q2Done = true;
            if (choice === true) {
              this.q2Correct = true;
              this.xp += 60;
              this.biodiversity = 100;
            }
          }
        }">

    <!-- Header & HUD -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
      <a href="{{ url('/missions') }}" class="inline-flex items-center px-4 py-2 rounded-lg bg-gray-200 text-sm font-bold text-gray-700 hover:bg-gray-300 hover:text-gray-900 transition self-start">
        Kembali
      </a>

      <div class="mission-hud flex items-center gap-3 bg-white px-4 py-2.5 rounded-2xl shadow-sm border border-green-100">
        <div class="flex items-center gap-2">
          <span class="mission-hud-label text-xs font-bold text-gray-500">Indeks Biodiversitas:</span>
          <div class="w-24 h-2.5 bg-gray-200 rounded-full overflow-hidden">
            <div class="h-full transition-all duration-500 rounded-full bg-[#2E7D32]"
                 :style="'width: ' + biodiversity + '%'"></div>
          </div>
          <span class="text-xs font-extrabold text-[#2E7D32]" x-text="biodiversity + '%'"></span>
        </div>
        <span class="text-gray-300">|</span>
        <div class="flex items-center gap-1 text-xs font-extrabold text-amber-600">
          <i class="fa-solid fa-star"></i>
          <span x-text="xp + ' XP'"></span>
        </div>
      </div>
    </div>

    <!-- Judul & Studi Kasus -->
    <div class="bg-white rounded-2xl p-4 sm:p-5 md:p-7 shadow-sm border border-green-100 mb-6">
      <div class="flex items-start sm:items-center justify-between flex-wrap gap-3 mb-4">
        <div class="flex items-center gap-3.5">
          <div class="w-12 h-12 rounded-xl bg-green-100 text-[#2E7D32] flex items-center justify-center shadow-sm flex-shrink-0">
            <i class="fa-solid fa-seedling text-xl"></i>
          </div>
          <div>
            <span class="text-xs font-extrabold text-green-700 uppercase tracking-wider">Misi 3 — Konservasi Habitat</span>
            <h1 class="text-xl md:text-2xl font-extrabold text-[#1d382d]">Pulihkan Ekosistem & Satwa Endemik</h1>
          </div>
        </div>

        <div class="flex items-center gap-2">
          <span class="px-3 py-1 rounded-full text-xs font-extrabold" :class="step === 1 ? 'bg-[#2E7D32] text-white' : 'bg-green-100 text-[#2E7D32]'">1. Strategi Restorasi</span>
          <span class="px-3 py-1 rounded-full text-xs font-extrabold" :class="step === 2 ? 'bg-[#2E7D32] text-white' : 'bg-gray-100 text-gray-400'">2. Referensi Ilmiah</span>
        </div>
      </div>

      <div class="bg-green-50/70 border-l-4 border-[#2E7D32] p-4 rounded-r-xl">
        <h2 class="text-sm font-extrabold text-[#1B5E20] mb-1">
          Kasus Lapangan: Berkurangnya Populasi Bekantan Akibat Alih Fungsi Lahan
        </h2>
        <p class="text-gray-700 text-xs md:text-sm leading-relaxed m-0 font-medium">
          Kawasan hutan rawa banjiran mengalami degradasi parah, menyebabkan hilangnya pohon rambai (pakan utama Bekantan) dan terfragmentasinya habitat satwa liar endemik Kalimantan. Selesaikan tantangan pemulihan ini untuk mengembalikan keseimbangan ekosistem!
        </p>
      </div>
    </div>

    <!-- TAHAP 1: PILIHAN GANDA (A-E) -->
    <div x-show="step === 1" class="bg-white rounded-2xl p-4 sm:p-5 md:p-8 shadow-sm border border-green-100">
      <div class="inline-block bg-green-50 text-[#2E7D32] text-xs font-extrabold px-3 py-1 rounded-lg mb-3">
        Tantangan 1 • Pilihan Ganda (A–E)
      </div>
      <h3 class="mission-question">
        Langkah pemulihan ekosistem apa yang paling efektif dan berkelanjutan untuk mengembalikan habitat satwa liar seperti Bekantan di kawasan lahan basah?
      </h3>

      <div class="space-y-3 mb-6">
        <template x-for="opt in q1Options" :key="opt.id">
          <button @click="answerQ1(opt.id)"
                  :class="{
                    'border-gray-200 bg-white hover:border-green-400 hover:bg-green-50/30': !q1Done,
                    'border-green-600 bg-green-50 text-green-900 font-bold': q1Done && opt.id === 'a',
                    'border-red-500 bg-red-50 text-red-900': q1Done && q1Selected === opt.id && opt.id !== 'a',
                    'border-gray-200 bg-white opacity-55': q1Done && q1Selected !== opt.id && opt.id !== 'a'
                  }"
                  class="w-full text-left p-3.5 sm:p-4 rounded-xl border-2 transition flex items-start gap-3">
            <span class="w-7 h-7 rounded-full font-extrabold text-xs flex items-center justify-center flex-shrink-0 uppercase"
                  :class="q1Done && opt.id === 'a' ? 'bg-green-600 text-white' : (q1Done && q1Selected === opt.id ? 'bg-red-500 text-white' : 'bg-gray-100 text-gray-700')"
                  x-text="opt.id"></span>
            <span class="mission-option-text" x-text="opt.text"></span>
          </button>
        </template>
      </div>

      <template x-if="q1Done">
        <div class="p-5 rounded-xl border"
             :class="q1Correct ? 'bg-green-50 border-green-200 text-green-900' : 'bg-orange-50 border-orange-200 text-orange-900'">
          <h4 class="font-extrabold text-base mb-1" x-text="q1Correct ? 'Luar Biasa! (+60 XP)' : 'Kurang Tepat!'"></h4>
          <p class="text-sm leading-relaxed mb-4" x-text="q1Correct ? 'Reboisasi menggunakan tanaman asli rawa seperti pohon rambai (Sonneratia caseolaris) memulihkan sumber pakan dan tempat berlindung alami bagi Bekantan.' : 'Pilihan tersebut tidak mendukung konservasi jangka panjang satwa endemik.'"></p>
          
          <template x-if="!q1Correct">
            <button @click="q1Done = false; q1Selected = null;" class="bg-orange-600 text-white font-bold text-xs px-4 py-2.5 rounded-xl">Coba Lagi</button>
          </template>
          <template x-if="q1Correct">
            <button @click="step = 2" class="bg-[#2E7D32] hover:bg-[#1B5E20] text-white font-bold text-sm px-5 py-2.5 rounded-xl shadow transition">Lanjut ke Sumber & Literatur Ilmiah &rarr;</button>
          </template>
        </div>
      </template>
    </div>

    <!-- TAHAP 2: VALIDASI STUDI PUSTAKA & SUMBER ILMIAH -->
    <div x-show="step === 2" class="bg-white rounded-2xl p-4 sm:p-5 md:p-8 shadow-sm border border-green-100">
      <div class="inline-block bg-green-50 text-[#2E7D32] text-xs font-extrabold px-3 py-1 rounded-lg mb-3">
        Tantangan 2 • Verifikasi Referensi & Sumber Ilmiah
      </div>
      <h3 class="mission-question">
        Apakah pernyataan konservasi berikut didukung oleh literatur ekologi lahan basah?
      </h3>

      <div class="bg-gray-50 border border-gray-200 rounded-2xl p-5 mb-5">
        <p class="mission-option-text italic mb-3">
          "Konservasi bekantan (Nasalis larvatus) sangat bergantung pada kelestarian hutan riparian dan vegetasi mangrove/rawa seperti pohon rambai yang menjadi sumber pakan utamanya."
        </p>
        <div class="text-xs text-gray-600 space-y-1 bg-white p-3 rounded-xl border border-gray-100">
          <p class="font-bold text-[#2E7D32]">📚 Referensi / Sumber Ilmiah:</p>
          <p>• <strong>Meijaard, E., & Nijman, V. (2000).</strong> <em>Distribution and conservation of the proboscis monkey (Nasalis larvatus) in Kalimantan, Indonesia.</em> Biological Conservation.</p>
          <p>• <strong>Undang-Undang Republik Indonesia Nomor 5 Tahun 1990</strong> tentang Konservasi Sumber Daya Alam Hayati dan Ekosistemnya.</p>
        </div>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
        <button @click="answerQ2(true)"
                class="p-3.5 sm:p-4 rounded-2xl border-2 font-extrabold text-sm border-gray-200 hover:border-green-600 hover:bg-green-50/40 transition">
          ✅ Ya, Sesuai dengan Literatur Ilmiah
        </button>
        <button @click="answerQ2(false)"
                class="p-3.5 sm:p-4 rounded-2xl border-2 font-extrabold text-sm border-gray-200 hover:border-red-500 hover:bg-red-50/40 transition">
          ❌ Tidak Sesuai Literatur
        </button>
      </div>

      <template x-if="q2Done">
        <div class="p-5 rounded-xl border bg-green-50 border-green-200 text-green-900">
          <h4 class="font-extrabold text-base mb-1">Selamat! Seluruh Misi Pelestarian Selesai 100%! (+60 XP)</h4>
          <p class="text-sm leading-relaxed mb-4">
            Kamu telah menuntaskan rangkaian misi penyelamatan lahan basah dari kebakaran gambut, pencemaran air, hingga pemulihan ekosistem satwa endemik!
          </p>
          <a href="{{ url('/missions') }}" 
             @click="localStorage.setItem('mission_3_completed', 'true')"
             class="inline-flex items-center gap-2 bg-[#2E7D32] hover:bg-[#1B5E20] text-white font-extrabold text-sm px-6 py-3 rounded-xl shadow transition">
            <span>Selesaikan & Kembali ke Peta Misi Utama &rarr;</span>
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