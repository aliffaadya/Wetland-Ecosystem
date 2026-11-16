# Laporan Penyempurnaan Eksplorasi Virtual

Tanggal: 16 November 2026

## Perubahan

- Mempertahankan layout, warna, foto utama, panel edukasi Bekantan, dan posisi hotspot pada foto.
- Progres kini selalu dimulai dari `0 dari 3` pada pemuatan halaman baru dan hanya disimpan selama halaman terbuka.
- Kunjungan pertama pada hotspot unik menaikkan progres satu kali; hotspot yang dibuka berulang tidak menambah hitungan.
- Pesan eksplorasi selesai muncul ketika ketiga hotspot sudah dibuka.
- Popup tetap memiliki judul, gambar, deskripsi, ciri, dan peran objek; bisa ditutup lewat tombol, Escape, atau klik di luar panel.

## Hasil pengujian

| Pemeriksaan | Status | Hasil |
|---|---|---|
| Hotspot 1, 2, 3 membuka popup yang sesuai | PASS | Tes JavaScript menyimulasikan ketiganya dan memeriksa judul, gambar, deskripsi, ciri, dan peran. |
| Popup ditutup dengan tombol, Escape, dan backdrop | PASS | Ketiga jalur diuji dalam simulasi DOM, termasuk fokus kembali ke hotspot. |
| Progres awal dan kunjungan unik | PASS | Pemuatan baru mulai 0/3; buka ulang hotspot yang sama tidak menaikkan hitungan. |
| Pesan penyelesaian | PASS | Muncul setelah hotspot berbeda ketiga dibuka. |
| Penanda visual hotspot | PASS | Tes memeriksa kelas `visited` diterapkan setelah dibuka. |
| Foto utama dan tiga foto pendukung | PASS | Tes Laravel memastikan keempat berkas tersedia dan dapat dibaca sebagai gambar. |
| Posisi responsif | PASS pada pemeriksaan kode | Foto memakai lebar penuh dengan tinggi proporsional; hotspot menggunakan posisi persentase dalam pembungkus relatif. Tampilan aktual pada beragam viewport belum diuji di browser. |
| Route dan render Laravel | PASS | Tes fitur `WetlandExplorationTest`: 1 tes, 17 assertion. |
| Sintaks JavaScript | PASS | Skrip inline lolos `node --check`; tes simulasi JavaScript: 3 tes, 0 gagal. |
| `npm run build` | Tidak dijalankan | Perubahan hanya pada template Blade inline dan tidak menyentuh bundle Vite. |

Tes JavaScript menjalankan handler halaman dengan DOM tiruan di Node, bukan browser visual sungguhan. Karena itu, ukuran dan posisi akhir di desktop, tablet, dan ponsel belum dikonfirmasi lewat render browser.

## File yang diubah

- `resources/views/pages/exploration.blade.php` — progres per halaman, pesan selesai, popup, dan responsivitas.
- `tests/Feature/WetlandExplorationTest.php` — pemeriksaan render route dan foto lokal.
- `tests/js/exploration.test.mjs` — simulasi interaksi hotspot, popup, progres, dan pemeriksaan aturan CSS responsif.
