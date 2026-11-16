<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Kuis Evaluasi — Wetland Explorer</title>
  <style>
    :root{font-family:Inter,system-ui,sans-serif;color:#193d37;background:#f4f8f3}*{box-sizing:border-box}body{margin:0}header{padding:18px max(5vw,20px);background:#fff;display:flex;justify-content:space-between;align-items:center}a{color:#176b54}main{max-width:850px;margin:36px auto;padding:0 20px}.card{background:#fff;border:1px solid #dce9df;border-radius:20px;padding:28px;box-shadow:0 12px 32px #174b3312}h1,h2{margin-top:0}.muted{color:#597269}.progress{display:flex;justify-content:space-between;gap:10px}.bar{height:10px;background:#e2eee6;border-radius:9px;overflow:hidden;margin:12px 0 22px}.bar span{display:block;height:100%;background:#27815f;transition:width .2s}.layout{display:grid;grid-template-columns:190px 1fr;gap:22px}.numbers{display:grid;grid-template-columns:repeat(4,1fr);gap:8px;align-content:start}.number,.choice,.action{font:inherit;cursor:pointer}.number{border:1px solid #cdded2;border-radius:9px;padding:10px;background:#f8fbf8;color:#193d37}.number.active{outline:3px solid #27815f}.number.answered{background:#dff1e4;border-color:#27815f}.choice{display:block;width:100%;text-align:left;padding:14px;margin:10px 0;border:1px solid #cdded2;border-radius:12px;background:#fbfdfb;color:#193d37;font-size:1rem}.choice[aria-pressed=true]{border:2px solid #27815f;background:#e8f5eb}.nav{display:flex;justify-content:space-between;gap:12px;margin-top:22px}.action{padding:11px 18px;border:0;border-radius:10px;background:#176b54;color:#fff;font-weight:700}.action:disabled{opacity:.45;cursor:not-allowed}.submit{background:#bb6725}.review{padding:16px 0;border-top:1px solid #e1ebe3}.result-score{font-size:3rem;color:#176b54;font-weight:800}.error{padding:12px;background:#fff0ed;color:#8c2b20;border-radius:10px;margin-bottom:16px}.success{color:#176b54}.wrong{color:#9c3c2f}.correct{color:#176b54}.actions{display:flex;gap:12px;flex-wrap:wrap;margin:20px 0}@media(max-width:650px){main{margin:22px auto;padding:0 12px}.card{padding:20px}.layout{grid-template-columns:1fr}.numbers{grid-template-columns:repeat(6,1fr)}.nav{flex-wrap:wrap}.nav button{flex:1}.progress{font-size:.9rem}}
    @media(prefers-reduced-motion:reduce){*{scroll-behavior:auto!important;transition:none!important}}
  </style>
</head>
<body>
<header><strong>Wetland Explorer</strong><a href="{{ url('/dashboard') }}">Kembali ke dashboard</a></header>
<main>
  @if ($errors->any())
    <div class="error" role="alert">{{ $errors->first('answers') ?: 'Jawaban tidak valid. Silakan isi kembali kuis.' }}</div>
  @endif

  @isset($results)
    <section class="card" aria-live="polite">
      <p class="muted">KUIS SELESAI</p><h1>Hasil Evaluasi</h1>
      <div class="result-score">{{ $results['score'] }}</div>
      <p>Nilai akhir: <strong>{{ $results['score'] }}/100</strong></p>
      <p>{{ $results['correct'] }} benar · {{ $results['incorrect'] }} salah · {{ $results['total'] }} soal</p>
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
      <p class="muted">KUIS EVALUASI · {{ count($questions) }} SOAL</p><h1>Uji pemahamanmu</h1>
      <div class="progress"><span id="questionPosition">Soal 1 dari {{ count($questions) }}</span><span id="answeredCount">0 dari {{ count($questions) }} terjawab</span></div>
      <div class="bar" role="progressbar" id="progressBar" aria-label="Soal terjawab" aria-valuemin="0" aria-valuemax="{{ count($questions) }}" aria-valuenow="0"><span id="progressFill" style="width:0%"></span></div>
      <div class="layout"><nav class="numbers" id="questionNumbers" aria-label="Navigasi nomor soal"></nav><section id="questionContent" aria-live="polite"></section></div>
      <form id="quizSubmission" method="POST" action="{{ route('quiz.submit') }}">@csrf<div id="answerInputs"></div>
        <div class="nav"><button class="action" type="button" id="previousButton">Sebelumnya</button><button class="action" type="button" id="nextButton">Berikutnya</button><button class="action submit" type="button" id="submitButton">Kumpulkan kuis</button></div>
      </form>
      <p class="muted" id="notice" role="status" aria-live="polite"></p>
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
</body>
</html>
