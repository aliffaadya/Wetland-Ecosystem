# Wetland Explorer — Panduan Struktur Project

Project ini tetap menggunakan konfigurasi dasar Laravel 12 yang sudah ada. Perubahan pada paket perapihan ini difokuskan pada tampilan landing page, pengelompokan halaman, dan dokumentasi struktur.

## Struktur folder penting

```text
Wetland_Ecosystem/
├── app/                       # Kode backend Laravel
├── bootstrap/                 # Bootstrap aplikasi Laravel (jangan diubah sembarangan)
├── config/                    # Konfigurasi Laravel (dipertahankan)
├── database/
│   └── migrations/            # Migrasi database
├── public/
│   ├── css/
│   │   ├── wetland-landing.css # CSS khusus landing page baru
│   │   └── ...                 # CSS aset portal lama, dipertahankan sementara
│   ├── images/
│   │   └── wetland-hero.svg    # Ilustrasi lokal landing page
│   ├── js/                     # JavaScript lama, belum dihapus agar tidak merusak fitur
│   └── vendor/                 # Aset frontend vendor
├── resources/
│   └── views/
│       ├── auth/               # Tampilan login dan registrasi (preview)
│       ├── pages/              # Halaman fitur pembelajaran
│       ├── student/            # Dashboard siswa (preview)
│       ├── materials/          # Tempat komponen/halaman materi jika diperlukan
│       └── archive/legacy/     # Halaman lama yang tidak dipakai pada alur baru
├── routes/
│   └── web.php                 # Daftar URL halaman
└── PANDUAN-STRUKTUR.md
```

## Halaman aktif saat ini

| URL | View | Keterangan |
|---|---|---|
| `/` | `pages.home` | Landing page Wetland Explorer |
| `/login` | `auth.login` | Tampilan login sementara |
| `/register` | `auth.register` | Tampilan registrasi sementara |
| `/dashboard` | `student.dashboard` | Pratinjau dashboard siswa |
| `/tutorial` | `pages.tutorial` | Halaman materi, masih perlu adaptasi konten |
| `/exploration` | `pages.exploration` | Eksplorasi virtual, masih perlu adaptasi konten |
| `/missions` | `pages.missions` | Misi pelestarian, masih perlu adaptasi konten |
| `/quiz` | `pages.quiz` | Kuis evaluasi, masih perlu adaptasi konten |

## Status autentikasi — penting

- Pemeriksaan `composer.json` menunjukkan Laravel Breeze **belum tercantum sebagai dependency**.
- Halaman `/login` dan `/register` yang disiapkan dalam paket ini baru berupa rancangan antarmuka.
- Form belum memproses kredensial, belum membuat akun, dan belum mengelola session.
- `/dashboard` juga masih berupa pratinjau dan belum dilindungi middleware autentikasi.
- Jangan gunakan tampilan preview ini untuk akun atau data sungguhan. Tahap berikutnya adalah memasang dan mengonfigurasi Laravel Breeze, lalu menghubungkan dashboard dengan akun siswa.

## Menjalankan project

Dari folder project:

```powershell
php artisan serve
```

Buka `http://127.0.0.1:8000`.

Jika dependency belum tersedia, jalankan `composer install` terlebih dahulu sesuai kondisi project. Jangan mengganti file `.env` lokal yang sudah berisi konfigurasi database dan `APP_KEY`.

## Catatan perubahan

- File konfigurasi di `config/`, `.env.example`, `composer.json`, `composer.lock`, `package.json`, dan `vite.config.js` tidak diubah.
- File `.env` lokal sengaja tidak disertakan dalam arsip distribusi karena dapat berisi kredensial database dan APP_KEY. Pertahankan `.env` yang sudah ada di komputer.
- Halaman HTML lama yang tidak masuk alur siswa dipindahkan ke `resources/views/archive/legacy/`, bukan dihapus permanen.
- Aset CSS/JavaScript lama belum dibersihkan seluruhnya agar tidak ada ketergantungan yang terhapus tanpa pemeriksaan.
