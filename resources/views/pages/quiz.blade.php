<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Kuis Evaluasi — Wetland Explorer</title>
  <link rel="stylesheet" href="{{ asset('vendor/fonts/fonts.css') }}">
  <style>
    :root{font-family:'Manrope',Arial,sans-serif;color:#202b25;background:#F6F8F5;--forest:#284b3b;--forest-dark:#1d382d;--sage:#e6eee2;--line:#dce5d8;--green:#2e7d32}
    *{box-sizing:border-box}body{margin:0;font-family:'Manrope',Arial,sans-serif;background:#F6F8F5;color:#202b25}
    a{color:var(--forest);text-decoration:none}
    .site-header{position:sticky;top:0;z-index:1000;background:#fff;border-bottom:1px solid var(--line);box-shadow:0 2px 12px rgba(29,56,45,.05)}
    .header-inner{width:min(1440px,calc(100% - 48px));min-height:76px;margin:auto;display:flex;align-items:center;justify-content:space-between;gap:25px;position:relative}
    .brand{display:inline-flex;align-items:center;gap:12px;flex-shrink:0;color:var(--forest-dark);font-size:21px;font-weight:800;letter-spacing:-.6px}
    .brand-mark{display:grid;place-items:center;width:36px;height:36px;border-radius:12px;background:var(--forest);color:#fff;font-size:25px}
    .main-navigation{display:flex;align-items:center;justify-content:center;gap:7px}
    .main-navigation a{padding:10px 13px;border-radius:8px;color:#65736a;font-size:13px;font-weight:700;transition:.2s}
    .main-navigation a:hover{background:#f1f5ed;color:var(--forest)}.main-navigation a.active{background:var(--sage);color:var(--forest-dark)}
    .header-dashboard{display:inline-flex;align-items:center;justify-content:center;padding:10px 14px;border-radius:9px;background:#edf3e9;color:var(--forest);font-size:12px;font-weight:800;white-space:nowrap}
    .header-dashboard:hover{background:#dfeadd}
    .mobile-toggle{display:none;width:39px;height:39px;border:1px solid var(--line);border-radius:8px;background:#fff;color:var(--forest);font-size:19px;cursor:pointer}
    main{max-width:1000px;margin:36px auto;padding:0 24px;width:100%}
    .card{background:#fff;border:1px solid var(--line);border-radius:20px;padding:28px;box-shadow:0 8px 26px rgba(29,56,45,.06)}
    h1,h2{margin-top:0;color:var(--forest-dark)}h1{font-size:25px;line-height:1.35;font-weight:800;margin-bottom:22px}h2{font-size:18px;line-height:1.55;font-weight:800;margin-bottom:16px}
    p{line-height:1.7}.muted{color:#718078}.eyebrow{font-size:11px;letter-spacing:.09em;font-weight:800;color:#718078;margin:0 0 8px;text-transform:uppercase}
    .progress{display:flex;justify-content:space-between;gap:10px;font-size:12px;font-weight:700;color:#526158}.bar{height:9px;background:#e5ece3;border-radius:9px;overflow:hidden;margin:12px 0 24px}.bar span{display:block;height:100%;background:#2e7d32;transition:width .2s}
    .layout{display:grid;grid-template-columns:190px minmax(0,1fr);gap:24px}.numbers{display:grid;grid-template-columns:repeat(4,1fr);gap:8px;align-content:start}
    .number,.choice,.action{font:inherit;cursor:pointer}.number{border:1px solid #dce5d8;border-radius:9px;padding:10px 8px;background:#f8faf7;color:#526158;font-size:13px;font-weight:700;transition:.2s}.number.active{outline:2px solid #2e7d32;border-color:#2e7d32;color:#1d382d}.number.answered{background:#e6eee2;border-color:#9fbea0;color:#284b3b}
    .choice{display:block;width:100%;text-align:left;padding:14px 16px;margin:10px 0;border:1px solid #dce5d8;border-radius:12px;background:#fbfdfb;color:#36483d;font-size:14px;font-weight:600;line-height:1.65;transition:.2s}.choice:hover{border-color:#9fbea0;background:#f7faf5}.choice[aria-pressed=true]{border:2px solid #2e7d32;background:#edf5e9;color:#1d382d;padding:13px 15px}
    .nav{display:flex;justify-content:space-between;gap:12px;margin-top:24px}.action{display:inline-flex;align-items:center;justify-content:center;padding:11px 18px;border:0;border-radius:9px;background:#284b3b;color:#fff;font-size:13px;font-weight:800;transition:.2s}.action:hover{background:#1d382d}.action:disabled{opacity:.4;cursor:not-allowed}.submit{background:#bb6725}.submit:hover{background:#9f541c}
    .review{padding:18px 0;border-top:1px solid #e5ece3}.review strong{line-height:1.6}.result-score{font-size:3rem;color:#284b3b;font-weight:800;line-height:1.2}.error{padding:12px 14px;background:#fff0ed;color:#8c2b20;border-radius:10px;margin-bottom:16px;font-size:13px}.success{color:#176b54}.wrong{color:#9c3c2f}.correct{color:#176b54}.actions{display:flex;gap:10px;flex-wrap:wrap;margin:20px 0 26px}.notice{font-size:12px;color:#9c3c2f;margin:14px 0 0;line-height:1.6}
    footer{background:#fff;border-top:1px solid #e5e9e3;padding:18px 16px;text-align:center;color:#7b867e;font-size:11px;margin-top:40px}
    @media(max-width:950px){.header-inner{gap:12px}.main-navigation{gap:0}.main-navigation a{padding:9px 8px;font-size:11px}}
    @media(max-width:720px){.header-inner{width:calc(100% - 28px);min-height:68px}.brand{font-size:17px;gap:9px}.brand-mark{width:34px;height:34px;font-size:22px}.mobile-toggle{display:grid;place-items:center;margin-left:auto}.main-navigation{position:absolute;top:calc(100% + 1px);left:-14px;right:-14px;display:none;flex-direction:column;align-items:stretch;padding:12px 16px;background:#fff;border-bottom:1px solid var(--line);box-shadow:0 10px 18px rgba(29,56,45,.08)}.main-navigation.show{display:flex}.main-navigation a{padding:12px;font-size:13px}.header-dashboard{font-size:11px;padding:9px 10px}main{margin:22px auto;padding:0 14px}.card{padding:20px 17px;border-radius:16px}h1{font-size:21px;margin-bottom:18px}h2{font-size:16px}.layout{grid-template-columns:1fr;gap:18px}.numbers{grid-template-columns:repeat(6,minmax(0,1fr));gap:7px}.number{padding:9px 5px;font-size:12px}.choice{font-size:13px;padding:12px 13px;margin:8px 0;line-height:1.6}.choice[aria-pressed=true]{padding:11px 12px}.nav{flex-wrap:wrap;gap:9px}.nav button{flex:1;min-width:105px;padding:11px 10px;font-size:12px}.progress{font-size:11px}.result-score{font-size:2.6rem}.actions .action{flex:1}.review{padding:15px 0}}
    @media(max-width:380px){.header-dashboard{padding:8px;font-size:10px}.brand{font-size:15px}.numbers{grid-template-columns:repeat(5,minmax(0,1fr))}.progress{font-size:10px}}
    @media(prefers-reduced-motion:reduce){*{scroll-behavior:auto!important;transition:none!important}}
  </style>
</head>
<body>
<header class="site-header">
  <div class="header-inner">
    <a class="brand" href="{{ url('/') }}"><span class="brand-mark" aria-hidden="true">♧</span><span>Wetland Explorer</span></a>
    <button type="button" class="mobile-toggle" id="mobileNavToggle" aria-label="Buka navigasi" aria-expanded="false">☰</button>
    <nav class="main-navigation" id="mainNavigation" aria-label="Navigasi utama">
      <a href="{{ url('/dashboard') }}">Dashboard</a>
      <a href="{{ url('/tutorial') }}">Materi</a>
      <a href="{{ url('/exploration') }}">Eksplorasi</a>
      <a href="{{ url('/missions') }}">Misi</a>
      <a href="{{ url('/quiz') }}" class="active">Kuis</a>
    </nav>
    <a class="header-dashboard" href="{{ url('/dashboard') }}">Dashboard</a>
  </div>
</header>
<main>
  @if ($errors->any())
    <div class="error" role="alert">{{ $errors->first('answers') ?: 'Jawaban tidak valid. Silakan isi kembali kuis.' }}</div>
  @endif

  @isset($results)
    <section class="card" aria-live="polite">
      <p class="eyebrow">Kuis Selesai</p><h1>Hasil Evaluasi</h1>
      <div class="result-score">{{ $results['score'] }}</div>
      <p>Nilai akhir: <strong>{{ $results['score'] }}/100</strong></p>
      <p class="muted">{{ $results['correct'] }} benar · {{ $results['incorrect'] }} salah · {{ $results['total'] }} soal</p>
      <div class="actions"><a class="action" href="{{ route('quiz.index') }}">Ulangi kuis</a><a class="action" href="{{ url('/dashboard') }}">Kembali ke dashboard</a></div>
      <h2>Pembahasan</h2>
      @foreach ($results['review'] as $index => $item)
        <article class="review"><strong>{{ $index + 1 }}. {{ $item['question'] }}</strong>
          <p class="{{ $item['correct'] ? 'correct' : 'wrong' }}">Jawabanmu: {{ $item['chosen'] }} — {{ $item['correct'] ? 'Benar' : 'Belum tepat' }}</p>
          <p>Jawaban benar: <strong>{{ $item['correctAnswer'] }}</strong></p><p class="muted">{{ $item['explanation'] }}</p>
        </article>
      @endforeach
    </section>
  @else
    <section class="card" id="quizCard">
      <p class="eyebrow">Kuis Evaluasi · {{ count($questions) }} Soal</p><h1>Uji pemahamanmu</h1>
      <div class="progress"><span id="questionPosition">Soal 1 dari {{ count($questions) }}</span><span id="answeredCount">0 dari {{ count($questions) }} terjawab</span></div>
      <div class="bar" role="progressbar" id="progressBar" aria-label="Soal terjawab" aria-valuemin="0" aria-valuemax="{{ count($questions) }}" aria-valuenow="0"><span id="progressFill" style="width:0%"></span></div>
      <div class="layout"><nav class="numbers" id="questionNumbers" aria-label="Navigasi nomor soal"></nav><section id="questionContent" aria-live="polite"></section></div>
      <form id="quizSubmission" method="POST" action="{{ route('quiz.submit') }}">@csrf<div id="answerInputs"></div>
        <div class="nav"><button class="action" type="button" id="previousButton">Sebelumnya</button><button class="action" type="button" id="nextButton">Berikutnya</button><button class="action submit" type="button" id="submitButton">Kumpulkan kuis</button></div>
      </form>
      <p class="notice" id="notice" role="status" aria-live="polite"></p>
    </section>
    <script id="quizData" type="application/json">{!! json_encode($questions, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) !!}</script>
    <script>
    (()=>{
      const questions=JSON.parse(document.getElementById('quizData').textContent),answers=Array(questions.length).fill(null);let current=0;
      const content=document.getElementById('questionContent'),numbers=document.getElementById('questionNumbers'),inputs=document.getElementById('answerInputs'),notice=document.getElementById('notice');
      function updateProgress(){const answered=answers.filter(value=>value!==null).length;document.getElementById('answeredCount').textContent=`${answered} dari ${questions.length} terjawab`;document.getElementById('progressBar').setAttribute('aria-valuenow',answered);document.getElementById('progressFill').style.width=`${answered/questions.length*100}%`;numbers.querySelectorAll('button').forEach((button,index)=>{const done=answers[index]!==null;button.classList.toggle('answered',done);button.classList.toggle('active',index===current);button.setAttribute('aria-current',index===current?'step':'false');button.setAttribute('aria-label',`Soal ${index+1}, ${done?'sudah dijawab':'belum dijawab'}${index===current?', sedang aktif':''}`)});}
      function render(){const question=questions[current];document.getElementById('questionPosition').textContent=`Soal ${current+1} dari ${questions.length}`;content.replaceChildren();const heading=document.createElement('h2');heading.textContent=question.question;content.appendChild(heading);question.options.forEach((option,index)=>{const button=document.createElement('button');button.type='button';button.className='choice';button.textContent=`${String.fromCharCode(65+index)}. ${option}`;button.setAttribute('aria-pressed',answers[current]===index?'true':'false');button.addEventListener('click',()=>{answers[current]=index;notice.textContent='';render();});content.appendChild(button)});document.getElementById('previousButton').disabled=current===0;document.getElementById('nextButton').disabled=current===questions.length-1;updateProgress();}
      questions.forEach((_,index)=>{const button=document.createElement('button');button.type='button';button.className='number';button.textContent=String(index+1);button.setAttribute('aria-label',`Soal ${index+1}, belum dijawab`);button.addEventListener('click',()=>{current=index;notice.textContent='';render()});numbers.appendChild(button)});
      document.getElementById('previousButton').addEventListener('click',()=>{if(current>0){current--;render()}});document.getElementById('nextButton').addEventListener('click',()=>{if(current<questions.length-1){current++;render()}});
      document.getElementById('submitButton').addEventListener('click',()=>{const unanswered=answers.findIndex(value=>value===null);if(unanswered!==-1){current=unanswered;render();notice.textContent=`Masih ada ${answers.filter(value=>value===null).length} soal yang belum dijawab. Silakan lengkapi sebelum mengumpulkan.`;return}if(!window.confirm('Semua soal sudah dijawab. Kumpulkan kuis sekarang?'))return;inputs.replaceChildren();answers.forEach((answer,index)=>{const input=document.createElement('input');input.type='hidden';input.name=`answers[${questions[index].id}]`;input.value=String(answer);inputs.appendChild(input)});document.getElementById('quizSubmission').submit()});render();
    })();
    </script>
  @endisset
</main>
<footer>© {{ date('Y') }} <strong>Wetland Explorer</strong>. Media Pembelajaran Ekosistem Lahan Basah.</footer>
<script>
  document.addEventListener('DOMContentLoaded',function(){
    const toggle=document.getElementById('mobileNavToggle'),navigation=document.getElementById('mainNavigation');
    if(toggle&&navigation){toggle.addEventListener('click',function(){navigation.classList.toggle('show');const open=navigation.classList.contains('show');toggle.setAttribute('aria-expanded',open);toggle.textContent=open?'×':'☰';});navigation.querySelectorAll('a').forEach(link=>link.addEventListener('click',()=>{navigation.classList.remove('show');toggle.setAttribute('aria-expanded','false');toggle.textContent='☰';}));}
  });
</script>
</body>
</html>
