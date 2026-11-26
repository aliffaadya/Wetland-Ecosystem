/* =========================================================
   WETLAND EXPLORER - YUK, PRAKTIK!
   Mini-game berbeda untuk Materi 1 sampai 6.
   Hanya menambahkan aktivitas praktik; tidak mengubah Yuk, Berlatih!.
   Semua visual memakai ikon/emoji saja (tanpa foto).
   ========================================================= */
(function () {
    "use strict";

    const DATA = {
        "mengenal-lahan-basah": {
            type: "sort", title: "Detektif Lahan Basah",
            subtitle: "Amati lingkungan, lalu tentukan kelompoknya.",
            instruction: "Pilih kartu lingkungan. Masukkan ke kelompok Lahan Basah atau Bukan Lahan Basah. Kamu boleh memindahkan kartu sebelum memeriksa hasil.",
            categories: [{ id: "wet", label: "Lahan Basah", icon: "💧" }, { id: "dry", label: "Bukan Lahan Basah", icon: "⛰️" }],
            items: [
                { id: "swamp", label: "Rawa", icon: "🪷", answer: "wet", why: "Rawa merupakan wilayah yang tanahnya sering atau selalu tergenang air." },
                { id: "mangrove", label: "Hutan mangrove", icon: "🌳", answer: "wet", why: "Mangrove tumbuh di kawasan pesisir berlumpur yang dipengaruhi pasang surut." },
                { id: "peat", label: "Lahan gambut", icon: "🌿", answer: "wet", why: "Lahan gambut memiliki tanah kaya bahan organik dan kondisi yang basah." },
                { id: "lake", label: "Danau", icon: "🏞️", answer: "wet", why: "Danau merupakan ekosistem perairan yang dapat menjadi bagian dari kawasan lahan basah." },
                { id: "desert", label: "Gurun pasir", icon: "🏜️", answer: "dry", why: "Gurun pasir umumnya memiliki kondisi sangat kering." },
                { id: "dryhill", label: "Bukit berbatu kering", icon: "⛰️", answer: "dry", why: "Bukit berbatu yang kering bukan contoh ekosistem lahan basah." }
            ]
        },

        "jenis-lahan-basah": {
            type: "match", title: "Jodohkan Jenis Lahan Basah",
            subtitle: "Pasangkan nama ekosistem dengan ciri-cirinya.",
            instruction: "Pilih satu nama di kolom kiri, lalu pilih satu ciri di kolom kanan. Tidak masalah jika pasanganmu belum tepat. Kamu boleh mengganti pasangan berkali-kali. Jawaban baru diperiksa setelah menekan Lihat Hasil.",
            leftTitle: "Jenis lahan basah", rightTitle: "Ciri-ciri",
            pairs: [
                { left: "Rawa", right: "Wilayah rendah yang tanahnya sering tergenang air.", why: "Rawa adalah wilayah yang mengalami genangan air secara alami." },
                { left: "Hutan mangrove", right: "Tumbuh di pesisir berlumpur dan dipengaruhi pasang surut.", why: "Mangrove beradaptasi dengan air payau, lumpur, dan perubahan pasang surut." },
                { left: "Lahan gambut", right: "Memiliki lapisan sisa tumbuhan yang terurai sangat lambat.", why: "Gambut terbentuk dari penumpukan sisa tumbuhan dalam kondisi basah." },
                { left: "Danau", right: "Genangan air luas di cekungan yang dikelilingi daratan.", why: "Danau merupakan kumpulan air di cekungan permukaan bumi." },
                { left: "Daerah sekitar sungai", right: "Dapat tergenang ketika aliran sungai meluap.", why: "Dataran sekitar sungai dapat menjadi basah saat terjadi luapan." }
            ]
        },

        "keanekaragaman-hayati": {
            type: "memory", title: "Memori Penghuni Lahan Basah",
            subtitle: "Temukan pasangan kartu makhluk hidup dan keterangannya.",
            instruction: "Buka dua kartu secara bergantian. Cari pasangan nama makhluk hidup dengan ciri atau habitatnya. Ini permainan memori, jadi petunjuk akan terbuka saat kartu dibalik.",
            cards: [
                { pair: "lotus", front: "🪷", label: "Teratai", back: "Tumbuhan air dengan daun yang dapat mengapung." },
                { pair: "waterhyacinth", front: "🌱", label: "Eceng gondok", back: "Tumbuhan air yang hidup mengapung di perairan." },
                { pair: "mangrove", front: "🌳", label: "Mangrove", back: "Tumbuhan yang beradaptasi di pesisir berlumpur." },
                { pair: "fish", front: "🐟", label: "Ikan", back: "Hewan yang hidup di lingkungan perairan." },
                { pair: "proboscis", front: "🐒", label: "Bekantan", back: "Satwa khas Kalimantan yang hidup di hutan sekitar perairan." }
            ]
        },

        "manfaat-lahan-basah": {
            type: "wordsearch",
            title: "Berburu Kata Manfaat Lahan Basah",
            subtitle: "Temukan kata-kata tersembunyi di dalam kotak huruf!",
            instruction: "Cari kata yang tersedia pada daftar. Klik huruf pertama lalu huruf terakhir kata secara berurutan dalam satu garis lurus. Kata dapat tersusun mendatar, menurun, atau diagonal.",
            words: ["HABITAT", "KARBON", "AIR", "PANGAN", "IKAN", "PESISIR"]
        },

        "permasalahan-lahan-basah": {
            type: "chain",
            title: "Rantai Permasalahan Lahan Basah",
            subtitle: "Susun kartu menjadi hubungan penyebab, permasalahan, dan dampak.",
            instruction: "Pada setiap tantangan, pilih tiga kartu sesuai urutan: Penyebab → Permasalahan → Dampak. Kartu akan diberi nomor sesuai urutan pilihanmu. Kamu dapat membatalkan pilihan dan menyusun ulang sebelum menekan Periksa Jawaban.",
            chains: [
                {
                    title: "Tantangan 1 · Pencemaran Air",
                    cards: [
                        { id: "waste", role: "Penyebab", text: "Sampah dan limbah dibuang ke sungai." },
                        { id: "pollution", role: "Permasalahan", text: "Air sungai mengalami pencemaran." },
                        { id: "aquatic", role: "Dampak", text: "Kualitas air menurun dan biota perairan terganggu." }
                    ],
                    explanation: "Sampah dan limbah yang masuk ke sungai dapat mencemari air serta mengganggu kehidupan organisme perairan."
                },
                {
                    title: "Tantangan 2 · Kebakaran Gambut",
                    cards: [
                        { id: "burning", role: "Penyebab", text: "Lahan gambut dibuka dengan cara dibakar." },
                        { id: "peatfire", role: "Permasalahan", text: "Terjadi kebakaran pada lahan gambut." },
                        { id: "smoke", role: "Dampak", text: "Kabut asap muncul dan habitat makhluk hidup rusak." }
                    ],
                    explanation: "Pembakaran untuk membuka lahan dapat memicu kebakaran gambut yang menghasilkan asap dan merusak habitat."
                },
                {
                    title: "Tantangan 3 · Kerusakan Mangrove",
                    cards: [
                        { id: "cutmangrove", role: "Penyebab", text: "Pohon mangrove ditebang secara berlebihan." },
                        { id: "mangroveloss", role: "Permasalahan", text: "Kawasan hutan mangrove mengalami kerusakan." },
                        { id: "coast", role: "Dampak", text: "Perlindungan pantai berkurang dan risiko abrasi meningkat." }
                    ],
                    explanation: "Mangrove membantu melindungi garis pantai. Jika kawasan mangrove rusak, pantai lebih rentan mengalami abrasi."
                },
                {
                    title: "Tantangan 4 · Lahan Gambut Mengering",
                    cards: [
                        { id: "drain", role: "Penyebab", text: "Saluran drainase mengeringkan lahan gambut." },
                        { id: "drypeat", role: "Permasalahan", text: "Kondisi tanah gambut menjadi kering." },
                        { id: "easilyburn", role: "Dampak", text: "Lahan gambut menjadi lebih mudah terbakar." }
                    ],
                    explanation: "Gambut yang kehilangan banyak air menjadi kering sehingga lebih rentan terbakar."
                }
            ]
        },

        "pelestarian-lahan-basah": {
            type: "sequence", title: "Susun Misi Pelestarian",
            subtitle: "Atur langkah sederhana untuk menjaga lahan basah.",
            instruction: "Urutkan langkah kegiatan berikut agar menjadi rencana aksi yang masuk akal. Gunakan tombol panah untuk memindahkan langkah, lalu tekan Periksa Urutan.",
            steps: [
                { id: "observe", text: "Mengamati kondisi kawasan dan menemukan masalah.", icon: "🔎" },
                { id: "plan", text: "Merencanakan kegiatan bersama warga atau teman.", icon: "📝" },
                { id: "act", text: "Melaksanakan aksi, misalnya membersihkan sampah atau menanam mangrove di lokasi sesuai.", icon: "🌱" },
                { id: "care", text: "Memantau hasil dan menjaga kawasan secara berkelanjutan.", icon: "🤝" }
            ],
            explanation: "Pelestarian dimulai dengan mengenali kondisi, merencanakan kegiatan, melakukan aksi, lalu memantau dan merawat hasilnya."
        }
    };

    const state = {};
    const $ = (sel, root = document) => root.querySelector(sel);
    const esc = value => String(value ?? "").replace(/[&<>"']/g, c => ({ "&": "&amp;", "<": "&lt;", ">": "&gt;", '"': "&quot;", "'": "&#39;" }[c]));
    const shuffle = arr => { const a = arr.slice(); for (let i = a.length - 1; i > 0; i--) { const j = Math.floor(Math.random() * (i + 1));[a[i], a[j]] = [a[j], a[i]]; } return a; };

    function getState(id, cfg) {
        if (!state[id]) {
            const s = { checked: false, feedback: "" };
            if (cfg.type === "sort") { s.assign = {}; s.selected = null; s.order = shuffle(cfg.items); }
            if (cfg.type === "match") { s.matches = {}; s.selectedLeft = null; s.rightOrder = shuffle(cfg.pairs.map((p, i) => i)); }
            if (cfg.type === "memory") { const deck = []; cfg.cards.forEach((c, i) => { deck.push({ id: i * 2, pair: c.pair, face: c.front, label: c.label, kind: "name" }); deck.push({ id: i * 2 + 1, pair: c.pair, face: "❔", label: c.back, kind: "detail" }); }); s.deck = shuffle(deck); s.open = []; s.found = []; }
            if (cfg.type === "scenario" || cfg.type === "detective") s.answers = {};
            if (cfg.type === "sequence") s.order = shuffle(cfg.steps.map((x, i) => i));
            if (cfg.type === "wordsearch") {
                s.grid = makeWordGrid(cfg.words);
                s.found = [];
                s.first = null;
                s.lastPath = [];
            }
            if (cfg.type === "chain") {
                s.chains = cfg.chains.map(chain => ({
                    order: shuffle(chain.cards.map((card, index) => index)),
                    selected: []
                }));
                s.checked = false;
            }
            state[id] = s;
        }
        return state[id];
    }

    function resultBox(title, lines, good) {
        return `<div class="wp-result ${good ? "good" : "review"}"><strong>${title}</strong><ul>${lines.map(x => `<li>${x}</li>`).join("")}</ul></div>`;
    }
    function renderSort(cfg, s) {
        const remaining = s.order.filter(x => !s.assign[x.id]);
        const placed = Object.keys(s.assign).length;
        return `<div class="wp-progress"><span>${placed}/${cfg.items.length} kartu dikelompokkan</span><div><i style="width:${placed / cfg.items.length * 100}%"></i></div></div>
      <div class="wp-cardgrid">${remaining.map(x => `<button class="wp-card ${s.selected === x.id ? "selected" : ""}" data-item="${x.id}" ${s.checked ? "disabled" : ""}><span class="wp-emoji">${x.icon}</span><b>${esc(x.label)}</b><small>${s.selected === x.id ? "Terpilih" : "Pilih kartu"}</small></button>`).join("")}</div>
      <div class="wp-bins">${cfg.categories.map(cat => {
            const arr = cfg.items.filter(x => s.assign[x.id] === cat.id);
            return `<div class="wp-bin"><h4>${cat.icon} ${cat.label} <small>${arr.length}</small></h4><div class="wp-chips">${arr.map(x => `<span>${x.icon} ${esc(x.label)} <button data-remove="${x.id}" aria-label="Keluarkan ${esc(x.label)}">×</button></span>`).join("") || "<small>Belum ada kartu</small>"}</div><button class="wp-secondary" data-category="${cat.id}" ${!s.selected || s.checked ? "disabled" : ""}>Tempatkan kartu terpilih</button></div>`;
        }).join("")}</div>
      ${s.checked ? resultBox(`${cfg.items.filter(x => s.assign[x.id] === x.answer).length} dari ${cfg.items.length} jawaban tepat`, cfg.items.map(x => `${s.assign[x.id] === x.answer ? "✓" : "✕"} ${esc(x.label)} — ${esc(cfg.categories.find(c => c.id === x.answer).label)}. ${esc(x.why)}`), cfg.items.every(x => s.assign[x.id] === x.answer)) : ""}
      ${actions(s, placed === cfg.items.length, "Periksa Hasil")}`;
    }

    function renderMatch(cfg, s) {
        const assignedRight = Object.values(s.matches);
        return `<div class="wp-progress"><span>${Object.keys(s.matches).length}/${cfg.pairs.length} pasangan diisi</span><div><i style="width:${Object.keys(s.matches).length / cfg.pairs.length * 100}%"></i></div></div>
      <div class="wp-match"><div><h4>${cfg.leftTitle}</h4>${cfg.pairs.map((p, i) => `<button class="wp-matchbtn ${s.selectedLeft === i ? "selected" : ""} ${s.matches[i] !== undefined ? "paired" : ""}" data-left="${i}" ${s.checked ? "disabled" : ""}>${p.icon} ${esc(p.left)}<small>${s.matches[i] !== undefined ? "Sudah dipasangkan" : "Pilih nama ini"}</small></button>`).join("")}</div>
      <div><h4>${cfg.rightTitle}</h4>${s.rightOrder.map(i => `<button class="wp-matchbtn ${assignedRight.includes(i) ? "paired" : ""}" data-right="${i}" ${s.checked || s.selectedLeft === null ? "" : ""}>${esc(cfg.pairs[i].right)}<small>${assignedRight.includes(i) ? "Sudah dipilih" : "Pilih ciri ini"}</small></button>`).join("")}</div></div>
      <p class="wp-note">Pasangan yang kamu buat tidak langsung dinilai. Pilih lagi nama di kiri untuk mengganti pasangannya.</p>
      ${s.checked ? resultBox(`${cfg.pairs.filter((p, i) => s.matches[i] === i).length} dari ${cfg.pairs.length} pasangan tepat`, cfg.pairs.map((p, i) => `${s.matches[i] === i ? "✓" : "✕"} ${esc(p.left)} — ${esc(p.right)}. ${esc(p.why)}`), cfg.pairs.every((p, i) => s.matches[i] === i)) : ""}
      ${actions(s, Object.keys(s.matches).length === cfg.pairs.length, "Lihat Hasil")}`;
    }

    function renderMemory(cfg, s) {
        return `<div class="wp-progress"><span>${s.found.length}/${cfg.cards.length} pasangan ditemukan</span><div><i style="width:${s.found.length / cfg.cards.length * 100}%"></i></div></div>
      <div class="wp-memory">${s.deck.map(c => {
            const open = s.open.includes(c.id) || s.found.includes(c.pair);
            return `<button class="wp-memorycard ${open ? "flipped" : ""} ${s.found.includes(c.pair) ? "found" : ""}" data-memory="${c.id}" ${s.found.includes(c.pair) || s.open.includes(c.id) ? "disabled" : ""}><span>${open ? esc(c.kind === "name" ? c.face : c.label) : "❔"}</span></button>`;
        }).join("")}</div>
      <p class="wp-note">${s.found.length === cfg.cards.length ? "Semua pasangan ditemukan! Hebat!" : "Buka dua kartu untuk mencari pasangan nama dan keterangannya."}</p>
      ${s.found.length === cfg.cards.length ? resultBox("Permainan selesai!", ["Kamu berhasil menemukan seluruh pasangan makhluk hidup dan cirinya."], true) : ""}
      <div class="wp-actions"><button class="wp-primary" data-reset>Acak dan Ulangi</button></div>`;
    }

    function renderChoice(cfg, s, type) {
        const answers = s.answers;
        const done = Object.keys(answers).length === cfg[type === "scenario" ? "scenarios" : "cases"].length;
        const arr = cfg[type === "scenario" ? "scenarios" : "cases"];
        return `<div class="wp-scenarios">${arr.map((x, i) => `<article class="wp-scenario"><div class="wp-scenario-head"><span>${x.icon}</span><b>${type === "scenario" ? "Situasi" : "Kasus"} ${i + 1}</b></div><p>${esc(x.q)}</p><div class="wp-options">${x.options.map((o, j) => `<button data-answer="${i}:${j}" class="${answers[i] === j ? "chosen" : ""}" ${s.checked ? "disabled" : ""}>${String.fromCharCode(65 + j)}. ${esc(o)}</button>`).join("")}</div></article>`).join("")}</div>
      ${s.checked ? resultBox(`${arr.filter((x, i) => answers[i] === x.answer).length} dari ${arr.length} jawaban tepat`, arr.map((x, i) => `${answers[i] === x.answer ? "✓" : "✕"} ${type === "scenario" ? "Situasi" : "Kasus"} ${i + 1}: ${esc(x.options[x.answer])}. ${esc(x.why)}`), arr.every((x, i) => answers[i] === x.answer)) : ""}
      ${actions(s, done, "Periksa Jawaban")}`;
    }

    function makeWordGrid(words) {
        const size = 9;
        const grid = Array.from({ length: size }, () => Array(size).fill(""));
        const dirs = [[0, 1], [1, 0], [1, 1], [-1, 1]];

        words.forEach(word => {
            let success = false;
            for (let attempt = 0; attempt < 300 && !success; attempt++) {
                const [dr, dc] = dirs[Math.floor(Math.random() * dirs.length)];
                const r = Math.floor(Math.random() * size);
                const c = Math.floor(Math.random() * size);
                const endR = r + dr * (word.length - 1);
                const endC = c + dc * (word.length - 1);
                if (endR < 0 || endR >= size || endC < 0 || endC >= size) continue;

                let fits = true;
                for (let i = 0; i < word.length; i++) {
                    const existing = grid[r + dr * i][c + dc * i];
                    if (existing && existing !== word[i]) { fits = false; break; }
                }
                if (!fits) continue;
                for (let i = 0; i < word.length; i++)grid[r + dr * i][c + dc * i] = word[i];
                success = true;
            }
        });

        const letters = "ABCDEFGHIKLMNOPRSTUW";
        for (let r = 0; r < size; r++) {
            for (let c = 0; c < size; c++) {
                if (!grid[r][c]) grid[r][c] = letters[Math.floor(Math.random() * letters.length)];
            }
        }
        return grid;
    }

    function renderWordSearch(cfg, s) {
        const size = s.grid.length;
        return `<div class="wp-wordsearch-top">
      <div><strong>${s.found.length}/${cfg.words.length}</strong><span> kata ditemukan</span></div>
      <div class="wp-wordlist">${cfg.words.map(word => `<span class="${s.found.includes(word) ? "found" : ""}">${s.found.includes(word) ? "✓ " : ""}${word}</span>`).join("")}</div>
    </div>
    <p class="wp-note">${s.first === null ? "Pilih huruf pertama kata." : "Sekarang pilih huruf terakhir kata pada satu garis lurus."}</p>
    <div class="wp-letter-grid" style="--grid-size:${size}">
      ${s.grid.map((row, r) => row.map((letter, c) => {
            const key = `${r}-${c}`;
            const marked = s.lastPath.includes(key);
            return `<button class="wp-letter ${marked ? "marked" : ""}" data-letter="${r}:${c}" ${s.found.length === cfg.words.length ? "disabled" : ""}>${letter}</button>`;
        }).join("")).join("")}
    </div>
    ${s.found.length === cfg.words.length ? resultBox("Semua kata berhasil ditemukan!", ["Kamu sudah menemukan seluruh manfaat lahan basah."], true) : ""}
    <div class="wp-actions"><button class="wp-secondary" data-word-reset>Acak Ulang Huruf</button></div>`;
    }

    function renderChain(cfg, s) {
        const completed = s.chains.filter((x, i) => x.order.every((v, j) => v === j)).length;

        return `<div class="wp-progress"><span>${completed}/${cfg.chains.length} tantangan tersusun benar</span><div><i style="width:${completed / cfg.chains.length * 100}%"></i></div></div>
      <div class="wp-chain-list">
      ${cfg.chains.map((chain, i) => {
            const progress = s.chains[i];
            const isCorrect = progress.order.every((v, j) => v === j);
            return `<article class="wp-chain-challenge">
          <div class="wp-chain-title"><span>${i + 1}</span><div><b>${esc(chain.title)}</b><small>Susun tiga kartu sesuai hubungan sebab-akibat</small></div></div>
          <div class="wp-chain-order"><span>PENYEBAB</span><i class="fa-solid fa-arrow-right"></i><span>PERMASALAHAN</span><i class="fa-solid fa-arrow-right"></i><span>DAMPAK</span></div>
          <div class="wp-chain-cards">
            ${progress.order.map((cardIndex, position) => {
                const card = chain.cards[cardIndex];
                const selected = progress.selected.includes(cardIndex);
                return `<button class="wp-chain-card ${selected ? "selected" : ""}" data-chain-card="${i}:${cardIndex}" ${s.checked ? "disabled" : ""}>
                <span class="wp-chain-number">${position + 1}</span>
                <small>${selected ? "DIPILIH" : "KARTU"}</small>
                <b>${esc(card.text)}</b>
              </button>`;
            }).join("")}
          </div>
          <div class="wp-chain-actions">
            <button class="wp-secondary" data-chain-up="${i}" ${s.checked || progress.selected.length !== 2 ? "disabled" : ""}>Tukar Urutan Pilihan</button>
            <button class="wp-secondary" data-chain-clear="${i}" ${s.checked || progress.selected.length === 0 ? "disabled" : ""}>Batalkan Pilihan</button>
          </div>
          ${s.checked ? `<div class="wp-chain-feedback ${isCorrect ? "correct" : "incorrect"}"><strong>${isCorrect ? "✓ Urutan benar!" : "✕ Urutan belum tepat."}</strong><p>${esc(chain.explanation)}</p><small>Urutan yang tepat:</small><p>${chain.cards.map((card, j) => `${j + 1}. ${esc(card.role)} — ${esc(card.text)}`).join("<br>")}</p></div>` : ""}
        </article>`;
        }).join("")}
      </div>
      ${s.checked ? resultBox(`${completed} dari ${cfg.chains.length} tantangan berhasil diselesaikan`, ["Pelajari kembali hubungan antara penyebab, permasalahan, dan dampak agar kamu memahami bagaimana kerusakan lingkungan lahan basah dapat terjadi."], completed === cfg.chains.length) : `<div class="wp-actions"><button class="wp-primary" data-chain-check>Periksa Jawaban</button><button class="wp-secondary" data-reset>Acak dan Ulangi</button></div>`}
      ${s.checked ? `<div class="wp-actions"><button class="wp-primary" data-reset>Coba Lagi</button></div>` : ""}`;
    }

    function renderSequence(cfg, s) {
        return `<ol class="wp-sequence">${s.order.map((idx, pos) => {
            const x = cfg.steps[idx];
            return `<li><span>${x.icon} ${esc(x.text)}</span><div><button data-move="${pos}:up" aria-label="Naikkan" ${s.checked || pos === 0 ? "disabled" : ""}>↑</button><button data-move="${pos}:down" aria-label="Turunkan" ${s.checked || pos === s.order.length - 1 ? "disabled" : ""}>↓</button></div></li>`;
        }).join("")}</ol>
      ${s.checked ? resultBox(s.order.every((x, i) => x === i) ? "Urutanmu sudah tepat!" : "Urutan masih perlu diperbaiki.", [esc(cfg.explanation), ...cfg.steps.map((x, i) => `${i + 1}. ${esc(x.text)}`)], s.order.every((x, i) => x === i)) : ""}
      ${actions(s, true, "Periksa Urutan")}`;
    }

    function actions(s, ready, label) {
        return `<div class="wp-actions"><button class="wp-primary" data-check ${!ready || s.checked ? "disabled" : ""}>${label}</button><button class="wp-secondary" data-reset>Ulangi</button></div>`;
    }

    function render(id) {
        const cfg = DATA[id], s = getState(id, cfg);
        let content = "";

        if (cfg.type === "sort") content = renderSort(cfg, s);
        if (cfg.type === "match") content = renderMatch(cfg, s);
        if (cfg.type === "memory") content = renderMemory(cfg, s);
        if (cfg.type === "scenario" || cfg.type === "detective") content = renderChoice(cfg, s, cfg.type);
        if (cfg.type === "wordsearch") content = renderWordSearch(cfg, s);
        if (cfg.type === "chain") content = renderChain(cfg, s);
        if (cfg.type === "sequence") content = renderSequence(cfg, s);

        const topic = (window.TUTORIALS_DATA?.topics || []).find(t => t.id === id);

        return `<section class="lesson-practice" id="lessonPractice" data-practice-topic="${id}">
      <div class="wp-heading">
        <span><i class="fa-solid fa-gamepad" aria-hidden="true"></i></span>
        <div>
          <h2>Yuk, Praktik!</h2>
        </div>
      </div>
      <div class="wp-game">
        <h3>${esc(cfg.title)}</h3>
        <p class="wp-subtitle">${esc(cfg.subtitle)}</p>
        <div class="wp-instruction"> ${esc(cfg.instruction)}</div>
        <div class="wp-body">${content}</div>
      </div>
    </section>`;
    }

    function currentId() {
        const q = new URLSearchParams(location.search).get("topic");
        if (q && DATA[q]) return q;

        const h = $("#tutContentBody .lesson-header h1");
        const m = h?.textContent.match(/(?:Materi|BAB)\s+(\d+)/i);

        if (m) {
            const t = (window.TUTORIALS_DATA?.topics || []).find(x => Number(x.number) === Number(m[1]));
            if (t && DATA[t.id]) return t.id;
        }

        return null;
    }

    function ensure() {
        const body = $("#tutContentBody");
        const exercise = $("#lessonExercise");
        if (!body || !exercise) return;

        const id = currentId();
        if (!id) return;

        const old = $("#lessonPractice", body);
        if (old?.dataset.practiceTopic === id) return;
        if (old) old.remove();

        exercise.insertAdjacentHTML("beforebegin", render(id));
    }

    function rerender(id) {
        const el = $("#lessonPractice");
        if (el?.dataset.practiceTopic === id) el.outerHTML = render(id);
    }

    function reset(id) {
        delete state[id];
        rerender(id);
    }

    function click(e) {
        const b = e.target.closest("button");
        if (!b) return;

        const section = b.closest("#lessonPractice");
        if (!section) return;

        const id = section.dataset.practiceTopic;
        const cfg = DATA[id];
        const s = state[id];

        if (!s || !cfg) return;

        if (b.hasAttribute("data-reset")) {
            reset(id);
            return;
        }

        if (s.checked) return;

        if (b.dataset.item) {
            s.selected = b.dataset.item;
            rerender(id);
            return;
        }

        if (b.dataset.category) {
            if (s.selected) {
                s.assign[s.selected] = b.dataset.category;
                s.selected = null;
            }
            rerender(id);
            return;
        }

        if (b.dataset.remove) {
            delete s.assign[b.dataset.remove];
            rerender(id);
            return;
        }

        if (b.dataset.left !== undefined) {
            s.selectedLeft = Number(b.dataset.left);
            rerender(id);
            return;
        }

        if (b.dataset.right !== undefined) {
            if (s.selectedLeft !== null) {
                const li = s.selectedLeft;
                const ri = Number(b.dataset.right);

                Object.keys(s.matches).forEach(k => {
                    if (s.matches[k] === ri) delete s.matches[k];
                });

                delete s.matches[li];
                s.matches[li] = ri;
                s.selectedLeft = null;
            }

            rerender(id);
            return;
        }

        if (b.dataset.memory !== undefined) {
            const card = s.deck.find(x => x.id === Number(b.dataset.memory));

            if (!card || s.open.length >= 2 || s.open.includes(card.id) || s.found.includes(card.pair)) return;

            s.open.push(card.id);

            if (s.open.length === 2) {
                const [a, c] = s.open.map(n => s.deck.find(x => x.id === n));

                if (a.pair === c.pair) {
                    s.found.push(a.pair);
                    s.open = [];
                    rerender(id);
                } else {
                    rerender(id);
                    setTimeout(() => {
                        if (!s.checked) {
                            s.open = [];
                            rerender(id);
                        }
                    }, 850);
                }
            } else {
                rerender(id);
            }

            return;
        }

        if (b.dataset.answer) {
            const [i, j] = b.dataset.answer.split(":").map(Number);
            s.answers[i] = j;
            rerender(id);
            return;
        }

        if (b.dataset.letter) {
            const [r, c] = b.dataset.letter.split(":").map(Number);

            if (s.first === null) {
                s.first = { r, c };
                s.lastPath = [`${r}-${c}`];
                rerender(id);
                return;
            }

            const dr = Math.sign(r - s.first.r);
            const dc = Math.sign(c - s.first.c);
            const distance = Math.max(Math.abs(r - s.first.r), Math.abs(c - s.first.c));

            if (distance === 0) {
                s.first = null;
                s.lastPath = [];
                rerender(id);
                return;
            }

            if (!(r === s.first.r || c === s.first.c || Math.abs(r - s.first.r) === Math.abs(c - s.first.c))) {
                s.first = { r, c };
                s.lastPath = [`${r}-${c}`];
                rerender(id);
                return;
            }

            const path = [];
            let word = "";

            for (let k = 0; k <= distance; k++) {
                const rr = s.first.r + dr * k;
                const cc = s.first.c + dc * k;
                path.push(`${rr}-${cc}`);
                word += s.grid[rr][cc];
            }

            const reverse = word.split("").reverse().join("");
            const target = cfg.words.find(w => !s.found.includes(w) && (w === word || w === reverse));

            if (target) s.found.push(target);

            s.first = null;
            s.lastPath = target ? path : [];
            rerender(id);
            return;
        }

        if (b.hasAttribute("data-word-reset")) {
            s.grid = makeWordGrid(cfg.words);
            s.found = [];
            s.first = null;
            s.lastPath = [];
            rerender(id);
            return;
        }

        if (b.dataset.chainCard !== undefined) {
            const [chainIndex, cardIndex] = b.dataset.chainCard.split(":").map(Number);
            const chainState = s.chains[chainIndex];

            if (!chainState) return;

            const selectedIndex = chainState.selected.indexOf(cardIndex);

            if (selectedIndex !== -1) {
                chainState.selected.splice(selectedIndex, 1);
            } else if (chainState.selected.length < 2) {
                chainState.selected.push(cardIndex);
            }

            rerender(id);
            return;
        }

        if (b.dataset.chainUp !== undefined) {
            const chainIndex = Number(b.dataset.chainUp);
            const chainState = s.chains[chainIndex];

            if (chainState && chainState.selected.length === 2) {
                const [first, second] = chainState.selected;
                const firstPosition = chainState.order.indexOf(first);
                const secondPosition = chainState.order.indexOf(second);

                [chainState.order[firstPosition], chainState.order[secondPosition]] =
                    [chainState.order[secondPosition], chainState.order[firstPosition]];

                chainState.selected = [];
            }

            rerender(id);
            return;
        }

        if (b.dataset.chainClear !== undefined) {
            const chainIndex = Number(b.dataset.chainClear);

            if (s.chains[chainIndex]) s.chains[chainIndex].selected = [];

            rerender(id);
            return;
        }

        if (b.hasAttribute("data-chain-check")) {
            s.checked = true;
            rerender(id);
            return;
        }

        if (b.hasAttribute("data-cross-check")) {
            s.checked = true;
            rerender(id);
            return;
        }

        if (b.dataset.move) {
            const [p, dir] = b.dataset.move.split(":");
            const i = Number(p);
            const j = dir === "up" ? i - 1 : i + 1;

            [s.order[i], s.order[j]] = [s.order[j], s.order[i]];
            rerender(id);
            return;
        }

        if (b.hasAttribute("data-check")) {
            if (b.disabled) return;
            s.checked = true;
            rerender(id);
        }
    }

    function inputChange(e) {
        const input = e.target.closest("[data-cross]");
        if (!input) return;

        const section = input.closest("#lessonPractice");
        if (!section) return;

        const id = section.dataset.practiceTopic;
        const s = state[id];

        if (!s || s.checked) return;

        const [row, col] = input.dataset.cross.split(":").map(Number);
        const value = input.value.toUpperCase().replace(/[^A-Z]/g, "").slice(-1);
        const chars = s.entries[row].split("");

        chars[col] = value;
        s.entries[row] = chars.join("").slice(0, Math.max(chars.length, col + 1));
        input.value = value;

        if (value) {
            const next = section.querySelector(`[data-cross="${row}:${col + 1}"]`);
            if (next) next.focus();
        }
    }

    function styles() {
        if ($("#wetlandPracticeStyles")) return;
        const st = document.createElement("style");
        st.id = "wetlandPracticeStyles";

        st.textContent = `
    .lesson-practice{margin:32px 0;padding:22px;border:1px solid #dce5d8;border-radius:13px;background:#fff;color:#304237;font-family:inherit}
    .wp-heading{display:flex;gap:13px;align-items:center;margin-bottom:17px}.wp-heading>span{display:grid;place-items:center;width:45px;height:45px;border-radius:11px;background:#edf3e9;font-size:23px}.wp-heading small{color:#789276;font-size:10px;font-weight:900;letter-spacing:1px}.wp-heading h2{margin:3px 0;color:#284b3b;font-size:21px;font-weight:900}.wp-heading p,.wp-subtitle{margin:0;color:#718078;font-size:12px}
    .wp-game{padding:18px;border:1px solid #e0e8dc;border-radius:10px;background:#fbfcf9}.wp-game>h3{margin:0;color:#304d39;font-size:18px;font-weight:900}.wp-subtitle{margin-top:4px}.wp-instruction{margin:14px 0;padding:11px 13px;border-radius:8px;background:#f0f5ec;color:#536457;font-size:12px;line-height:1.7}.wp-progress{display:flex;align-items:center;justify-content:space-between;gap:12px;margin-bottom:13px;color:#718078;font-size:11px}.wp-progress>div{width:42%;height:6px;overflow:hidden;border-radius:10px;background:#e6ece2}.wp-progress i{display:block;height:100%;background:#6f966d}
    .wp-cardgrid{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:9px}.wp-card{padding:12px;border:1px solid #dce5d8;border-radius:9px;background:#fff;color:#405246;text-align:center;cursor:pointer}.wp-card.selected,.wp-card:hover{border-color:#729570;background:#f0f6ed}.wp-card:disabled{opacity:.65}.wp-emoji{display:block;font-size:30px;margin-bottom:6px}.wp-card b,.wp-card small{display:block}.wp-card b{font-size:12px}.wp-card small{margin-top:4px;color:#879287;font-size:10px}
    .wp-bins{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:10px;margin-top:14px}.wp-bin{padding:12px;border:1px dashed #b9cbb4;border-radius:8px;background:#f7faf5}.wp-bin h4{margin:0;color:#426447;font-size:12px}.wp-bin h4 small{float:right}.wp-chips{display:flex;flex-wrap:wrap;gap:6px;min-height:38px;margin:10px 0}.wp-chips>span{padding:5px 7px;border-radius:5px;background:#e7efe3;color:#426447;font-size:10px}.wp-chips button{border:0;background:transparent;color:#426447;cursor:pointer}
    .wp-match{display:grid;grid-template-columns:1fr 1fr;gap:12px}.wp-match h4{margin:0 0 8px;color:#536c55;font-size:12px}.wp-matchbtn{display:block;width:100%;min-height:52px;margin-bottom:7px;padding:9px;border:1px solid #dce5d8;border-radius:7px;background:white;color:#405246;text-align:left;font-size:11px;line-height:1.5;cursor:pointer}.wp-matchbtn small{display:block;color:#8a968b;font-size:9px}.wp-matchbtn.selected{border-color:#6e936c;background:#edf5e9}.wp-matchbtn.paired{border-color:#c9d8c5;background:#f3f7f0}
    .wp-note{margin:10px 0 0;color:#718078;font-size:11px;line-height:1.6}.wp-memory{display:grid;grid-template-columns:repeat(5,minmax(0,1fr));gap:9px}.wp-memorycard{min-height:105px;padding:8px;border:1px solid #dce5d8;border-radius:9px;background:#eaf0e6;color:#405246;cursor:pointer}.wp-memorycard span{font-size:13px;line-height:1.5;overflow-wrap:anywhere}.wp-memorycard.flipped{background:#fff;border-color:#83a47d}.wp-memorycard.found{background:#edf6eb;border-color:#b8d3b3}
    .wp-scenarios{display:grid;gap:11px}.wp-scenario{padding:12px;border:1px solid #e0e8dc;border-radius:8px;background:#fff}.wp-scenario-head{display:flex;align-items:center;gap:8px;color:#426447;font-size:12px}.wp-scenario-head span{font-size:22px}.wp-scenario p{font-size:12px;line-height:1.6;color:#4e5f53}.wp-options{display:grid;gap:6px}.wp-options button{padding:9px 11px;border:1px solid #dce5d8;border-radius:6px;background:#fff;color:#405246;text-align:left;font-size:11px;cursor:pointer}.wp-options button.chosen{border-color:#6e936c;background:#edf5e9}
    .wp-sequence{display:grid;gap:8px;margin:0;padding:0;list-style:none}.wp-sequence li{display:flex;align-items:center;justify-content:space-between;gap:10px;padding:11px;border:1px solid #dce5d8;border-radius:8px;background:#fff}.wp-sequence li span{font-size:12px;line-height:1.5}.wp-sequence li div{display:flex;gap:5px}.wp-sequence button{width:30px;height:30px;border:1px solid #cbd9c7;border-radius:6px;background:#f7faf5;color:#426447;cursor:pointer}.wp-sequence button:disabled{opacity:.35}
    .wp-actions{display:flex;flex-wrap:wrap;gap:8px;margin-top:14px}.wp-primary,.wp-secondary{padding:9px 14px;border:1px solid #365f43;border-radius:7px;background:#365f43;color:#fff;font-size:11px;font-weight:800;cursor:pointer}.wp-secondary{border-color:#d5e1d1;background:#fff;color:#426447}.wp-primary:disabled{opacity:.4;cursor:not-allowed}
    .wp-result{margin-top:14px;padding:13px;border-radius:8px;font-size:11px;line-height:1.65}.wp-result.good{border:1px solid #c9dfc8;background:#eff7ed;color:#315e3c}.wp-result.review{border:1px solid #e5ddc8;background:#faf6eb;color:#75623c}.wp-result ul{margin:8px 0 0;padding-left:18px}.wp-result li{margin:6px 0}
    @media(max-width:650px){.wp-chain-cards{grid-template-columns:1fr}.wp-chain-order{font-size:8px;gap:4px}.lesson-practice{padding:14px}.wp-game{padding:12px}.wp-cardgrid{grid-template-columns:repeat(2,minmax(0,1fr))}.wp-bins,.wp-match{grid-template-columns:1fr}.wp-memory{grid-template-columns:repeat(3,minmax(0,1fr))}.wp-progress{align-items:flex-start;flex-direction:column}.wp-progress>div{width:100%}}

    .wp-chain-list{display:grid;gap:14px}.wp-chain-challenge{padding:13px;border:1px solid #dce5d8;border-radius:9px;background:#fff}.wp-chain-title{display:flex;align-items:center;gap:9px;margin-bottom:10px}.wp-chain-title>span{display:grid;place-items:center;width:27px;height:27px;border-radius:7px;background:#eaf2e7;color:#365f43;font-size:12px;font-weight:900}.wp-chain-title b,.wp-chain-title small{display:block}.wp-chain-title b{color:#405b45;font-size:12px}.wp-chain-title small{margin-top:3px;color:#879287;font-size:10px}.wp-chain-order{display:flex;align-items:center;justify-content:center;gap:7px;margin:10px 0;color:#688166;font-size:9px;font-weight:900;letter-spacing:.3px}.wp-chain-order i{font-size:10px}.wp-chain-cards{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:8px}.wp-chain-card{position:relative;display:flex;min-height:112px;flex-direction:column;align-items:flex-start;justify-content:flex-start;gap:7px;padding:12px 10px;border:1px solid #dce5d8;border-radius:8px;background:#fbfcf9;color:#405246;text-align:left;cursor:pointer}.wp-chain-card.selected{border:2px solid #6e936c;background:#edf5e9}.wp-chain-card>small{color:#879287;font-size:9px;font-weight:900;letter-spacing:.7px}.wp-chain-card>b{font-size:11px;line-height:1.55}.wp-chain-number{position:absolute;top:7px;right:8px;display:grid;place-items:center;width:22px;height:22px;border-radius:50%;background:#e6ece2;color:#426447;font-size:11px;font-weight:900}.wp-chain-card.selected .wp-chain-number{background:#365f43;color:#fff}.wp-chain-actions{display:flex;flex-wrap:wrap;gap:7px;margin-top:10px}.wp-chain-actions button:disabled{opacity:.35;cursor:not-allowed}.wp-chain-feedback{margin-top:10px;padding:10px;border-radius:7px;font-size:11px;line-height:1.6}.wp-chain-feedback.correct{background:#eff7ed;color:#315e3c}.wp-chain-feedback.incorrect{background:#faf2e9;color:#80563d}.wp-chain-feedback p{margin:5px 0}.wp-chain-feedback small{font-size:10px;font-weight:800}.wp-chain-cards button:disabled{opacity:1;cursor:default}
        .wp-wordsearch-top{display:grid;gap:10px;margin-bottom:12px}.wp-wordsearch-top>div:first-child{color:#526355;font-size:12px}.wp-wordsearch-top strong{color:#365f43;font-size:20px}.wp-wordlist{display:flex;flex-wrap:wrap;gap:7px}.wp-wordlist span{padding:6px 9px;border:1px solid #dce5d8;border-radius:20px;background:#fff;color:#526355;font-size:10px;font-weight:800}.wp-wordlist span.found{border-color:#b8d3b3;background:#eaf4e7;color:#376341;text-decoration:line-through}.wp-letter-grid{display:grid;grid-template-columns:repeat(var(--grid-size),minmax(0,1fr));gap:4px;max-width:520px;margin:14px auto;padding:10px;border:1px solid #dce5d8;border-radius:10px;background:#edf3e9}.wp-letter{aspect-ratio:1/1;min-width:0;padding:0;border:1px solid #d7e1d2;border-radius:5px;background:#fff;color:#365343;font-size:clamp(10px,2vw,15px);font-weight:800;cursor:pointer}.wp-letter.marked{border-color:#668d61;background:#dcebd7;color:#2e5c37}.wp-letter:disabled{opacity:.7}.wp-crossword-list{display:grid;gap:13px}.wp-crossword-clue{padding:12px;border:1px solid #dce5d8;border-radius:9px;background:#fff}.wp-crossword-clue-head{display:flex;align-items:flex-start;gap:9px}.wp-crossword-clue-head>span{display:grid;place-items:center;flex:0 0 25px;height:25px;border-radius:6px;background:#eaf2e7;color:#365f43;font-size:11px;font-weight:900}.wp-crossword-clue-head p{margin:2px 0 10px;color:#526355;font-size:12px;line-height:1.6}.wp-crossword-cells{display:flex;flex-wrap:wrap;gap:4px}.wp-cross-letter{width:30px;height:34px;padding:0;border:1px solid #bfcfba;border-radius:4px;background:#fbfdf9;color:#365f43;text-align:center;text-transform:uppercase;font-size:15px;font-weight:800}.wp-cross-feedback{display:block;margin-top:8px;font-size:10px;font-weight:800}.wp-cross-feedback.correct{color:#397347}.wp-cross-feedback.incorrect{color:#a15d40}
    @media print{.lesson-practice{display:none!important}}`;

        document.head.appendChild(st);
    }

    let observer = null, queued = false;

    function start() {
        styles();
        document.addEventListener("click", click);
        document.addEventListener("input", inputChange);

        const body = $("#tutContentBody");
        if (!body) return;

        ensure();

        observer = new MutationObserver(() => {
            if (queued) return;
            queued = true;

            requestAnimationFrame(() => {
                queued = false;
                ensure();
            });
        });

        observer.observe(body, { childList: true, subtree: true });
    }

    if (document.readyState === "loading") {
        document.addEventListener("DOMContentLoaded", start, { once: true });
    } else {
        start();
    }

    window.WETLAND_PRACTICE_DATA = DATA;
})();