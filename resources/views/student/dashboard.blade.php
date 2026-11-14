<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Siswa — Wetland Explorer</title>
    <link rel="stylesheet" href="{{ asset('css/wetland-landing.css') }}">
    <style>
        body{background:#f5f7ef}
        .dash-wrap{width:min(1180px,calc(100% - 40px));margin:38px auto 70px}
        .dash-top{display:flex;justify-content:space-between;align-items:center;gap:16px;margin:26px 0}
        .dash-top h1{font-size:34px;letter-spacing:-1px;margin:0 0 5px}
        .muted{color:#647269}
        .stats{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin:26px 0}
        .stat,.panel,.module{background:#fff;border:1px solid #dce5d8;border-radius:18px;padding:22px}
        .stat strong{display:block;font:800 30px 'Manrope',sans-serif;color:#284b3b}
        .stat span{font-size:13px;color:#647269}
        .progress{height:10px;background:#e8eee5;border-radius:99px;overflow:hidden;margin:12px 0}
        .progress span{display:block;width:35%;height:100%;background:#6f966d;border-radius:99px}
        .modules{display:grid;grid-template-columns:repeat(2,1fr);gap:14px}
        .module h3{font:750 17px 'Manrope',sans-serif;color:#284b3b;margin:8px 0}
        .module p{font-size:13px;color:#647269;margin:0}
        .table-wrap{overflow:auto} table{width:100%;border-collapse:collapse;margin-top:12px;font-size:14px}
        th,td{text-align:left;padding:12px;border-bottom:1px solid #e6ece3}th{color:#647269;font-size:12px}
        .tag{padding:4px 9px;background:#edf3e9;color:#426a49;border-radius:99px;font-size:12px}
        @media(max-width:700px){.stats,.modules{grid-template-columns:1fr}.dash-top{align-items:flex-start;flex-direction:column}}
    </style>
</head>
<body>
    <header class="site-header"><div class="header-inner">
        <a class="brand" href="{{ url('/') }}"><span class="brand-mark">♧</span><span>Wetland Explorer</span></a>
        <a class="header-login" href="{{ url('/login') }}">Keluar</a>
    </div></header>
    <main class="dash-wrap">
        <div class="dash-top">
            <div><span class="section-kicker">RUANG BELAJAR SISWA</span><h1>Dashboard Belajar</h1><p class="muted">Pantau perjalanan belajarmu di Wetland Explorer.</p></div>
            <span class="tag">Pratinjau antarmuka</span>
        </div>
        <section class="stats">
            <article class="stat"><strong>0%</strong><span>Progress pembelajaran</span></article>
            <article class="stat"><strong>0</strong><span>Latihan diselesaikan</span></article>
            <article class="stat"><strong>—</strong><span>Nilai kuis terakhir</span></article>
        </section>
        <section class="panel">
            <h2 style="font:750 20px 'Manrope',sans-serif;color:#284b3b;margin:0">Progress Materi</h2>
            <p class="muted">Progress akan diperbarui berdasarkan materi yang telah diselesaikan.</p>
            <div class="progress"><span></span></div><small class="muted">0 dari seluruh materi selesai · data contoh tampilan</small>
        </section>
        <h2 style="font:750 22px 'Manrope',sans-serif;color:#284b3b;margin:30px 0 14px">Mulai aktivitas belajar</h2>
        <section class="modules">
            <a class="module" href="{{ url('/tutorial') }}"><span class="feature-icon">▤</span><h3>Materi Pembelajaran</h3><p>Pelajari materi ekosistem lahan basah.</p></a>
            <a class="module" href="{{ url('/exploration') }}"><span class="feature-icon">⌖</span><h3>Eksplorasi Virtual</h3><p>Kenali flora dan fauna lahan basah.</p></a>
            <a class="module" href="{{ url('/missions') }}"><span class="feature-icon">♧</span><h3>Misi Pelestarian</h3><p>Selesaikan tantangan menjaga lingkungan.</p></a>
            <a class="module" href="{{ url('/quiz') }}"><span class="feature-icon">✓</span><h3>Kuis Evaluasi</h3><p>Uji pemahamanmu terhadap materi.</p></a>
        </section>
        <section class="panel" style="margin-top:26px">
            <h2 style="font:750 20px 'Manrope',sans-serif;color:#284b3b;margin:0">Riwayat Nilai</h2>
            <p class="muted">Nilai latihan dan kuis akan muncul di tabel ini setelah integrasi database.</p>
            <div class="table-wrap"><table><thead><tr><th>Aktivitas</th><th>Tanggal</th><th>Nilai</th><th>Status</th></tr></thead>
            <tbody><tr><td colspan="4" class="muted">Belum ada hasil belajar yang tersimpan.</td></tr></tbody></table></div>
        </section>
        <p class="muted" style="font-size:12px;margin-top:18px">Catatan: dashboard ini masih pratinjau antarmuka. Data progress dan nilai belum terhubung ke database.</p>
    </main>
</body>
</html>
