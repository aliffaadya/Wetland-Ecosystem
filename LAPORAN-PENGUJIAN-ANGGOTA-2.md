# Laporan Pengembangan dan Pengujian Anggota 2

Tanggal: 16 November 2026

## Fitur yang dikembangkan

- Eksplorasi virtual memakai ilustrasi ekosistem lokal, tiga hotspot berposisi relatif terhadap gambar, animasi pulsa dan popup. Informasi hotspot merujuk materi pada `public/js/data-tutorials.js`; popup memakai gambar rujukan materi bila tersedia dan menyembunyikannya bila gagal dimuat. Tombol, klik area luar, dan tombol Escape menutup popup.
- Progress eksplorasi menghitung objek unik yang pernah dibuka, tersimpan di localStorage, dan memberi warna berbeda pada hotspot yang sudah dikunjungi.
- Kuis evaluasi berisi 15 soal yang dipilih langsung dari latihan penutup enam bab: 3 + 3 + 2 + 2 + 2 + 3 soal. Bunyi soal, pilihan, kunci, dan pembahasan dipertahankan dari sumber materi. Kuis menyediakan navigasi nomor, pilihan jawaban tersimpan saat berpindah soal, indikator aktif/terjawab/belum terjawab, dan progress berdasarkan jumlah jawaban terisi.
- Submit ditolak jika jawaban belum lengkap dan siswa diarahkan ke soal kosong dengan informasi jumlah yang perlu dilengkapi. Jika lengkap, ada konfirmasi sebelum submit.
- Laravel melakukan validasi dan penilaian. Kunci jawaban tidak dikirim pada halaman kuis. Halaman hasil memuat nilai, jumlah benar/salah, jawaban siswa, kunci, dan pembahasan. Tombol ulangi membuka sesi kosong tanpa memakai jawaban atau skor sebelumnya.
- Kedua tombol kembali mengarah ke `/dashboard`.

## Hasil pengujian

Status PASS hanya diberikan untuk pengujian yang benar-benar dijalankan. NOT RUN berarti pengujian interaktif/visual tidak dapat dijalankan pada sesi ini.

| Fitur | Pemeriksaan | Status | Bukti / catatan |
|---|---|---|---|
| Eksplorasi | Route halaman dan render ilustrasi serta tiga hotspot | PASS | Tes Laravel HTTP: 200; aset SVG dan ketiga hotspot ditemukan. |
| Eksplorasi | Membuka popup tiap hotspot, informasi objek cocok | NOT RUN | Kode dan sumber materi ditinjau; interaksi klik browser belum dijalankan. |
| Eksplorasi | Tutup popup melalui tombol, backdrop, dan Escape | NOT RUN | Handler ada; belum diverifikasi dalam browser. |
| Eksplorasi | Animasi hotspot dan popup | NOT RUN | Animasi CSS diterapkan; belum diamati secara visual. |
| Eksplorasi | Progress bertambah sekali per objek dan status visited | NOT RUN | Logika localStorage/keunikan ditinjau; belum diuji melalui interaksi browser. |
| Eksplorasi | Posisi hotspot saat ukuran layar berubah | NOT RUN | Koordinat memakai persentase pada pembungkus gambar dan ada media query; viewport belum diuji secara visual. |
| Kuis | Halaman tampil dan kunci tidak dikirim ke klien | PASS | Tes Laravel GET menemukan 15 soal dan memastikan properti kunci tidak ada di HTML. |
| Kuis | Semua pilihan, navigasi, pilihan tersimpan, nomor aktif | NOT RUN | Perilaku antarmuka belum dijalankan dalam browser. |
| Kuis | Progress menunjukkan jumlah soal terjawab | NOT RUN | Logika menghitung jawaban terisi, bukan nomor aktif; belum diverifikasi interaktif. |
| Kuis | Submit kosong ditolak | PASS | Tes POST tidak lengkap diarahkan kembali dengan error validasi. |
| Kuis | Penilaian otomatis, skor penuh dan nol | PASS | Tes server: semua benar menghasilkan 100/100; semua salah menghasilkan 0/100. |
| Kuis | Hasil dan pembahasan | PASS | Respons hasil server mencakup skor dan review; isi pembahasan berasal dari bank soal berbasis materi. |
| Kuis | Ulangi menghapus jawaban dan skor lama | NOT RUN | Tombol kembali ke GET kuis baru tanpa state skor; interaksi ulang belum dijalankan di browser. |
| Laravel | Route GET/POST kuis | PASS | `php artisan route:list --path=quiz` menampilkan `quiz.index` dan `quiz.submit`. |
| Laravel | Error saat render/submit | PASS | Lima tes fitur Laravel (20 assertion) lulus tanpa exception. Direktori log belum memiliki berkas log saat dicek. |
| JavaScript | Sintaks skrip inline | PASS | `node --check` lulus untuk skrip kedua halaman. |
| JavaScript | Error runtime di console browser | NOT RUN | Sesi browser automation tidak tersedia; console tidak dapat diperiksa. |
| Responsif | CSS desktop/tablet/ponsel | NOT RUN | Aturan responsif dan reduced-motion tersedia; tidak diuji dengan viewport browser. |
| Build | Build produksi | PASS | `npm.cmd run build`: Vite 7.3.8 sukses, 61 modul diproses. |

## Bug yang ditemukan dan perbaikan

- `/exploration` sebelumnya merender template Playground yang tidak terkait fitur. Diganti dengan halaman eksplorasi Wetland Explorer.
- `/quiz` sebelumnya merender template kuis HTML Learning Portal dan tidak memakai materi lahan basah. Diganti dengan 15 soal dari latihan akhir enam bab materi sesuai permintaan terbaru.
- Kunci jawaban kuis kini disimpan di konfigurasi server; penilaian dilakukan Laravel.
- Progress lama bukan penghitung eksplorasi unik dan interaksi kuis belum memiliki navigasi nomor maupun validasi pengumpulan lengkap. Keduanya ditambahkan.

## File dibuat atau diubah

- `resources/views/pages/exploration.blade.php` — tampilan, popup, hotspot, animasi, dan progress eksplorasi.
- `resources/views/pages/quiz.blade.php` — antarmuka kuis, navigasi, progress, hasil, dan pembahasan.
- `routes/web.php` — route bernama GET kuis dan endpoint POST pengumpulan.
- `app/Http/Controllers/QuizController.php` — penyedia soal publik, validasi kiriman, dan penilaian server.
- `config/wetland_quiz.php` — bank soal, pilihan, kunci, dan penjelasan di sisi server.
- `tests/Feature/QuizEvaluationTest.php` — pengujian kunci, skor penuh/nol, dan validasi jawaban kosong.
- `tests/Feature/WetlandExplorationTest.php` — pengujian render halaman, ilustrasi, dan tiga hotspot.
- `LAPORAN-PENGUJIAN-ANGGOTA-2.md` — laporan ini.

`package.json` dan `package-lock.json` berstatus berubah/tidak terlacak sebelum pekerjaan ini; tidak diubah sebagai bagian pekerjaan Anggota 2.

## Kendala yang belum terselesaikan

Pengujian klik langsung, console browser, dan pemeriksaan visual pada beberapa ukuran layar belum dapat dijalankan karena sesi browser automation tidak tersedia. Gambar objek pada popup menggunakan URL gambar yang sudah tercantum pada materi tutorial; ketersediaan jaringan gambar eksternal belum diuji.

