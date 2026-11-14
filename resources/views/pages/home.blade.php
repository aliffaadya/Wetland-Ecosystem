<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Wetland Explorer adalah media pembelajaran interaktif untuk mengenal ekosistem lahan basah.">
    <meta name="theme-color" content="#f5f7ef">
    <title>Wetland Explorer — Jelajahi Ekosistem Lahan Basah</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('css/wetland-landing.css') }}">
</head>
<body>
    <header class="site-header">
        <div class="header-inner">
            <a class="brand" href="{{ url('/') }}" aria-label="Wetland Explorer, beranda">
                <span class="brand-mark" aria-hidden="true">♧</span>
                <span>Wetland Explorer</span>
            </a>
            <a class="header-login" href="{{ url('/login') }}">Masuk</a>
        </div>
    </header>

    <main>
        <section class="hero">
            <div class="hero-copy">
                <span class="eyebrow"><span class="eyebrow-dot"></span> MEDIA PEMBELAJARAN INTERAKTIF</span>
                <h1>Jelajahi Keindahan <span>Ekosistem Lahan Basah</span></h1>
                <p class="hero-description">
                    Kenali keanekaragaman flora dan fauna, pahami peran ekosistem lahan basah,
                    dan temukan cara menjaga kelestariannya melalui pengalaman belajar yang interaktif.
                </p>
                <div class="hero-actions">
                    <a class="button button-primary" href="{{ url('/login') }}">Mulai Belajar <span aria-hidden="true">→</span></a>
                    <a class="button button-secondary" href="#tentang">Kenali Wetland Explorer</a>
                </div>
                <div class="hero-points" aria-label="Keunggulan pembelajaran">
                    <span><i>✓</i> Materi interaktif</span>
                    <span><i>✓</i> Eksplorasi flora dan fauna</span>
                    <span><i>✓</i> Evaluasi hasil belajar</span>
                </div>
            </div>
            <div class="hero-art">
                <img src="{{ asset('images/wetland-hero.svg') }}" alt="Ilustrasi ekosistem lahan basah dengan sungai, pepohonan, dan burung">
                <div class="art-caption">
                    <span class="caption-icon">✦</span>
                    <span><strong>Belajar dari alam</strong><small>Kenali, pahami, dan lestarikan</small></span>
                </div>
            </div>
        </section>

        <section class="intro" id="tentang">
            <div class="intro-heading">
                <span class="section-kicker">TENTANG PLATFORM</span>
                <h2>Belajar lingkungan dengan cara yang lebih dekat dan menyenangkan.</h2>
            </div>
            <p>
                Wetland Explorer mengajak siswa mempelajari ekosistem lahan basah melalui materi,
                eksplorasi virtual, misi pelestarian, dan kuis evaluasi dalam satu pengalaman belajar.
            </p>
        </section>

        <section class="feature-strip" aria-label="Fitur pembelajaran">
            <article class="feature">
                <span class="feature-number">01</span>
                <span class="feature-icon">▤</span>
                <h3>Materi Pembelajaran</h3>
                <p>Pelajari konsep dan karakteristik ekosistem lahan basah secara bertahap.</p>
            </article>
            <article class="feature">
                <span class="feature-number">02</span>
                <span class="feature-icon">⌖</span>
                <h3>Eksplorasi Virtual</h3>
                <p>Temukan objek flora dan fauna melalui gambar interaktif dan informasi singkat.</p>
            </article>
            <article class="feature">
                <span class="feature-number">03</span>
                <span class="feature-icon">♧</span>
                <h3>Misi Pelestarian</h3>
                <p>Hadapi kasus lingkungan dan pilih tindakan yang tepat untuk menjaga lahan basah.</p>
            </article>
            <article class="feature">
                <span class="feature-number">04</span>
                <span class="feature-icon">✓</span>
                <h3>Kuis Evaluasi</h3>
                <p>Uji pemahaman dan lihat hasil evaluasi setelah menyelesaikan pembelajaran.</p>
            </article>
        </section>
    </main>

    <footer class="site-footer">
        <span>© {{ date('Y') }} Wetland Explorer</span>
        <span>Belajar · Eksplorasi · Lestarikan</span>
    </footer>
</body>
</html>
